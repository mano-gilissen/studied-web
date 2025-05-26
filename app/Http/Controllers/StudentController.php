<?php



namespace App\Http\Controllers;

use App\Http\Middleware\Locale;
use App\Http\Support\Format;
use App\Http\Support\Route;
use App\Http\Support\Table;
use App\Http\Traits\AddressTrait;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudentTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;



class StudentController extends Controller {





    use BaseTrait;





    public static

        $COLUMN_NAME                                                        = 201,
        $COLUMN_EMAIL                                                       = 202,
        $COLUMN_PHONE                                                       = 203,
        $COLUMN_NIVEAU                                                      = 204,
        $COLUMN_LEERJAAR                                                    = 205,
        $COLUMN_AGREEMENTS                                                  = 206,
        $COLUMN_STATUS                                                      = 207,
        $COLUMN_CUSTOMER                                                    = 208,
        $COLUMN_EMPLOYEE                                                    = 209,

        $PARAMETER_CUSTOMER                                                 = "klant",
        $PARAMETER_EMPLOYEE                                                 = "medewerker";





    public function create() {

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = __('Leerling aanmaken');
        $data[Key::SUBMIT_ACTION]                                           = __('Aanmaken');
        $data[Key::SUBMIT_ROUTE]                                            = 'student.create_submit';

        $data[Key::AUTOCOMPLETE_DATA . Model::$USER_LANGUAGE]               = Format::encode(Locale::getData_autocomplete());

        $data[Key::AUTOCOMPLETE_DATA . Model::$PERSON_PREFIX]               = Format::encode(PersonTrait::getPrefixData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$PERSON_REFER]                = Format::encode(PersonTrait::getReferData());

        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_SCHOOL]              = Format::encode(StudentTrait::getSchoolData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_NIVEAU]              = Format::encode(StudentTrait::getNiveauData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_LEERJAAR]            = Format::encode(StudentTrait::getLeerjaarData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_BRANCH]              = Format::encode(StudentTrait::getBranchData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_PROFILE]             = Format::encode(StudentTrait::getProfileData());



        self::form_ac_data_customer($data);



        return view(Views::FORM_STUDENT_CREATE, $data);
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();
        $student                                                            = StudentTrait::create($data);

        if (!$student) {

            abort(500);

        }

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Student aangemaakt'),
            Key::PAGE_NEXT                                                  => route(Route::PERSON_VIEW, [Model::$PERSON_SLUG => $student->getUser->getPerson->{Model::$PERSON_SLUG}]),
            Key::PAGE_ACTION                                                => __('Naar de profielpagina'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





    public function edit($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();



        $data                                                               = [];

        $data[Model::$PERSON]                                               = $person;

        $data[Key::PAGE_TITLE]                                              = __('Leerling bewerken');
        $data[Key::SUBMIT_ACTION]                                           = __('Opslaan');
        $data[Key::SUBMIT_ROUTE]                                            = 'student.edit_submit';

        $data[Key::AUTOCOMPLETE_DATA . Model::$USER_LANGUAGE]               = Format::encode(Locale::getData_autocomplete());
        $data[Key::AUTOCOMPLETE_DATA . Model::$PERSON_PREFIX]               = Format::encode(PersonTrait::getPrefixData());

        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_SCHOOL]              = Format::encode(StudentTrait::getSchoolData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_NIVEAU]              = Format::encode(StudentTrait::getNiveauData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_LEERJAAR]            = Format::encode(StudentTrait::getLeerjaarData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT_PROFILE]             = Format::encode(StudentTrait::getProfileData());



        self::form_ac_data_customer($data);

        UserController::form_set_ac_data_status($data, $person->getUser);

        PersonController::form_set_ac_data_refer($data);



        return view(Views::FORM_PERSON_EDIT, $data);
    }



