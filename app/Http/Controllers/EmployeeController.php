<?php



namespace App\Http\Controllers;

use App\Http\Middleware\Locale;
use App\Http\Support\Format;
use App\Http\Support\Route;
use App\Http\Support\Table;
use App\Http\Traits\AddressTrait;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\EmployeeTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudentTrait;
use App\Http\Traits\UserTrait;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Agreement;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;



class EmployeeController extends Controller {





    use BaseTrait;





    public static

        $COLUMN_NAME                                                        = 301,
        $COLUMN_EMAIL                                                       = 302,
        $COLUMN_PHONE                                                       = 303,
        $COLUMN_SUBJECTS                                                    = 304,
        $COLUMN_STUDENTS                                                    = 305,
        $COLUMN_AGREEMENTS                                                  = 306,
        $COLUMN_CAPACITY                                                    = 307,
        $COLUMN_STATUS                                                      = 308;





    public function create() {

        return view(Views::FORM_EMPLOYEE_CREATE, [

            Key::PAGE_TITLE                                                 => __('Medewerker aanmaken'),
            Key::SUBMIT_ACTION                                              => __('Aanmaken'),
            Key::SUBMIT_ROUTE                                               => 'employee.create_submit',
            Key::BACK_ROUTE                                                 => 'employee.list',

            Key::AUTOCOMPLETE_DATA . Model::$USER_LANGUAGE                  => Format::encode(Locale::getData_autocomplete()),
            Key::AUTOCOMPLETE_DATA . Model::$PERSON_PREFIX                  => Format::encode(PersonTrait::getPrefixData()),
            Key::AUTOCOMPLETE_DATA . Model::$PERSON_REFER                   => Format::encode(PersonTrait::getReferData()),
            Key::AUTOCOMPLETE_DATA . Model::$EMPLOYEE_PROFILE_MIDDELBARE    => Format::encode(StudentTrait::getProfileData())
        ]);
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();
        $employee                                                           = EmployeeTrait::create($data, $request);

        if (!$employee) {

            abort(500);

        }

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Medewerker aangemaakt'),
            Key::PAGE_NEXT                                                  => route(Route::PERSON_VIEW, [Model::$PERSON_SLUG => $employee->getUser->getPerson->{Model::$PERSON_SLUG}]),
            Key::PAGE_ACTION                                                => __('Naar de profielpagina'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





    public function edit($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();



        $data[Model::$PERSON]                                               = $person;

        $data[Key::PAGE_TITLE]                                              = __('Medewerker bewerken');
        $data[Key::SUBMIT_ACTION]                                           = __('Opslaan');
        $data[Key::SUBMIT_ROUTE]                                            = 'employee.edit_submit';


        $data[Key::AUTOCOMPLETE_DATA . Model::$USER_LANGUAGE]               = Format::encode(Locale::getData_autocomplete());
        $data[Key::AUTOCOMPLETE_DATA . Model::$PERSON_PREFIX]               = Format::encode(PersonTrait::getPrefixData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$EMPLOYEE_PROFILE_MIDDELBARE] = Format::encode(StudentTrait::getProfileData());



        UserController::form_set_ac_data_status($data, $person->getUser);

        PersonController::form_set_ac_data_refer($data);



        return view(Views::FORM_PERSON_EDIT, $data);
    }



    public function edit_submit(Request $request) {

        $data                                                               = $request->all();
        $person                                                             = Person::find($data['_' . Model::$PERSON]);
        $employee                                                           = $person->getUser->getEmployee;

        EmployeeTrait::update($data, $request, $employee);

        UserTrait::update($data, $person->getUser);

        $person->refresh();

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Medewerker gewijzigd'),
            Key::PAGE_NEXT                                                  => route('person.view', $person->{Model::$PERSON_SLUG}),
            Key::PAGE_ACTION                                                => __('Naar de profielpagina'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





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

        return __('Medewerkers');

    }



    public function list_columns($sort, $filter) {

        $columns                                            = [];

        array_push($columns,
            Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
            Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
            Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
            Table::column(self::$COLUMN_SUBJECTS, self::list_column_label(self::$COLUMN_SUBJECTS), 3, false, $sort, true, $filter),
            Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3.5, false, $sort, true, $filter),
            Table::column(self::$COLUMN_CAPACITY, self::list_column_label(self::$COLUMN_CAPACITY), 2, false, $sort, false, $filter),
            Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, true, $sort, true, $filter, true)
        );

        return $columns;
    }



    public static function list_column_label($column) {

        switch ($column) {
            case self::$COLUMN_NAME:                return __('Naam');
            case self::$COLUMN_EMAIL:               return __('E-mailadres');
            case self::$COLUMN_PHONE:               return __('Telefoonnummer');
            case self::$COLUMN_SUBJECTS:            return __('Vakken');
            case self::$COLUMN_STUDENTS:            return __('Leerling(en)');
            case self::$COLUMN_AGREEMENTS:          return __('Vakafspraken');
            case self::$COLUMN_CAPACITY:            return __('Capaciteit');
            case self::$COLUMN_STATUS:              return __('Status');
        }

        return __('Onbekend');
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

                return __('Geen gekoppeld');

            case self::$COLUMN_STUDENTS:

                $students                                   = $employee->getUser->getStudents;

                switch (count($students)) {
                    case 0:                                 return __('Geen leerlingen');
                    case 1:                                 return PersonTrait::getFullName($students[0]->getPerson);
                    default:                                return implode(", ", $students->pluck('getPerson.' . Model::$PERSON_FIRST_NAME)->toArray());
                }

            case self::$COLUMN_AGREEMENTS:

                $agreements                                 = UserTrait::getAgreements($employee->getUser, true);

                switch (count($agreements)) {
                    case 0:                                 return __('Geen actief');
                    case 1:                                 return AgreementTrait::getVakcode($agreements[0]);
                    case 2:                                 return AgreementTrait::getVakcode($agreements[0]) . ", " . AgreementTrait::getVakcode($agreements[1]);
                    default:                                return AgreementTrait::getVakcode($agreements[0]) . ", " . AgreementTrait::getVakcode($agreements[1]) . __(' en nog :count', ['count' => (count($agreements) - 2)]);
                }

            case self::$COLUMN_CAPACITY:

                return $employee->{Model::$EMPLOYEE_CAPACITY} . __(" uur");

            case self::$COLUMN_STATUS:

                $status = $employee->getUser->{Model::$USER_STATUS};

                return "<div class='tag' style='background:" . UserTrait::getStatusColor($status) . ";color:" . UserTrait::getStatusTextColor($status) . "'>".UserTrait::getStatusText($status)."</div>";

            default:

                return __('Onbekend');
        }
    }



