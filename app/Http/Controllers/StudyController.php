<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Table;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\SubjectTrait;
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
        $PARAMETER_HOST                                                     = "host";





    public function view($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                                 => $study->getService->{Model::$SERVICE_NAME},
            Key::PAGE_BACK                                                  => true,

            Model::$STUDY                                                   => $study
        ]);
    }





    public function plan() {

        $objects_location                                                   = Location::all();
        $objects_host                                                       = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_EMPLOYEE, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_BOARD))->with('getPerson')->get();

        $ac_data_location                                                   = $objects_location->pluck(Model::$LOCATION_NAME, Model::$BASE_ID)->toArray();
        $ac_data_host                                                       = $objects_host->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();

        $ac_additional_host                                                 = $objects_host->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        return view(Views::FORM_STUDY, [

            Key::PAGE_TITLE                                                 => 'Les inplannen',
            Key::SUBMIT_ACTION                                              => 'Inplannen',
            Key::SUBMIT_ROUTE                                               => 'study.plan_submit',

            Key::AUTOCOMPLETE_DATA.Model::$LOCATION                         => Format::encode($ac_data_location),
            Key::AUTOCOMPLETE_DATA.'host'                                   => Format::encode($ac_data_host),

            Key::AUTOCOMPLETE_ADDITIONAL.'host'                             => Format::encode($ac_additional_host),
        ]);
    }



    public function plan_submit(Request $request) {

        $study                                                              = null;
        $data                                                               = $request->all();

        // self::plan_validate($data);

        StudyTrait::create($data, $study);

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }



    public function plan_validate(array $data) {

        $messages = [
            'subject.required'                                              => 'Vul een onderwerp in.',
        ];

        $validator = Validator::make($data, [
            'subject'                                                       => ['bail', 'required'],
        ], $messages);

        $validator->validate();
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
            'required'                                                      => 'Vul een onderwerp in.',
            'max'                                                           => 'Gebruik maximaal 1000 karakters.'
        ];

        $rules                                                              = [];

        $fields_open_text                                                   = [
            Model::$REPORT_CONTENT_VOORTGANG,
            Model::$REPORT_CONTENT_UITDAGINGEN,
            Model::$REPORT_CONTENT_VOLGENDE_LES,
            Model::$REPORT_SUBJECT_VERSLAG
        ];

        foreach ($data as $key) {

            dd(Func::contains('user_1_content_volgende_les', $fields_open_text));

            if (Func::contains($key, $fields_open_text)) {

                $rules[$key]                                                = ['required|max:999'];

            }
        }

        dd('b');

        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
    }



    public function form_report_subjects_load(Request $request) {

        $time_available                                                     = $request->input('time_available', null);
        $study_id                                                           = $request->input(Model::$STUDY, null);
        $user_id                                                            = $request->input(Model::$USER, null);

        $study                                                              = Study::find($study_id);
        $user                                                               = User::find($user_id);

        $objects_subject_primary                                            = Subject::all();
        $objects_subject_secondary                                          = SubjectTrait::getActivities();

        $ac_data_subject_primary                                            = $objects_subject_primary->pluck(Model::$SUBJECT_DESCRIPTION_SHORT, Model::$BASE_ID)->toArray();
        $ac_additional_subject_primary                                      = $objects_subject_primary->pluck(Model::$SUBJECT_CODE, Model::$BASE_ID)->toArray();

        $ac_data_subject_secondary                                          = $objects_subject_secondary->pluck(Model::$SUBJECT_DESCRIPTION_SHORT, Model::$BASE_ID)->toArray();
        $ac_additional_subject_secondary                                    = $objects_subject_secondary->pluck(Model::$SUBJECT_CODE, Model::$BASE_ID)->toArray();

        return view(Views::LOAD_SUBJECTS, [

            Model::$STUDY                                                   => $study,
            Model::$USER                                                    => $user,

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

        $columns                                            = [];

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_CUSTOMER:
                array_push($columns,
                    Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 3, true, $sort, false, $filter, true),
                    Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 4, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 4, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 3, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 4, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                );
                break;

            case RoleTrait::$ID_EMPLOYEE:
                array_push($columns,
                    Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 2, true, $sort, false, $filter, true),
                    Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 3, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 2, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 2, false, $sort, true, $filter),
                    Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 3, false, $sort, false, $filter),
                    Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                    Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                );
                break;

            case RoleTrait::$ID_STUDENT:
                array_push($columns,
                    Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 2, true, $sort, false, $filter, true),
                    Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 3, true, $sort, true, $filter),
                    Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 2, true, $sort, true, $filter),
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
                    case self::$COLUMN_DATE:                return 'Datum';
                    case self::$COLUMN_STUDENT:             return 'Leerling';
                    case self::$COLUMN_HOST:                return 'Student';
                    case self::$COLUMN_SERVICE:             return 'Dienst';
                    case self::$COLUMN_SUBJECT:             return 'Onderwerp';
                    case self::$COLUMN_LOCATION:            return 'Locatie';
                    case self::$COLUMN_TIME:                return 'Tijdstip';
                    case self::$COLUMN_STATUS:              return 'Status';
                }
                break;

            case RoleTrait::$ID_EMPLOYEE:
                switch ($column) {
                    case self::$COLUMN_DATE:                return 'Datum';
                    case self::$COLUMN_STUDENT:             return 'Leerling';
                    case self::$COLUMN_SERVICE:             return 'Type';
                    case self::$COLUMN_SUBJECT:             return 'Vak';
                    case self::$COLUMN_LOCATION:            return 'Locatie';
                    case self::$COLUMN_TIME:                return 'Tijdstip';
                    case self::$COLUMN_STATUS:              return 'Status';
                }
                break;

            case RoleTrait::$ID_STUDENT:
                switch ($column) {
                    case self::$COLUMN_DATE:                return 'Datum';
                    case self::$COLUMN_HOST:                return 'Student-docent';
                    case self::$COLUMN_SERVICE:             return 'Type';
                    case self::$COLUMN_SUBJECT:             return 'Vak';
                    case self::$COLUMN_LOCATION:            return 'Locatie';
                    case self::$COLUMN_TIME:                return 'Tijdstip';
                    case self::$COLUMN_STATUS:              return 'Status';
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

                $participants                               = StudyTrait::getParticipants_Person($study);

                switch(count($participants)) {
                    case 0:                                 return "Geen deelnemers";
                    case 1:                                 return PersonTrait::getFullName($participants[0]);
                    case 2:                                 return $participants[0]->{Model::$PERSON_FIRST_NAME} . " en " . $participants[1]->{Model::$PERSON_FIRST_NAME};
                    case 3:                                 return $participants[0]->{Model::$PERSON_FIRST_NAME} . ", " . $participants[1]->{Model::$PERSON_FIRST_NAME} . " en " . $participants[2]->{Model::$PERSON_FIRST_NAME};
                    default:                                return count($participants) . " deelnemers";
                }

            case self::$COLUMN_HOST:

                return PersonTrait::getFullName($study->getHost->getPerson);

            case self::$COLUMN_SERVICE:

                return $study->getService->{Model::$SERVICE_NAME};

            case self::$COLUMN_SUBJECT:

                return $study->getSubject_Defined ? $study->getSubject_Defined->{Model::$SUBJECT_CODE} : ($study->{Model::$STUDY_SUBJECT_TEXT} != null ? $study->{Model::$STUDY_SUBJECT_TEXT} : Key::UNKNOWN);

            case self::$COLUMN_LOCATION:

                return $study->getLocation_Defined ? $study->getLocation_Defined->{Model::$LOCATION_NAME} : ($study->{Model::$STUDY_LOCATION_TEXT} != null ? $study->{Model::$STUDY_LOCATION_TEXT} : Key::UNKNOWN);

            case self::$COLUMN_TIME:

                return $study->start != null && $study->end != null ? Format::datetime($study->start, Format::$TIME_SINGLE) . ' - ' . Format::datetime($study->end, Format::$TIME_SINGLE) : Key::UNKNOWN;

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
                    $query->where(Model::$STUDY_SUBJECT_DEFINED, $value);
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

                        return User::whereHas('getAgreements_asStudent', function ($q) {$q->where(Model::$EMPLOYEE, Auth::id());})
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

                return $query
                    ->with('getSubject_Defined')
                    ->get()
                    ->pluck('getSubject_Defined.' . Model::$SUBJECT_CODE, 'getSubject_Defined.' . Model::$BASE_ID)
                    ->toArray();

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

                case self::$COLUMN_STUDENT:
                case self::$COLUMN_HOST:
                case StudentController::$COLUMN_CUSTOMER:
                    $display                                = PersonTrait::getFullName(User::find($value)->getPerson);
                    break;

                case self::$COLUMN_SERVICE:
                    $display                                = Service::find($value)->{Model::$SERVICE_NAME};
                    break;

                case self::$COLUMN_SUBJECT:
                    $display                                = Subject::find($value)->{Model::$SUBJECT_CODE};
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