    public function edit_submit(Request $request) {

        $data                                                               = $request->all();
        $person                                                             = Person::find($data['_' . Model::$PERSON]);
        $student                                                            = $person->getUser->getStudent;

        StudentTrait::update($data, $student);

        UserTrait::update($data, $person->getUser);

        $person->refresh();

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Student gewijzigd'),
            Key::PAGE_NEXT                                                  => route('person.view', $person->{Model::$PERSON_SLUG}),
            Key::PAGE_ACTION                                                => __('Naar de profielpagina'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





    public function form_ac_data_customer(&$data) {

        $objects_customer                                                   = User::where(Model::$ROLE, RoleTrait::$ID_CUSTOMER)->with('getPerson')->with('getCustomer')->get();

        $ac_data_host                                                       = $objects_customer->pluck('getPerson.' . 'fullName', 'getCustomer.' . Model::$BASE_ID)->toArray();
        $ac_additional_host                                                 = $objects_customer->pluck(Model::$USER_EMAIL, 'getCustomer.' . Model::$BASE_ID)->toArray();

        $data[Key::AUTOCOMPLETE_DATA . Model::$CUSTOMER]                    = Format::encode($ac_data_host);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$CUSTOMER]              = Format::encode($ac_additional_host);
    }





    public function list(Request $request) {

        return Table::view($this, $request);

    }



    public function list_load(Request $request) {

        return Table::load($this, $request);

    }



    public function list_type() {

        return Model::$STUDENT;

    }



    public function list_view() {

        return Views::LIST_STUDENT;

    }



    public function list_title() {

        return __('Leerlingen');

    }



    public function list_columns($sort, $filter, $layout) {

        $columns                                            = [];

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
                if ($layout == 'desktop') {
                    array_push($columns,
                        Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 2, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 2, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3.5, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_CUSTOMER, self::list_column_label(self::$COLUMN_CUSTOMER), 3, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, true, $sort, true, $filter, true)
                    );
                } else if ($layout == 'mobile') {
                    array_push($columns,
                        Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 2, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 1, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, true, $sort, true, $filter, true)
                    );
                }
                break;

