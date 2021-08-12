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
use App\Models\Agreement;
use App\Models\Employee;
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



class CustomerController extends Controller {





    use BaseTrait;





    public static

        $COLUMN_NAME                                        = 401,
        $COLUMN_EMAIL                                       = 402,
        $COLUMN_PHONE                                       = 403,
        $COLUMN_STUDENTS                                    = 404,
        $COLUMN_EMPLOYEES                                   = 405,
        $COLUMN_AGREEMENTS                                  = 406,
        $COLUMN_MIN_MAX                                     = 407,
        $COLUMN_STATUS                                      = 408;




    public function list(Request $request) {

        return Table::view($this, $request);

    }



    public function list_load(Request $request) {

        return Table::load($this, $request);

    }



    public function list_type() {

        return Model::$CUSTOMER;

    }



    public function list_view() {

        return Views::LIST_CUSTOMER;

    }



    public function list_title() {

        return 'Klanten';

    }



    public function list_columns($sort, $filter) {

        $columns                                            = [];

        array_push($columns,
            Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
            Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
            Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
            Table::column(self::$COLUMN_STUDENTS, self::list_column_label(self::$COLUMN_STUDENTS), 3, false, $sort, false, $filter),
            Table::column(self::$COLUMN_EMPLOYEES, self::list_column_label(self::$COLUMN_EMPLOYEES), 3, false, $sort, false, $filter),
            Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3, false, $sort, true, $filter),
            Table::column(self::$COLUMN_MIN_MAX, self::list_column_label(self::$COLUMN_MIN_MAX), 2, false, $sort, false, $filter),
            Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, true, $sort, true, $filter),
        );

        return $columns;
    }



    public static function list_column_label($column) {

        switch ($column) {
            case self::$COLUMN_NAME:                return "Naam";
            case self::$COLUMN_EMAIL:               return "E-mailadres";
            case self::$COLUMN_PHONE:               return "Telefoonnummer";
            case self::$COLUMN_STUDENTS:            return "Leerling(en)";
            case self::$COLUMN_EMPLOYEES:           return "Student-docent(en)";
            case self::$COLUMN_AGREEMENTS:          return "Vakafspraken";
            case self::$COLUMN_MIN_MAX:             return "MIN/MAX";
            case self::$COLUMN_STATUS:              return "Status";
        }

        return Key::UNKNOWN;
    }



    public function list_value($customer, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_NAME:

                return PersonTrait::getFullName($customer->getUser->getPerson);

            case self::$COLUMN_EMAIL:

                return $customer->getUser->{Model::$USER_EMAIL};

            case self::$COLUMN_PHONE:

                return $customer->getUser->getPerson->{Model::$PERSON_PHONE};

            case self::$COLUMN_STUDENTS:

                $students = User::whereHas('getStudent.getCustomer', function ($q) use ($customer) {$q->where(Model::$CUSTOMER, $customer->{Model::$BASE_ID});})
                    ->with('getPerson')
                    ->get();

                // $students                                   = $customer->getStudents;

                switch (count($students)) {
                    case 0:                                 return "Geen leerlingen";
                    case 1:                                 return PersonTrait::getFullName($students[0]->getPerson);
                    default:                                return implode(", ", $students->pluck('getPerson.' . Model::$PERSON_FIRST_NAME)->toArray());
                }

            case self::$COLUMN_EMPLOYEES:

                $employees = User::whereHas('getAgreements_asEmployee.getStudent.getStudent', function ($q) use ($customer) {$q->where(Model::$CUSTOMER, $customer->{Model::$BASE_ID});})
                    ->with('getPerson')
                    ->get();

                switch (count($employees)) {
                    case 0:                                 return "Geen leerlingen";
                    case 1:                                 return PersonTrait::getFullName($employees[0]->getPerson);
                    default:                                return implode(", ", $employees->pluck('getPerson.' . Model::$PERSON_FIRST_NAME)->toArray());
                }

            case self::$COLUMN_AGREEMENTS:

                $agreements = Agreement::whereHas('getStudent.getStudent', function ($q) use ($customer) {$q->where(Model::$CUSTOMER, $customer->{Model::$BASE_ID});})
                    ->with('getSubject')
                    ->get();

                switch (count($agreements)) {
                    case 0:                                 return "Geen actief";
                    case 1:                                 return $agreements[0]->getSubject->{Model::$SUBJECT_CODE};
                    case 2:                                 return $agreements[0]->getSubject->{Model::$SUBJECT_CODE} . ", " . $agreements[1]->getSubject->{Model::$SUBJECT_CODE};
                    default:                                return $agreements[0]->getSubject->{Model::$SUBJECT_CODE} . ", " . $agreements[1]->getSubject->{Model::$SUBJECT_CODE} . " en nog " . (count($agreements) - 2);
                }

            case self::$COLUMN_MIN_MAX:

                $agreements = Agreement::whereHas('getStudent.getStudent', function ($q) use ($customer) {$q->where(Model::$CUSTOMER, $customer->{Model::$BASE_ID});})
                    ->with('getSubject')
                    ->get();

                $min                                        = 0;
                $max                                        = 0;

                if (count($agreements) == 0) {

                    return "Geen actief";

                }

                foreach ($agreements as $agreement) {

                    $min                                   += $agreement->{Model::$AGREEMENT_MIN};
                    $max                                   += $agreement->{Model::$AGREEMENT_MAX};
                }

                return $min . " tot " . $max . " uur";

            case self::$COLUMN_STATUS:

                return UserTrait::getStatusText($customer->getUser->{Model::$USER_STATUS});

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
                    $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$CUSTOMER . '.' . Model::$USER);
                    $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                    $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, $mode);
                    break;

                case self::$COLUMN_STATUS:
                    $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$CUSTOMER . '.' . Model::$USER);
                    $query->orderBy(Model::$USER . '.' . Model::$USER_STATUS, $mode);
                    break;
            }
        }
    }



    public function list_sort_default($query) {

        $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$CUSTOMER . '.' . Model::$USER);
        $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
        $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, Table::SORT_MODE_ASC);
    }



    public function list_filter($query, $filter) {

        foreach ($filter as $column => $value) {

            switch ($column) {

                case self::$COLUMN_AGREEMENTS:
                    $query->whereHas('getStudents.getUser.getAgreements_asStudent.getSubject', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
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
                break;

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

            case self::$COLUMN_AGREEMENTS:

                return Subject::all()->pluck(Model::$SUBJECT_CODE, Model::$BASE_ID)->toArray();

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

                case self::$COLUMN_AGREEMENTS:
                    $display                                = Subject::find($value)->{Model::$SUBJECT_CODE};
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
                ->select('customer.*')
                ->get()
                ->count()
        ]);

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }





}
