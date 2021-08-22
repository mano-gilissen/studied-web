<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Table;
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
        $COLUMN_MIN_MAX                                                     = 207,
        $COLUMN_STATUS                                                      = 208,
        $COLUMN_CUSTOMER                                                    = 209,
        $COLUMN_EMPLOYEE                                                    = 210,

        $PARAMETER_CUSTOMER                                                 = "klant",
        $PARAMETER_EMPLOYEE                                                 = "medewerker";





    public function create() {

        return view(Views::FORM_STUDENT_CREATE, [

            Key::PAGE_TITLE                                                 => 'Leerling aanmaken',
            Key::SUBMIT_ACTION                                              => 'Aanmaken',
            Key::SUBMIT_ROUTE                                               => 'student.create_submit',

            Key::AUTOCOMPLETE_DATA . Model::$PERSON_PREFIX                  => Format::encode(PersonTrait::getPrefixData()),

            Key::AUTOCOMPLETE_DATA . Model::$STUDENT_SCHOOL                 => Format::encode(StudentTrait::getSchoolData()),
            Key::AUTOCOMPLETE_DATA . Model::$STUDENT_NIVEAU                 => Format::encode(StudentTrait::getNiveauData()),
            Key::AUTOCOMPLETE_DATA . Model::$STUDENT_LEERJAAR               => Format::encode(StudentTrait::getLeerjaarData()),
            Key::AUTOCOMPLETE_DATA . Model::$STUDENT_PROFILE                => Format::encode(StudentTrait::getProfileData()),
        ]);
    }



    public function create_submit(Request $request) {

        $student                                                            = null;
        $data                                                               = $request->all();

        self::create_validate($data);

        StudentTrait::create($data, $student);

        return redirect()->route('person.view', [Model::$PERSON_SLUG => $student->getUser->getPerson->{Model::$PERSON_SLUG}]);
    }



    public function create_validate(array $data) {

        $messages                                                           = [];
        $messages['required']                                               = 'Dit veld is verplicht.';
        $messages['zipcode.max']                                            = 'Vul een geldige postcode in.';

        $rules                                                              = [];

        $rules[Model::$PERSON_PREFIX]                                       = ['required'];
        $rules[Model::$PERSON_FIRST_NAME]                                   = ['required'];
        $rules[Model::$PERSON_LAST_NAME]                                    = ['required'];
        $rules[Model::$PERSON_BIRTH_DATE]                                   = ['required'];

        $rules[Model::$USER_EMAIL]                                          = ['required', 'email'];

        $rules[Model::$ADDRESS_STREET]                                      = ['required'];
        $rules[Model::$ADDRESS_NUMBER]                                      = ['required'];
        $rules[Model::$ADDRESS_ZIPCODE]                                     = ['required', 'max:20'];
        $rules[Model::$ADDRESS_CITY]                                        = ['required'];
        $rules[Model::$ADDRESS_COUNTRY]                                     = ['required'];

        $rules[Model::$STUDENT_SCHOOL]                                      = ['required'];
        $rules[Model::$STUDENT_NIVEAU]                                      = ['required'];
        $rules[Model::$STUDENT_LEERJAAR]                                    = ['required'];

        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
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

        return 'Leerlingen';

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
                    Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 2, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 2, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_MIN_MAX, self::list_column_label(self::$COLUMN_MIN_MAX), 2, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_CUSTOMER, self::list_column_label(self::$COLUMN_CUSTOMER), 3, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, true, $sort, true, $filter, true)
                );
                break;

            case RoleTrait::$ID_EMPLOYEE:
                array_push($columns,
                    Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 2, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 2, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_MIN_MAX, self::list_column_label(self::$COLUMN_MIN_MAX), 2, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, true, $sort, true, $filter, true)
                );
                break;

            case RoleTrait::$ID_CUSTOMER:
                array_push($columns,
                    Table::column(self::$COLUMN_NAME, self::list_column_label(self::$COLUMN_NAME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_EMAIL, self::list_column_label(self::$COLUMN_EMAIL), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_PHONE, self::list_column_label(self::$COLUMN_PHONE), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_NIVEAU, self::list_column_label(self::$COLUMN_NIVEAU), 2, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_LEERJAAR, self::list_column_label(self::$COLUMN_LEERJAAR), 2, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_AGREEMENTS, self::list_column_label(self::$COLUMN_AGREEMENTS), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_MIN_MAX, self::list_column_label(self::$COLUMN_MIN_MAX), 2, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 2, false, $sort, false, $filter, true)
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
                    case self::$COLUMN_NIVEAU:              return "Niveau";
                    case self::$COLUMN_LEERJAAR:            return "Leerjaar";
                    case self::$COLUMN_AGREEMENTS:          return "Vakafspraken";
                    case self::$COLUMN_MIN_MAX:             return "MIN/MAX";
                    case self::$COLUMN_STATUS:              return "Status";
                    case self::$COLUMN_CUSTOMER:            return 'Klant';
                    case self::$COLUMN_EMPLOYEE:            return 'Student-docent';
                }
                break;
        }

        return Key::UNKNOWN;
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

                $agreements                                 = $student->getUser->getAgreements_asStudent;
                $subjects                                   = [];

                if (count($agreements) == 0) {

                    return "Geen actief";

                }

                foreach ($agreements as $agreement) {

                    array_push($subjects, AgreementTrait::getVakcode($agreement));

                }

                return implode(", ", $subjects);

            case self::$COLUMN_MIN_MAX:

                $agreements                                 = $student->getUser->getAgreements_asStudent;
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

                $status = $student->getUser->{Model::$USER_STATUS};

                return "<div class='tag' style='background:" . UserTrait::getStatusColor($status) . ";color:" . UserTrait::getStatusTextColor($status) . "'>".UserTrait::getStatusText($status)."</div>";

            case self::$COLUMN_CUSTOMER:

                return StudentTrait::hasCustomer($student) ? PersonTrait::getFullName($student->getCustomer->getUser->getPerson) : "Geen klant";

            default:

                return Key::UNKNOWN;
        }
    }



    public function list_link($student) {

        return route('person.view', [Model::$PERSON_SLUG => $student->getUser->getPerson->{Model::$PERSON_SLUG}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

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
                    $query->whereHas('getUser.getAgreements_asStudent.getSubject', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_STATUS:
                    $query->whereHas('getUser', function (Builder $q) use ($value) {$q->where(Model::$USER_STATUS, $value);});
                    break;

                case self::$COLUMN_CUSTOMER:
                    $query->whereHas('getCustomer.getUser', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_EMPLOYEE:
                    $query->whereHas('getUser.getAgreements_asStudent.getEmployee', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
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

            case RoleTrait::$ID_EMPLOYEE:
                $query->whereHas('getUser.getAgreements_asStudent.getEmployee', function (Builder $q) {$q->where(Model::$BASE_ID, Auth::id());});
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

                case self::$COLUMN_LEERJAAR:
                    $display                                = $value;
                    break;

                case self::$COLUMN_NIVEAU:
                    $display                                = StudentTrait::getNiveauText($value);
                    break;

                case self::$COLUMN_AGREEMENTS:
                    $display                                = 'Vakafspraak';
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

        $query                                              = Table::query($this, $sort, $filter);
        $counters                                           = [];

        array_push($counters, (object) [
            Table::COUNTER_LABEL                            => 'Totaal',
            Table::COUNTER_VALUE                            => $query
                ->select('student.*')
                ->get()
                ->count()
        ]);

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }





}