            case RoleTrait::$ID_EMPLOYEE:
                if ($layout == 'desktop') {
                    array_push($columns,
                        Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 2, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 2, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3.5, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, true, $sort, true, $filter, true)
                    );
                } else if ($layout == 'mobile') {
                    array_push($columns,
                        Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 2, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 1, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, true, $sort, true, $filter, true)
                    );
                }
                break;

            case RoleTrait::$ID_CUSTOMER:
                if ($layout == 'desktop') {
                    array_push($columns,
                        Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 2, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 2, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3.5, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, false, $sort, false, $filter, true)
                    );
                } else if ($layout == 'mobile') {
                    array_push($columns,
                        Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 2, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 1, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, true, $sort, true, $filter, true)
                    );
                }
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
                    case self::$COLUMN_NAME:                return __('Naam');
                    case self::$COLUMN_EMAIL:               return __('E-mailadres');
                    case self::$COLUMN_PHONE:               return __('Telefoonnummer');
                    case self::$COLUMN_NIVEAU:              return __('Niveau');
                    case self::$COLUMN_LEERJAAR:            return __('Leerjaar');
                    case self::$COLUMN_AGREEMENTS:          return __('Vakafspraken');
                    case self::$COLUMN_STATUS:              return __('Status');
                    case self::$COLUMN_CUSTOMER:            return __('Klant');
                    case self::$COLUMN_EMPLOYEE:            return __('Student-docent');
                }
                break;
        }

        return __('Onbekend');
    }



    public function list_value($student, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_NAME:

                return PersonTrait::getFullName($student->getUser->getPerson);

            case self::$COLUMN_EMAIL:

                return $student->getUser->{Model::$USER_EMAIL};

            case self::$COLUMN_PHONE:

                return $student->getUser->getPerson->{Model::$PERSON_PHONE};

            case self::$COLUMN_NIVEAU:

                return StudentTrait::getNiveauText($student->{Model::$STUDENT_NIVEAU});

            case self::$COLUMN_LEERJAAR:

                return $student->{Model::$STUDENT_LEERJAAR};

            case self::$COLUMN_AGREEMENTS:

                $agreements                                 = UserTrait::getAgreements($student->getUser, true);
                $subjects                                   = [];

                foreach ($agreements as $agreement) {

                    array_push($subjects, AgreementTrait::getVakcode($agreement));

                }

                switch (count($subjects)) {
                    case 0:                                 return __('Geen actief');
                    case 1:                                 return $subjects[0];
                    default:                                return $subjects[0] . ', ' . $subjects[1] . __(' en nog :count', ['count' => (count($subjects) - 2)]);
                }

            case self::$COLUMN_STATUS:

                $status = $student->getUser->{Model::$USER_STATUS};

                return "<div class='tag' style='background:" . UserTrait::getStatusColor($status) . ";color:" . UserTrait::getStatusTextColor($status) . "'>".UserTrait::getStatusText($status)."</div>";

            case self::$COLUMN_CUSTOMER:

                return StudentTrait::hasCustomer($student) ? PersonTrait::getFullName($student->getCustomer->getUser->getPerson) : __('Geen klant');

            default:

                return __('Onbekend');
        }
    }



    public function list_prepare($objects) {

        return $objects;

    }



    public function list_link($student) {

        return route('person.view', [Model::$PERSON_SLUG => $student->getUser->getPerson->{Model::$PERSON_SLUG}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

            if ($mode != Table::SORT_MODE_NONE) {

                switch ($column) {

                    case self::$COLUMN_NAME:
                        $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$STUDENT . '.' . Model::$USER);
                        $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                        $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, $mode);
                        break;

                    case self::$COLUMN_NIVEAU:
                        $query->orderBy(Model::$STUDENT_NIVEAU, $mode);
                        break;

                    case self::$COLUMN_LEERJAAR:
                        $query->orderBy(Model::$STUDENT_LEERJAAR, $mode);
                        break;

                    case self::$COLUMN_STATUS:
                        $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$STUDENT . '.' . Model::$USER);
                        $query->orderBy(Model::$USER . '.' . Model::$USER_STATUS, $mode);
                        break;
                }
            }
        }
    }



    public function list_sort_default($query) {

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
            case RoleTrait::$ID_STUDENT:
            case RoleTrait::$ID_CUSTOMER:
                $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$STUDENT . '.' . Model::$USER);
                $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, Table::SORT_MODE_ASC);
                break;
        }
    }



    public function list_filter($query, $filter) {

        foreach ($filter as $column => $value) {

            switch ($column) {

                case self::$COLUMN_NIVEAU:
                    $query->where(Model::$STUDENT_NIVEAU, $value);
                    break;

                case self::$COLUMN_LEERJAAR:
                    $query->where(Model::$STUDENT_LEERJAAR, $value);
                    break;

                case self::$COLUMN_AGREEMENTS:
                    $query->whereHas('getUser.getAgreements_asStudent', function (Builder $q) use ($value) {

                        $q->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));
                        $q->where(Model::$SUBJECT, $value);
                    });
                    break;

                case self::$COLUMN_STATUS:
                    $query->whereHas('getUser', function (Builder $q) use ($value) {$q->where(Model::$USER_STATUS, $value);});
                    break;

                case self::$COLUMN_CUSTOMER:
                    $query->whereHas('getCustomer.getUser', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_EMPLOYEE:
                    $query->whereHas('getUser.getAgreements_asStudent', function (Builder $q1) use ($value) {

                        $q1->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));
                        $q1->whereHas('getEmployee', function (Builder $q2) use ($value) {

                            $q2->where(Model::$USER . '.' . Model::$BASE_ID, $value);

                        });
                    });
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
            case RoleTrait::$ID_MANAGEMENT:
                // TODO: ADD AREA FILTER FOR MANAGEMENT
                break;

            case RoleTrait::$ID_EMPLOYEE:
                $query->whereHas('getUser.getAgreements_asStudent', function (Builder $q1) {

                    $q1->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));
                    $q1->whereHas('getEmployee', function (Builder $q2) {

                        $q2->where(Model::$USER . '.' . Model::$BASE_ID, Auth::id());

                    });
                });
                break;

            case RoleTrait::$ID_CUSTOMER:
                $query->whereHas('getCustomer.getUser', function (Builder $q) {$q->where(Model::$BASE_ID, Auth::id());});
                break;
        }
    }



    public function list_filter_parameter(&$data_filter, $parameter, $value) {

        $id_person                                                  = Person::where(Model::$PERSON_SLUG, $value)->firstOrFail()->getUser->{Model::$BASE_ID};

        switch ($parameter) {

            case self::$PARAMETER_CUSTOMER:
                $data_filter->{self::$COLUMN_CUSTOMER}              = $id_person;
                break;

            case self::$PARAMETER_EMPLOYEE:
                $data_filter->{self::$COLUMN_EMPLOYEE}              = $id_person;
                break;
        }
    }



    public function list_filter_data($query, $column) {

        switch ($column->{Model::$BASE_ID}) {

            case self::$COLUMN_NIVEAU:

                return StudentTrait::getNiveauData();

            case self::$COLUMN_LEERJAAR:

                return StudentTrait::getLeerjaarData();

            case self::$COLUMN_AGREEMENTS:

                return Subject::all()->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();

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

                case self::$COLUMN_LEERJAAR:
                    $display                                = $value;
                    break;

                case self::$COLUMN_NIVEAU:
                    $display                                = StudentTrait::getNiveauText($value);
                    break;

                case self::$COLUMN_AGREEMENTS:
                    $display                                = Subject::find($value)->{Model::$SUBJECT_NAME};
                    break;

                case self::$COLUMN_STATUS:
                    $display                                = UserTrait::getStatusText($value);
                    break;

                case self::$COLUMN_CUSTOMER:
                case self::$COLUMN_EMPLOYEE:
                    $display                                = PersonTrait::getFullName(User::find($value)->getPerson);
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
                ->select('student.*')
                ->get()
                ->count()
        ]);
    }





}
