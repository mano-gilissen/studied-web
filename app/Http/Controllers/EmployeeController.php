<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Table;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudentTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\SubjectTrait;
use App\Http\Traits\UserTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Service;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;



class EmployeeController extends Controller {





    use BaseTrait;





    public static

        $COLUMN_NAME                                        = 301,
        $COLUMN_EMAIL                                       = 302,
        $COLUMN_PHONE                                       = 303,
        $COLUMN_SUBJECTS                                    = 304,
        $COLUMN_STUDENTS                                    = 305,
        $COLUMN_AGREEMENTS                                  = 306,
        $COLUMN_MIN_MAX                                     = 307,
        $COLUMN_CAPACITY                                    = 308,
        $COLUMN_STATUS                                      = 309;




    public function list(Request $request) {

        return Table::view($this, $request);

    }



    public function list_load(Request $request) {

        return Table::load($this, $request);

    }



    public function list_type() {

        return Model::$EMPLOYEE;

    }



    public function list_view() {

        return Views::LIST_EMPLOYEE;

    }



    public function list_title() {

        return 'Medewerkers';

    }



    public function list_columns($sort, $filter) {

        $columns                                            = [];

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
                array_push($columns,
                    Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_SUBJECTS, self::list_column_label(self::$COLUMN_SUBJECTS), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_STUDENTS, self::list_column_label(self::$COLUMN_STUDENTS), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_MIN_MAX, self::list_column_label(self::$COLUMN_MIN_MAX), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_CAPACITY, self::list_column_label(self::$COLUMN_CAPACITY), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter),
                );
                break;

            default:

                break;
        }

        return $columns;
    }



    public static function list_column_label($column) {

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
            case RoleTrait::$ID_CUSTOMER:
                switch ($column) {
                    case self::$COLUMN_NAME:                return "Naam";
                    case self::$COLUMN_EMAIL:               return "E-mailadres";
                    case self::$COLUMN_PHONE:               return "Telefoonnummer";
                    case self::$COLUMN_SUBJECTS:            return "Vakken";
                    case self::$COLUMN_STUDENTS:            return "Leerling(en)";
                    case self::$COLUMN_AGREEMENTS:          return "Vakafspraken";
                    case self::$COLUMN_MIN_MAX:             return "MIN/MAX";
                    case self::$COLUMN_CAPACITY:            return "Capaciteit";
                    case self::$COLUMN_STATUS:              return "Status";
                }
                break;
        }

        return Key::UNKNOWN;
    }



    public function list_value($employee, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_NAME:

                return PersonTrait::getFullName($employee->getUser->getPerson);

            case self::$COLUMN_EMAIL:

                return $employee->getUser->{Model::$USER_EMAIL};

            case self::$COLUMN_PHONE:

                return $employee->getUser->getPerson->{Model::$PERSON_PHONE};

            case self::$COLUMN_SUBJECTS:

                return "a";

            case self::$COLUMN_STUDENTS:

                $students                                   = $employee->getUser->getStudents;

                switch (count($students)) {
                    case 0:                                 return "Geen leerlingen";
                    case 1:                                 return PersonTrait::getFullName($students[0]->getPerson);
                    default:                                return implode(", ", $students->get()->pluck('getPerson.' . Model::$PERSON_FIRST_NAME)->toArray());
                }

            case self::$COLUMN_AGREEMENTS:

                return implode(", ", $employee->with('getUser.getAgreements_asEmployee.getSubject')->get()->pluck('getUser.getAgreements_asEmployee.getSubject.' . Model::$SUBJECT_CODE)->toArray());;

            case self::$COLUMN_MIN_MAX:

                $agreements                                 = $employee->getUser->getAgreements_asEmployee;
                $min                                        = 0;
                $max                                        = 0;

                foreach ($agreements as $agreement) {

                    $min                                   += $agreement->{Model::$AGREEMENT_MIN};
                    $max                                   += $agreement->{Model::$AGREEMENT_MAX};
                }

                return $min . " tot " . $max . " uur";

            case self::$COLUMN_CAPACITY:

                return $employee->{Model::$EMPLOYEE_CAPACITY} . " uur";

            case self::$COLUMN_STATUS:

                return UserTrait::getStatusText($employee->getUser->{Model::$USER_STATUS});

            default:

                return Key::UNKNOWN;
        }
    }



    public function list_link($employee) {

        return route('person.view', [Model::$PERSON_SLUG => $employee->getUser->getPerson->{Model::$PERSON_SLUG}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

            switch ($column) {

                case self::$COLUMN_NAME:
                    $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$EMPLOYEE . '.' . Model::$USER);
                    $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                    $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, $mode);
                    break;

                case self::$COLUMN_STATUS:
                    $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$EMPLOYEE . '.' . Model::$USER);
                    $query->orderBy(Model::$USER . '.' . Model::$USER_STATUS, $mode);
                    break;
            }
        }
    }



    public function list_sort_default($query) {

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
                $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$EMPLOYEE . '.' . Model::$USER);
                $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, Table::SORT_MODE_ASC);
                break;
        }
    }



    public function list_filter($query, $filter) {

        foreach ($filter as $column => $value) {

            switch ($column) {

                case self::$COLUMN_SUBJECTS:

                    break;

                case self::$COLUMN_STUDENTS:
                    $query->whereHas('getUser.getStudents', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_AGREEMENTS:
                    $query->whereHas('getUser.getAgreements_asEmployee.getSubject', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_STATUS:
                    $query->whereHas('getUser', function (Builder $q) use ($value) {$q->where(Model::$USER_STATUS, $value);});
                    break;
            }
        }
    }



    public function list_filter_default($query) {

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
                // TODO: ADD AREA FILTER FOR MANAGEMENT
                break;
        }
    }



    public function list_filter_parameter(&$data_filter, $parameter, $value) {

        //

    }



    public function list_filter_data($query, $column) {

        switch ($column->{Model::$BASE_ID}) {

            case self::$COLUMN_SUBJECTS:

                return Subject::all()->pluck(Model::$SUBJECT_CODE, Model::$BASE_ID)->toArray();

            case self::$COLUMN_STUDENTS:

                return $query
                    ->with('getUser.getStudents.getPerson')
                    ->get()
                    ->pluck('getUser.getStudents.getPerson.' . 'fullName', 'getUser.getStudents.' . Model::$BASE_ID)
                    ->toArray();

            case self::$COLUMN_AGREEMENTS:

                return $query
                    ->with('getUser.getAgreements_asEmployee.getSubject')
                    ->get()
                    ->pluck('getUser.getAgreements_asEmployee.getSubject.' . Model::$SUBJECT_CODE, 'getUser.getAgreements_asEmployee.getSubject.' . Model::$BASE_ID)
                    ->toArray();

            case self::$COLUMN_STATUS:

                return UserTrait::getStatusFilterData();

            default:

                return [];
        }
    }



    public function list_filter_load(Request $request) {

        $data_filter                                        = $request->input(Table::DATA_FILTER, null);
        $filters                                            = [];

        if (!$data_filter) {

            return false;

        }

        foreach ($data_filter as $filter => $value) {

            $display                                        = '';

            switch ($filter) {

                case self::$COLUMN_SUBJECTS:
                case self::$COLUMN_AGREEMENTS:
                    $display                                = SubjectTrait::find($value)->{Model::$SUBJECT_CODE};
                    break;

                case self::$COLUMN_STUDENTS:
                    $display                                = PersonTrait::getFullName(User::find($value)->getPerson);
                    break;

                case self::$COLUMN_STATUS:
                    $display                                = UserTrait::getStatusText($value);
                    break;
            }

            array_push($filters, (object) [
                Table::COLUMN_ID                            => $filter,
                Table::FILTER_COLUMN                        => self::list_filter_label($filter),
                Table::FILTER_VALUE                         => $display
            ]);
        }

        return view(Views::LOAD_FILTERS, [

            Table::VIEW_FILTERS                             => $filters

        ]);
    }



    public function list_filter_label($filter) {

        switch ($filter) {

            default:

                return self::list_column_label($filter);
        }

    }



    public function list_counters_load(Request $request) {

        $sort                                               = $request->input(Table::DATA_SORT, null);
        $filter                                             = $request->input(Table::DATA_FILTER, null);

        $query                                              = Table::query($this, $sort, $filter);
        $counters                                           = [];

        array_push($counters, (object) [
            Table::COUNTER_LABEL                            => 'Totaal',
            Table::COUNTER_VALUE                            => $query
                ->select('employee.*')
                ->get()
                ->count()
        ]);

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }





}