    public function list_prepare($objects) {

        return $objects;

    }



    public function list_link($employee) {

        return route('person.view', [Model::$PERSON_SLUG => $employee->getUser->getPerson->{Model::$PERSON_SLUG}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

            if ($mode != Table::SORT_MODE_NONE) {

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
    }



    public function list_sort_default($query) {

        $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$EMPLOYEE . '.' . Model::$USER);
        $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
        $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, Table::SORT_MODE_ASC);
    }



    public function list_filter($query, $filter) {

        foreach ($filter as $column => $value) {

            switch ($column) {

                case self::$COLUMN_SUBJECTS:

                    break;

                case self::$COLUMN_STUDENTS:
                    $query->whereHas('getUser.getAgreements_asEmployee', function (Builder $q1) use ($value) {

                        $q1->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));
                        $q1->whereHas('getStudent', function (Builder $q2) use ($value) {

                            $q2->where(Model::$USER . '.' . Model::$BASE_ID, $value);

                        });
                    });
                    break;

                case self::$COLUMN_AGREEMENTS:
                    $query->whereHas('getUser.getAgreements_asEmployee', function (Builder $q) use ($value) {

                        $q->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));
                        $q->where(Model::$SUBJECT, $value);
                    });
                    break;

                case self::$COLUMN_STATUS:
                    $query->whereHas('getUser', function (Builder $q) use ($value) {$q->where(Model::$USER_STATUS, $value);});
                    break;
            }
        }
    }



    public function list_filter_search($query, $value) {

        $query->where(function($query) use ($value) {

            $query

                ->whereHas('getUser.getPerson', function (Builder $q) use ($value) {

                    $q

                        ->where(Model::$PERSON_FIRST_NAME, 'LIKE', '%'.$value.'%')
                        ->orWhere(Model::$PERSON_LAST_NAME, 'LIKE', '%'.$value.'%');
                })

                ->orWhereHas('getUser', function (Builder $q) use ($value) {

                    $q->where(Model::$USER_EMAIL, 'LIKE', '%'.$value.'%');

                });
        });
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

            case self::$COLUMN_SUBJECTS:
            case self::$COLUMN_AGREEMENTS:

                return Subject::all()->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();

            case self::$COLUMN_STUDENTS:

                $employees                                  = $query->get();
                $students                                   = [];

                foreach ($employees as $employee) {

                    foreach (UserTrait::getAgreements($employee->getUser, true) as $agreement) {

                        $students[$agreement->student] = $agreement->getStudent->getPerson->first_name;

                    }
                }

                return $students;

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
                    $display                                = Subject::find($value)->{Model::$SUBJECT_NAME};
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
        $search                                             = $request->input(Table::DATA_SEARCH, null);

        $query                                              = Table::query($this, $sort, $filter, $search);
        $counters                                           = [];

        self::list_counters_load_total($query, $counters);

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }



    public function list_counters_load_total($query, &$counters) {

        array_push($counters, (object) [
            Table::COUNTER_ID                               => 'counter-total',
            Table::COUNTER_LABEL                            => __('Totaal'),
            Table::COUNTER_VALUE                            => $query
                ->select('employee.*')
                ->get()
                ->count()
        ]);
    }





}
