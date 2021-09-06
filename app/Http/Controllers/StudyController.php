<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Table;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\ServiceTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\SubjectTrait;
use App\Models\Agreement;
use App\Models\Location;
use App\Models\Person;
use App\Models\Service;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Study;
use App\Models\User;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;



class StudyController extends Controller {





    use BaseTrait;





    public static

        $COLUMN_DATE                                                        = 101,
        $COLUMN_STUDENT                                                     = 102,
        $COLUMN_HOST                                                        = 103,
        $COLUMN_SUBJECT                                                     = 104,
        $COLUMN_SERVICE                                                     = 105,
        $COLUMN_LOCATION                                                    = 106,
        $COLUMN_TIME                                                        = 107,
        $COLUMN_STATUS                                                      = 108,

        $PARAMETER_CUSTOMER                                                 = "klant",
        $PARAMETER_PARTICIPANT                                              = "deelnemer",
        $PARAMETER_HOST                                                     = "host",

        $STUDY_PLAN_LOCATION_HOST                                           = -1;





    public function view($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                                 => $study->getService->{Model::$SERVICE_NAME},
            Key::PAGE_BACK                                                  => true,

            Model::$STUDY                                                   => $study
        ]);
    }





    public function plan() {

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = 'Les inplannen';
        $data[Key::SUBMIT_ACTION]                                           = 'Inplannen';
        $data[Key::SUBMIT_ROUTE]                                            = 'study.plan_submit';



        self::form_set_ac_data_location($data);

        self::form_set_ac_data_host($data);



        return view(Views::FORM_STUDY_PLAN, $data);
    }





    public function plan_submit(Request $request) {

        $study                                                              = null;
        $data                                                               = $request->all();

        StudyTrait::create($data, $study);

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }





    public function edit($key) {

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = 'Les bewerken';
        $data[Key::SUBMIT_ACTION]                                           = 'Opslaan';
        $data[Key::SUBMIT_ROUTE]                                            = 'study.edit_submit';



        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();
        $data[Model::$STUDY]                                                = $study;



        self::form_set_ac_data_status($data, $study);

        self::form_set_ac_data_location($data, $study);



        return view(Views::FORM_STUDY_EDIT, $data);
    }



    public function edit_submit(Request $request) {

        $data                                                               = $request->all();
        $study                                                              = Study::find($data['_' . Model::$STUDY]);

        StudyTrait::update($data, $study);

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }





    public function delete($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        $study->delete();

        return redirect()->route('study.list');
    }





    public function report($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::FORM_REPORT, [

            Key::PAGE_TITLE                                                 => 'Les rapporteren',
            Key::SUBMIT_ACTION                                              => 'Rapporteren',
            Key::SUBMIT_ROUTE                                               => 'study.report_submit',

            Model::$STUDY                                                   => $study
        ]);
    }



    public function report_submit(Request $request) {

        $data                                                               = $request->all();

        $study                                                              = Study::find($data['_' . Model::$STUDY]);

        self::report_validate($data);

        if (ReportTrait::create($data, $study) && StudyTrait::isReported($study)) {

            $study->{Model::$STUDY_STATUS}                                  = StudyTrait::$STATUS_REPORTED;

            $study->save();
        }

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }



    public function report_validate(array $data) {

        $messages                                                           = [
            'required'                                                      => 'Dit veld is verplicht.',
            'max'                                                           => 'Gebruik maximaal 1000 karakters.'
        ];



        $rules                                                              = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, [Model::$REPORT_CONTENT_VOORTGANG, Model::$REPORT_CONTENT_UITDAGINGEN, Model::$REPORT_CONTENT_VOLGENDE_LES])) {

                $rules[$key]                                                = ['required', 'max:999'];

            }

            if (Func::contains($key, Model::$REPORT_SUBJECT_VERSLAG)) {

                // TODO: FINISH
                // Only add to rules if field belongs to primary subject or report for this user has secondary subject

            }
        }



        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
    }





    public function form_set_ac_data_location(&$data, $study = null) {



        /** OPTIONS BASED ON HOST **/

        $ac_data                                                            = Location::with('getAddress')->get()->pluck(Model::$LOCATION_NAME, 'getAddress.' . Model::$BASE_ID)->toArray();

        $ac_data[self::$STUDY_PLAN_LOCATION_HOST]                           = self::hasManagementRights() ? 'Thuis bij de Student-docent' : 'Thuis bij jou (' . Auth::user()->getPerson->{Model::$PERSON_FIRST_NAME} . ')';

        $students                                                           = self::hasManagementRights() ? User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)->get() : Auth::user()->getStudents;

        foreach ($students as $student) {

            $address                                                        = $student->getPerson->getAddress;

            if ($address) {

                $ac_data[$address->{Model::$BASE_ID}]                       = 'Thuis bij ' . PersonTrait::getFullName($student->getPerson);

            }
        }



        /** SET CURRENT LOCATION **/

        if ($study && strlen($study->{Model::$STUDY_LOCATION_TEXT}) > 0) {

            $current_found                                                  = false;

            foreach ($ac_data as $key => $value) {

                if ($study->{Model::$STUDY_LOCATION_TEXT} == $value) {

                    $data[Key::CURRENT . '_' . Model::$LOCATION]            = $key;
                    $current_found                                          = true;
                }
            }

            if (!$current_found) {

                $ac_data[Key::CURRENT_ID]                                   = $study->{Model::$STUDY_LOCATION_TEXT};
                $data[Key::CURRENT . '_' . Model::$LOCATION]                = Key::CURRENT_ID;
            }
        }



        $data[Key::AUTOCOMPLETE_DATA . Model::$LOCATION]                    = Format::encode($ac_data);
    }



    public function form_set_ac_data_status(&$data, $study) {

        $ac_data                                                            = [];

        if (StudyTrait::isReported($study)) {

            $ac_data[StudyTrait::$STATUS_REPORTED]                          = StudyTrait::getStatusText(StudyTrait::$STATUS_REPORTED);

        } else {

            $ac_data[StudyTrait::$STATUS_PLANNED]                           = StudyTrait::getStatusText(StudyTrait::$STATUS_PLANNED);
            $ac_data[StudyTrait::$STATUS_CANCELLED]                         = StudyTrait::getStatusText(StudyTrait::$STATUS_CANCELLED);
            $ac_data[StudyTrait::$STATUS_ABSENT]                            = StudyTrait::getStatusText(StudyTrait::$STATUS_ABSENT);
        }

        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDY_STATUS]                = Format::encode($ac_data);
    }



    public function form_set_ac_data_host(&$data) {

        if (self::hasManagementRights()) {

            $objects_host                                                   = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_EMPLOYEE, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_BOARD))->with('getPerson')->get();

            $ac_data_host                                                   = $objects_host->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
            $ac_additional_host                                             = $objects_host->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

            $data[Key::AUTOCOMPLETE_DATA . 'host']                          = Format::encode($ac_data_host);
            $data[Key::AUTOCOMPLETE_ADDITIONAL . 'host']                    = Format::encode($ac_additional_host);
        }
    }



    public function form_report_subjects_load(Request $request) {

        $time_available                                                     = $request->input('time_available', null);
        $study_id                                                           = $request->input(Model::$STUDY, null);
        $user_id                                                            = $request->input(Model::$USER, null);
        $agreement_id                                                       = $request->input(Model::$AGREEMENT, null);

        $study                                                              = Study::find($study_id);
        $user                                                               = User::find($user_id);
        $agreement                                                          = Agreement::find($agreement_id);

        $objects_subject_primary                                            = Subject::all();
        $objects_subject_secondary                                          = SubjectTrait::getActivities();

        $ac_data_subject_primary                                            = $objects_subject_primary->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();
        $ac_additional_subject_primary                                      = $objects_subject_primary->pluck(Model::$SUBJECT_CODE, Model::$BASE_ID)->toArray();

        $ac_data_subject_secondary                                          = $objects_subject_secondary->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();
        $ac_additional_subject_secondary                                    = $objects_subject_secondary->pluck(Model::$SUBJECT_CODE, Model::$BASE_ID)->toArray();

        return view(Views::LOAD_SUBJECTS, [

            Model::$STUDY                                                   => $study,
            Model::$USER                                                    => $user,
            Model::$AGREEMENT                                               => $agreement,

            'time_available'                                                => $time_available,

            Key::AUTOCOMPLETE_DATA . Model::$SUBJECT . '_primary'           => Format::encode($ac_data_subject_primary),
            Key::AUTOCOMPLETE_ADDITIONAL . Model::$SUBJECT . '_primary'     => Format::encode($ac_additional_subject_primary),

            Key::AUTOCOMPLETE_DATA . Model::$SUBJECT . '_secondary'         => Format::encode($ac_data_subject_secondary),
            Key::AUTOCOMPLETE_ADDITIONAL . Model::$SUBJECT . '_secondary'   => Format::encode($ac_additional_subject_secondary)
        ]);
    }





    public function list(Request $request) {

        return Table::view($this, $request);

    }



    public function list_load(Request $request) {

        return Table::load($this, $request);

    }



    public function list_type() {

        return Model::$STUDY;

    }



    public function list_view() {

        return Views::LIST_STUDY;

    }



    public function list_title() {

        return 'Lessen';

    }



    public function list_columns($sort, $filter) {

        $columns                                                    = [];

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_CUSTOMER:
                array_push($columns,
                    Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 3, true, $sort, true, $filter, true),
                    Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 4, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 4, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 3, true, $sort, true, $filter, true),
                    Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 4, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                );
                break;

            case RoleTrait::$ID_EMPLOYEE:
                array_push($columns,
                    Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 2, true, $sort, true, $filter, true),
                    Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 2, true, $sort, true, $filter, true),
                    Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 2, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                );
                break;

            case RoleTrait::$ID_STUDENT:
                array_push($columns,
                    Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 2, true, $sort, true, $filter, true),
                    Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 3, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 2, true, $sort, true, $filter, true),
                    Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 2, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                );
                break;

            default:

                break;
        }

        return $columns;
    }



    public function list_column_label($column) {

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_CUSTOMER:
                switch ($column) {
                    case self::$COLUMN_DATE:                        return 'Datum';
                    case self::$COLUMN_STUDENT:                     return 'Leerling';
                    case self::$COLUMN_HOST:                        return 'Student';
                    case self::$COLUMN_SERVICE:                     return 'Dienst';
                    case self::$COLUMN_SUBJECT:                     return 'Onderwerp';
                    case self::$COLUMN_LOCATION:                    return 'Locatie';
                    case self::$COLUMN_TIME:                        return 'Tijdstip';
                    case self::$COLUMN_STATUS:                      return 'Status';
                }
                break;

            case RoleTrait::$ID_EMPLOYEE:
                switch ($column) {
                    case self::$COLUMN_DATE:                        return 'Datum';
                    case self::$COLUMN_STUDENT:                     return 'Leerling';
                    case self::$COLUMN_SERVICE:                     return 'Type';
                    case self::$COLUMN_SUBJECT:                     return 'Vak';
                    case self::$COLUMN_LOCATION:                    return 'Locatie';
                    case self::$COLUMN_TIME:                        return 'Tijdstip';
                    case self::$COLUMN_STATUS:                      return 'Status';
                }
                break;

            case RoleTrait::$ID_STUDENT:
                switch ($column) {
                    case self::$COLUMN_DATE:                        return 'Datum';
                    case self::$COLUMN_HOST:                        return 'Student-docent';
                    case self::$COLUMN_SERVICE:                     return 'Type';
                    case self::$COLUMN_SUBJECT:                     return 'Vak';
                    case self::$COLUMN_LOCATION:                    return 'Locatie';
                    case self::$COLUMN_TIME:                        return 'Tijdstip';
                    case self::$COLUMN_STATUS:                      return 'Status';
                }
                break;
        }

        return Key::UNKNOWN;
    }



    public function list_value($study, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_DATE:

                return $study->{Model::$STUDY_START} != null ? "<div style='font-weight: 400'>" . Format::datetime($study->{Model::$STUDY_START}, Format::$DATETIME_LIST) . "</div>" : Key::UNKNOWN;

            case self::$COLUMN_STUDENT:

                $participants                                       = StudyTrait::getParticipants_Person($study);

                switch(count($participants)) {
                    case 0:                                         return "Geen deelnemers";
                    case 1:                                         return PersonTrait::getFullName($participants[0]);
                    case 2:                                         return $participants[0]->{Model::$PERSON_FIRST_NAME} . " en " . $participants[1]->{Model::$PERSON_FIRST_NAME};
                    case 3:                                         return $participants[0]->{Model::$PERSON_FIRST_NAME} . ", " . $participants[1]->{Model::$PERSON_FIRST_NAME} . " en " . $participants[2]->{Model::$PERSON_FIRST_NAME};
                    default:                                        return count($participants) . " deelnemers";
                }

            case self::$COLUMN_HOST:

                return PersonTrait::getFullName($study->getHost->getPerson);

            case self::$COLUMN_SERVICE:

                return $study->getService->{Model::$SERVICE_NAME} . ($study->{Model::$STUDY_TRIAL} ? '&nbsp;&nbsp;<span style="color:#FF0000">(Proefles)</span>' : '');

            case self::$COLUMN_SUBJECT:

                switch ($study->{Model::$SERVICE}) {

                    case ServiceTrait::$ID_COLLEGE:
                    case ServiceTrait::$ID_TRAINING:

                        return $study->{Model::$STUDY_SUBJECT_TEXT};

                    case ServiceTrait::$ID_GROEPSLES:
                    case ServiceTrait::$ID_PRIVELES:

                        $subjects                                   = "";

                        foreach ($study->getAgreements as $agreement) {

                            $subjects                              .= (strlen($subjects) > 0 ? ', ' : '') . AgreementTrait::getVakcode($agreement);

                        }

                        return $subjects;
                }

                return $study->{Model::$STUDY_SUBJECT_TEXT};

            case self::$COLUMN_LOCATION:

                return StudyTrait::hasLink($study) ? "Digitaal (Zoom)" : $study->{Model::$STUDY_LOCATION_TEXT};

            case self::$COLUMN_TIME:

                return StudyTrait::getTimeText($study);

            case self::$COLUMN_STATUS:

                return "<div class='tag' style='background:" . StudyTrait::getStatusColor(StudyTrait::getStatus($study)) . ";color:" . StudyTrait::getStatusTextColor($study) . "'>".StudyTrait::getStatusText(StudyTrait::getStatus($study))."</div>";

            default:

                return Key::UNKNOWN;
        }
    }



    public function list_link($study) {

        return route('study.view', [Model::$BASE_KEY => $study->{Model::$BASE_KEY}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

            switch ($column) {

                case self::$COLUMN_DATE:
                    $query->orderBy(Model::$STUDY_START, $mode);
                    break;

                case self::$COLUMN_HOST:
                    $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$STUDY . '.' . Model::$STUDY_HOST_USER);
                    $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                    $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, $mode);
                    break;

                case self::$COLUMN_SERVICE:
                    $query->join(Model::$SERVICE, Model::$SERVICE . '.' . Model::$BASE_ID, '=', Model::$STUDY . '.' . Model::$SERVICE);
                    $query->orderBy(Model::$SERVICE . '.' . Model::$SERVICE_NAME, $mode);
                    break;

                case self::$COLUMN_TIME:
                    $query->orderBy(Model::$STUDY_START, $mode);
                    $query->orderBy(Model::$STUDY_END, $mode);
                    break;

                case self::$COLUMN_STATUS:
                    $query->orderBy(Model::$STUDY_STATUS, $mode);
                    $query->orderBy(Model::$STUDY_START, $mode == Table::SORT_MODE_DESC ? TABLE::SORT_MODE_ASC : Table::SORT_MODE_DESC);
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
                $query->orderBy(Model::$STUDY_START, Table::SORT_MODE_DESC);
                break;
        }
    }



    public function list_filter($query, $filter) {

        foreach ($filter as $column => $value) {

            switch ($column) {

                dd($value);

                case self::$COLUMN_DATE:
                    $query->where(Model::$STUDY_START, '>=', substr($value, 0, 10))->where(Model::$STUDY_END, '<=', substr($value, 10, 10));
                    break;

                case self::$COLUMN_STUDENT:
                    $query->whereHas('getParticipants_User', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_HOST:
                    $query->where(Model::$STUDY_HOST_USER, $value);
                    break;

                case self::$COLUMN_SERVICE:
                    $query->where(Model::$SERVICE, $value);
                    break;

                case self::$COLUMN_SUBJECT:
                    $query->whereHas('getAgreements', function (Builder $q) use ($value) {$q->where(Model::$SUBJECT, $value);});
                    break;

                case self::$COLUMN_STATUS:

                    switch ($value) {

                        case StudyTrait::$STATUS_ACTIVE:
                            $query->where(Model::$STUDY_STATUS, StudyTrait::$STATUS_PLANNED);
                            $query->where(Model::$STUDY_START, '<', date(Format::$DATABASE_DATETIME, time()));
                            $query->where(Model::$STUDY_END, '>', date(Format::$DATABASE_DATETIME, time()));
                            break;

                        case StudyTrait::$STATUS_FINISHED:
                            $query->where(Model::$STUDY_STATUS, StudyTrait::$STATUS_PLANNED);
                            $query->where(Model::$STUDY_END, '<', date(Format::$DATABASE_DATETIME, time()));
                            break;

                        case StudyTrait::$STATUS_PLANNED:
                            $query->where(Model::$STUDY_STATUS, StudyTrait::$STATUS_PLANNED);
                            $query->where(Model::$STUDY_START, '>', date(Format::$DATABASE_DATETIME, time()));
                            break;

                        default:
                            $query->where(Model::$STUDY_STATUS, $value);
                            break;
                    }
                    break;

                case StudentController::$COLUMN_CUSTOMER:
                    $query->whereHas('getParticipants_User.getStudent.getCustomer.getUser', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
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
                $query->where(Model::$STUDY_HOST_USER, Auth::id());
                break;

            case RoleTrait::$ID_STUDENT:
                $query->whereHas('getParticipants_User', function (Builder $q) {$q->where(Model::$BASE_ID, Auth::id());});
                break;

            case RoleTrait::$ID_CUSTOMER:
                $query->whereHas('getParticipants_User.getStudent.getCustomer.getUser', function (Builder $q) {$q->where(Model::$BASE_ID, Auth::id());});
                break;
        }
    }



    public function list_filter_parameter(&$data_filter, $parameter, $value) {

        $id_person                                                  = Person::where(Model::$PERSON_SLUG, $value)->firstOrFail()->getUser->{Model::$BASE_ID};

        switch ($parameter) {

            case self::$PARAMETER_CUSTOMER:
                $data_filter->{StudentController::$COLUMN_CUSTOMER} = $id_person;
                break;

            case self::$PARAMETER_PARTICIPANT:
                $data_filter->{self::$COLUMN_STUDENT}               = $id_person;
                break;

            case self::$PARAMETER_HOST:
                $data_filter->{self::$COLUMN_HOST}                  = $id_person;
                break;
        }
    }



    public function list_filter_data($query, $column) {

        switch ($column->{Model::$BASE_ID}) {

            case self::$COLUMN_STUDENT:

                switch (self::getUserRole()) {

                    // TODO: ADD AREA FILTER FOR MANAGEMENT

                    case RoleTrait::$ID_ADMINISTRATOR:
                    case RoleTrait::$ID_BOARD:
                    case RoleTrait::$ID_MANAGEMENT:

                        return User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)
                            ->with('getPerson')
                            ->get()
                            ->pluck('getPerson.' . 'fullName', Model::$BASE_ID)
                            ->toArray();

                    case RoleTrait::$ID_EMPLOYEE:

                        return User::whereHas('getAgreements_asStudent', function ($q) {

                            $q->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));
                            $q->where(Model::$EMPLOYEE, Auth::id());

                        })
                            ->with('getPerson')
                            ->get()
                            ->pluck('getPerson.' . 'fullName', Model::$BASE_ID)
                            ->toArray();

                    case RoleTrait::$ID_CUSTOMER:

                        return User::whereHas('getStudent.getCustomer', function ($q) {$q->where(Model::$USER, Auth::id());})
                            ->with('getPerson')
                            ->get()
                            ->pluck('getPerson.' . 'fullName', Model::$BASE_ID)
                            ->toArray();

                    default:

                        return [];
                }

            case self::$COLUMN_HOST:

                return $query
                    ->with('getHost_User.getPerson')
                    ->get()
                    ->pluck('getHost_User.getPerson.' . 'fullName', 'getHost_User.' . Model::$BASE_ID)
                    ->toArray();

            case self::$COLUMN_SERVICE:

                return $query
                    ->with('getService')
                    ->get()
                    ->pluck('getService.' . Model::$SERVICE_NAME, 'getService.' . Model::$BASE_ID)
                    ->toArray();

            case self::$COLUMN_SUBJECT:

                return Subject::get()->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();

            case self::$COLUMN_STATUS:

                return StudyTrait::getStatusFilterData();

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

                case self::$COLUMN_DATE:
                    $display                                = Format::datetime(new DateTime(substr($value, 0, 8)), Format::$DATETIME_LIST);
                    break;

                case self::$COLUMN_STUDENT:
                case self::$COLUMN_HOST:
                case StudentController::$COLUMN_CUSTOMER:
                    $display                                = PersonTrait::getFullName(User::find($value)->getPerson);
                    break;

                case self::$COLUMN_SERVICE:
                    $display                                = Service::find($value)->{Model::$SERVICE_NAME};
                    break;

                case self::$COLUMN_SUBJECT:
                    $display                                = Subject::find($value)->{Model::$SUBJECT_NAME};
                    break;

                case self::$COLUMN_STATUS:
                    $display                                = StudyTrait::getStatusText($value);
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

            case StudentController::$COLUMN_CUSTOMER:

                return StudentController::list_column_label($filter);

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
                ->select('study.*')
                ->get()
                ->count()
        ]);

        array_push($counters, (object) [
            Table::COUNTER_LABEL                            => 'Gerapporteerd',
            Table::COUNTER_VALUE                            => $query
                ->where(Model::$STUDY_STATUS, StudyTrait::$STATUS_REPORTED)
                ->select('study.*')
                ->get()
                ->count()
        ]);

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }





}
