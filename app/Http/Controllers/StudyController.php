<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Route;
use App\Http\Support\Table;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\ServiceTrait;
use App\Http\Traits\StudentTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\SubjectTrait;
use App\Models\Agreement;
use App\Models\Location;
use App\Models\Person;
use App\Models\Report;
use App\Models\Service;
use App\Models\Subject;
use App\Models\Study;
use App\Models\User;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Carbon\Carbon;
use Cassandra\Function_;
use http\Client\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use MongoDB\Driver\Exception\LogicException;


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

        $STUDY_PLAN_LOCATION_HOST                                           = -1,



        $EXPORT_COLUMNS_INVOICING                                           = [
            'Leerling', 'Branch', 'Failed trial', 'Unpaid agreement', 'Total bruto',
            'Huiswerkbegeleiding_I_S', 'Huiswerkbegeleiding_I_G', 'Huiswerkbegeleiding_S_S',
            'Huiswerkbegeleiding_S_G', 'Huiswerkbegeleiding_G_S', 'Huiswerkbegeleiding_G_G',
            'Bijles_I_S', 'Bijles_I_G', 'Bijles_S_S', 'Bijles_S_G', 'Bijles_G_S', 'Bijles_G_G',
            'Training_I_S', 'Training_I_G', 'Training_S_S', 'Training_S_G', 'Training_G_S', 'Training_G_G',
            'Coaching_I_S', 'Coaching_I_G', 'Coaching_S_S', 'Coaching_S_G', 'Coaching_G_S', 'Coaching_G_G',
            'Taalles_I_S', 'Taalles_I_G', 'Taalles_S_S', 'Taalles_S_G', 'Taalles_G_S', 'Taalles_G_G',
            'Taalcursus_I_S', 'Taalcursus_I_G', 'Taalcursus_S_S', 'Taalcursus_S_G', 'Taalcursus_G_S', 'Taalcursus_G_G'
        ],

        $EXPORT_COLUMNS_LABOR                                               = [
            'Medewerker', 'Huiswerkbegeleiding_BO', 'Huiswerkbegeleiding_VO', 'Huiswerkbegeleiding_HO',
            'Bijles_BO', 'Bijles_VO', 'Bijles_HO', 'Training_BO', 'Training_VO', 'Training_HO',
            'Coaching_BO', 'Coaching_VO', 'Coaching_HO', 'Taalles',  'Taalcursus'
        ],

        $EXPORT_COLUMNS_LESSONS                                             = [
            'Leerling', 'Medewerker', 'Onderwerp', 'Dienst', 'Deelnemers', 'Proefles', 'Begeleidingsvorm',
            'Datum', 'Start', 'Einde', 'Duurtijd', 'Locatie', 'Status', 'Opmerkingen', 'Link naar les'
        ],

        $EXPORT_HEADOFFICE_EMPLOYEE                                         = [
            'Chloé Klippert','Eldar Ulanov','Masha Hasalee','Sanne de Brouwer','Sarah Ewals','Sarah Huizenga','Stijn Donkers'
        ];





    public function view($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                                 => __($study->getService->{Model::$SERVICE_SHORT}),
            Key::PAGE_BACK                                                  => true,

            Model::$STUDY                                                   => $study
        ]);
    }





    public function plan() {

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = __('Les inplannen');
        $data[Key::SUBMIT_ACTION]                                           = __('Inplannen');
        $data[Key::SUBMIT_ROUTE]                                            = 'study.plan_submit';
        $data[Key::BACK_ROUTE]                                              = 'study.list';



        self::form_set_ac_data_location($data);

        self::form_set_ac_data_host($data);



        return view(Views::FORM_STUDY_PLAN, $data);
    }





    public function plan_submit(Request $request) {

        $study                                                              = null;
        $data                                                               = $request->all();

        StudyTrait::create($data, $study);

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Les ingepland'),
            Key::PAGE_MESSAGE                                               => 'Alle deelnemers worden per email<br>op de hoogte gebracht.',
            Key::PAGE_NEXT                                                  => route(Route::STUDY_VIEW, $study->{Model::$BASE_KEY}),
            Key::PAGE_ACTION                                                => __('Naar de les'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





    public function edit($key) {

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = __('Les bewerken');
        $data[Key::SUBMIT_ACTION]                                           = __('Opslaan');
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

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Les gewijzigd'),
            Key::PAGE_MESSAGE                                               => __('Alle deelnemers worden per email<br>op de hoogte gebracht.'),
            Key::PAGE_NEXT                                                  => route(Route::STUDY_VIEW, $study->{Model::$BASE_KEY}),
            Key::PAGE_ACTION                                                => __('Naar de les'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





    public function calendar() {

        $data                                                               = [];
        $data[Key::PAGE_TITLE]                                              = __('Locatieagenda');

        return view(Views::CALENDAR, $data);
    }





    public function delete($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        if (\App\Http\Traits\StudyTrait::isReported($study)) {

            foreach ($study->getReports as $report) {

                foreach ($report->getReport_Subjects as $report_subject) {

                    $report_subject->delete();

                }

                $report->delete();
            }
        }

        if ($study->{Model::$STUDY_TRIAL}) {

            foreach ($study->getAgreements as $agreement) {

                if ($agreement->{Model::$AGREEMENT_STATUS} == AgreementTrait::$STATUS_TRIAL) {

                    $agreement->{Model::$AGREEMENT_STATUS} = AgreementTrait::$STATUS_UNAPPROVED;
                    $agreement->save();
                }
            }
        }

        $study->delete();

        return redirect()->route('study.list');
    }





    public function form_set_ac_data_location(&$data, $study = null) {



        /** OPTIONS BASED ON HOST **/

        $ac_data                                                            = Location::with('getAddress')->get()->pluck(Model::$LOCATION_NAME, 'getAddress.' . Model::$BASE_ID)->toArray();

        $ac_data[self::$STUDY_PLAN_LOCATION_HOST]                           = self::hasManagementRights() ? __('Thuis bij de student-docent') : __('Thuis bij jou (:name)', ['name' => Auth::user()->getPerson->{Model::$PERSON_FIRST_NAME}]);

        $students                                                           = self::hasManagementRights() ? User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)->get() : Auth::user()->getStudents;

        foreach ($students as $student) {

            if (!$student->getPerson) {
                dd($student);
            }

            $address                                                        = $student->getPerson->getAddress;

            if ($address) {

                $ac_data[$address->{Model::$BASE_ID}]                       = __('Thuis bij :name', ['name' => PersonTrait::getFullName($student->getPerson)]);

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
        $report_id                                                          = $request->input(Model::$REPORT, -1);

        $study                                                              = Study::find($study_id);
        $user                                                               = User::find($user_id);
        $agreement                                                          = Agreement::find($agreement_id);
        $report                                                             = Report::find($report_id);

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
            Model::$REPORT                                                  => $report,

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

        return __('Lessen');

    }



    public function list_columns($sort, $filter, $layout) {

        $columns                                                    = [];

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_CUSTOMER:
                if ($layout == 'desktop') {
                    array_push($columns,
                        Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 3, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 4, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 4, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 4, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 3, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 4, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                    );
                } else if ($layout == 'mobile') {
                    array_push($columns,
                        Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 1, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 1, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 1, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 1, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, true, $sort, true, $filter, true)
                    );
                }
                break;

            case RoleTrait::$ID_EMPLOYEE:
                if ($layout == 'desktop') {
                    array_push($columns,
                        Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 2, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 3, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 3, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 2, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                    );
                } else if ($layout == 'mobile') {
                    array_push($columns,
                        Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 1, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 1, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 1, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 1, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 1, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, true, $sort, true, $filter, true)
                    );
                }
                break;

            case RoleTrait::$ID_STUDENT:
                if ($layout == 'desktop') {
                    array_push($columns,
                        Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 2, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 3, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 3, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 2, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 3, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 3, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 3, true, $sort, true, $filter, true)
                    );
                } else if ($layout == 'mobile') {
                    array_push($columns,
                        Table::column(self::$COLUMN_DATE, self::list_column_label(self::$COLUMN_DATE), 1, true, $sort, true, $filter, true),
                        Table::column(self::$COLUMN_TIME, self::list_column_label(self::$COLUMN_TIME), 1, true, $sort, false, $filter),
                        Table::column(self::$COLUMN_HOST, self::list_column_label(self::$COLUMN_HOST), 1, true, $sort, true, $filter),
                        Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 1, false, $sort, true, $filter),
                        Table::column(self::$COLUMN_LOCATION, self::list_column_label(self::$COLUMN_LOCATION), 1, false, $sort, false, $filter),
                        Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, true, $sort, true, $filter, true)
                    );
                }
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
                    case self::$COLUMN_DATE:                        return __('Datum');
                    case self::$COLUMN_STUDENT:                     return __('Leerling');
                    case self::$COLUMN_HOST:                        return __('Student');
                    case self::$COLUMN_SERVICE:                     return __('Dienst');
                    case self::$COLUMN_SUBJECT:                     return __('Onderwerp');
                    case self::$COLUMN_LOCATION:                    return __('Locatie');
                    case self::$COLUMN_TIME:                        return __('Tijdstip');
                    case self::$COLUMN_STATUS:                      return __('Status');
                }
                break;

            case RoleTrait::$ID_EMPLOYEE:
                switch ($column) {
                    case self::$COLUMN_DATE:                        return __('Datum');
                    case self::$COLUMN_STUDENT:                     return __('Leerling');
                    case self::$COLUMN_SERVICE:                     return __('Type');
                    case self::$COLUMN_SUBJECT:                     return __('Vak');
                    case self::$COLUMN_LOCATION:                    return __('Locatie');
                    case self::$COLUMN_TIME:                        return __('Tijdstip');
                    case self::$COLUMN_STATUS:                      return __('Status');
                }
                break;

            case RoleTrait::$ID_STUDENT:
                switch ($column) {
                    case self::$COLUMN_DATE:                        return __('Datum');
                    case self::$COLUMN_HOST:                        return __('Student-docent');
                    case self::$COLUMN_SERVICE:                     return __('Type');
                    case self::$COLUMN_SUBJECT:                     return __('Vak');
                    case self::$COLUMN_LOCATION:                    return __('Locatie');
                    case self::$COLUMN_TIME:                        return __('Tijdstip');
                    case self::$COLUMN_STATUS:                      return __('Status');
                }
                break;
        }

        return __('Onbekend');
    }



    public function list_value($study, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_DATE:

                return $study->{Model::$STUDY_START} != null ? "<div style='font-weight: 400'>" . Format::datetime($study->{Model::$STUDY_START}, Format::$DATETIME_LIST) . "</div>" : __('Onbekend');

            case self::$COLUMN_STUDENT:

                return StudyTrait::getParticipantsText($study);

            case self::$COLUMN_HOST:

                return PersonTrait::getFullName($study->getHost->getPerson);

            case self::$COLUMN_SERVICE:

                return $study->getService->{Model::$SERVICE_NAME} . ($study->{Model::$STUDY_TRIAL} ? '&nbsp;&nbsp;<span style="color:#FF0000">' . __('(Proefles)') . '</span>' : '');

            case self::$COLUMN_SUBJECT:

                if (strlen($study->{Model::$STUDY_SUBJECT_TEXT}) > 0) {

                    return $study->{Model::$STUDY_SUBJECT_TEXT};

                } else {

                    $subjects                                   = "";

                    foreach ($study->getAgreements as $agreement) {

                        $subjects                              .= (strlen($subjects) > 0 ? ', ' : '') . AgreementTrait::getVakcode($agreement);

                    }

                    return $subjects;
                }

            case self::$COLUMN_LOCATION:

                return StudyTrait::hasLink($study) ? __('Digitaal') : $study->{Model::$STUDY_LOCATION_TEXT};

            case self::$COLUMN_TIME:

                return StudyTrait::getTimeText($study);

            case self::$COLUMN_STATUS:

                return "<div class='tag' style='background:" . StudyTrait::getStatusColor(StudyTrait::getStatus($study)) . ";color:" . StudyTrait::getStatusTextColor($study) . "'>".StudyTrait::getStatusText(StudyTrait::getStatus($study))."</div>";

            default:

                return __('Onbekend');
        }
    }



    public function list_prepare($objects) {

        return $objects;

    }



    public function list_link($study) {

        return route('study.view', [Model::$BASE_KEY => $study->{Model::$BASE_KEY}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

            if ($mode != Table::SORT_MODE_NONE) {

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

                case self::$COLUMN_DATE:
                    $query
                        ->where(Model::$STUDY_START, '>=', substr($value, 0, 10))
                        ->where(Model::$STUDY_END, '<=', substr($value, 11, 10));
                    break;

                case self::$COLUMN_STUDENT:
                    $query->whereHas('getParticipants_User', function (Builder $q) use ($value) {$q->where(Model::$BASE_ID, $value);});
                    break;

                case self::$COLUMN_HOST:
                    $query->where(Model::$STUDY_HOST_USER, $value);
                    break;

                case self::$COLUMN_SERVICE:

                    switch ($value) {

                        case -7:
                            $query->has('getParticipants_User', '>' , 1);
                            break;

                        case -6:
                            $query->has('getParticipants_User', '==' , 1);
                            break;

                        case -5:
                            $query->whereIn(Model::$SERVICE, array(ServiceTrait::$ID_TAALCURSUS_TO, ServiceTrait::$ID_TAALLES_TO));
                            break;

                        case -4:
                            $query->whereIn(Model::$SERVICE, array(ServiceTrait::$ID_BIJLES_MBO_HBO_WO, ServiceTrait::$ID_TENTAMENTRAINING, ServiceTrait::$ID_HUISWERKBEGELEIDING_MBO_HBO_WO, ServiceTrait::$ID_COACHING_MBO_HBO_WO));
                            break;

                        case -3:
                            $query->whereIn(Model::$SERVICE, array(ServiceTrait::$ID_BIJLES_VO, ServiceTrait::$ID_EXAMENTRAINING, ServiceTrait::$ID_HUISWERKBEGELEIDING_VO, ServiceTrait::$ID_COACHING_VO));
                            break;

                        case -2:
                            $query->whereIn(Model::$SERVICE, array(ServiceTrait::$ID_BIJLES_BO, ServiceTrait::$ID_TRAINING_BO, ServiceTrait::$ID_HUISWERKBEGELEIDING_BO, ServiceTrait::$ID_COACHING_BO));
                            break;

                        case -1:
                            $query->where(Model::$STUDY_TRIAL, true);
                            break;

                        default:
                            $query->where(Model::$SERVICE, $value);
                    }
                    break;

                case self::$COLUMN_SUBJECT:
                    $query->whereHas('getAgreements', function (Builder $q) use ($value) {$q->where(Model::$SUBJECT, $value);});
                    break;

                case self::$COLUMN_LOCATION:
                    $query->where(Model::$STUDY_LOCATION_TEXT, $value);
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



    public function list_filter_search($query, $value) {

        $query->where(function($query) use ($value) {

            $query

                ->whereHas('getService', function (Builder $q) use ($value) {

                    $q->where(Model::$SERVICE_NAME, 'LIKE', '%'.$value.'%');

                })

                ->orWhereHas('getParticipants_User.getPerson', function (Builder $q) use ($value) {

                    $q

                        ->where(Model::$PERSON_FIRST_NAME, 'LIKE', '%'.$value.'%')
                        ->orWhere(Model::$PERSON_LAST_NAME, 'LIKE', '%'.$value.'%');
                })

                ->orWhereHas('getHost_User.getPerson', function (Builder $q) use ($value) {

                    $q

                        ->where(Model::$PERSON_FIRST_NAME, 'LIKE', '%'.$value.'%')
                        ->orWhere(Model::$PERSON_LAST_NAME, 'LIKE', '%'.$value.'%');
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

                        return User::whereHas('getStudent.getCustomer', function ($q) {
                            $q->where(Model::$USER, Auth::id());
                        })
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

                $services = $query
                    ->with('getService')
                    ->get()
                    ->pluck('getService.' . Model::$SERVICE_NAME, 'getService.' . Model::$BASE_ID)
                    ->toArray();

                $services[-1]                               = __('Proefles');
                $services[-2]                               = __('Alle BO');
                $services[-3]                               = __('Alle VO');
                $services[-4]                               = __('Alle MBO/HBO/WO');
                $services[-5]                               = __('Alle Taal');
                $services[-6]                               = __('Alle Privéles');
                $services[-7]                               = __('Alle Groepsles');

                return $services;

            case self::$COLUMN_SUBJECT:

                return Subject::get()->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();

            case self::$COLUMN_LOCATION:

                return Location::get()->pluck(Model::$LOCATION_NAME, Model::$LOCATION_NAME)->toArray();

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

                    $after                                  = Format::datetime(Carbon::createFromFormat(Format::$DATABASE_DATE, substr($value, 0, 10)), Format::$DATETIME_LIST);
                    $before                                 = Format::datetime(Carbon::createFromFormat(Format::$DATABASE_DATE, substr($value, 11, 10)), Format::$DATETIME_LIST);

                    $display                                = ' ' . $after . __(' tot ') . $before;
                    break;

                case self::$COLUMN_STUDENT:
                case self::$COLUMN_HOST:
                case StudentController::$COLUMN_CUSTOMER:
                    $display                                = PersonTrait::getFullName(User::find($value)->getPerson);
                    break;

                case self::$COLUMN_SERVICE:

                    switch($value) {

                        case -1: $display                   = __('Proefles'); break;
                        case -2: $display                   = __('Alle BO'); break;
                        case -3: $display                   = __('Alle VO'); break;
                        case -4: $display                   = __('Alle MBO/HBO/WO'); break;
                        case -5: $display                   = __('Alle Taal'); break;
                        case -6: $display                   = __('Alle Privéles'); break;
                        case -7: $display                   = __('Alle Groepsles'); break;
                        default: $display                   = Service::find($value)->{Model::$SERVICE_NAME}; break;
                    }
                    break;

                case self::$COLUMN_SUBJECT:
                    $display                                = Subject::find($value)->{Model::$SUBJECT_NAME};
                    break;

                case self::$COLUMN_LOCATION:
                    $display                                = $value;
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
        $search                                             = $request->input(Table::DATA_SEARCH, null);

        $query                                              = Table::query($this, $sort, $filter, $search);
        $counters                                           = [];

        self::list_counters_load_total($query, $counters);

        self::list_counters_load_hours($query, $counters);

        if (self::hasManagementRights()) {

            self::list_counters_load_employees($query, $counters);

            self::list_counters_load_students($query, $counters);
        }

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }



    public function list_counters_load_total($query, &$counters) {

        array_push($counters, (object) [
            Table::COUNTER_ID                               => 'counter-total',
            Table::COUNTER_LABEL                            => __('Totaal'),
            Table::COUNTER_VALUE                            => $query
                ->select('study.*')
                ->get()
                ->count()
        ]);
    }



    public function list_counters_load_hours($query, &$counters) {

        array_push($counters, (object) [
            Table::COUNTER_LABEL                            => __('Uren'),
            Table::COUNTER_VALUE                            => (float) array_sum($query
                ->selectRaw('TIMESTAMPDIFF(minute, start, end) as time')
                ->pluck('time')
                ->toArray()) / 60
        ]);
    }



    public function list_counters_load_employees($query, &$counters) {

        array_push($counters, (object) [
            Table::COUNTER_LABEL                            => __('Medewerkers'),
            Table::COUNTER_VALUE                            => count(array_unique($query
                ->with('getHost_User')
                ->get()
                ->pluck('getHost_User.id')
                ->toArray()))
        ]);
    }



    public function list_counters_load_students($query, &$counters) {

        $studentIds = [];

        foreach ($query->get() as $study) {

            foreach ($study->getParticipants_User as $student) {

                array_push($studentIds, $student->{Model::$BASE_ID});

            }
        }

        array_push($counters, (object) [
            Table::COUNTER_LABEL                            => __('Leerlingen'),
            Table::COUNTER_VALUE                            => count(array_unique($studentIds))
        ]);
    }





    public function data_export_csv(Request $request) {

        $sort                                               = $request->input(Table::DATA_SORT, null);
        $filter                                             = $request->input(Table::DATA_FILTER, null);
        $search                                             = $request->input(Table::DATA_SEARCH, null);

        $query                                              = Table::query($this, $sort, $filter, $search);

        $studies                                            = $query->whereIn(Model::$STUDY_STATUS, [StudyTrait::$STATUS_CANCELLED, StudyTrait::$STATUS_ABSENT, StudyTrait::$STATUS_REPORTED])->get();

        $rows_invoicing                                     = self::data_export_csv_invoicing($studies, $filter);
        $rows_labor                                         = self::data_export_csv_labor($studies);
        $rows_lessons                                       = self::data_export_csv_lessons($studies);

        $rows                                               = [];
        $rows_count                                         = max(count($rows_invoicing), count($rows_labor), count($rows_lessons));

        for ($i = 0; $i < $rows_count; $i++) {

            $row_invoicing                                  = $i < count($rows_invoicing) ? $rows_invoicing[array_keys($rows_invoicing)[$i]] : array_fill(0, count(self::$EXPORT_COLUMNS_INVOICING), '');
            $row_labor                                      = $i < count($rows_labor) ? $rows_labor[array_keys($rows_labor)[$i]] : array_fill(0, count(self::$EXPORT_COLUMNS_LABOR), '');
            $row_lessons                                    = $i < count($rows_lessons) ? $rows_lessons[array_keys($rows_lessons)[$i]] : array_fill(0, count(self::$EXPORT_COLUMNS_LESSONS), '');

            $rows[]                                         = array_merge($row_invoicing, $row_labor, $row_lessons);
        }

        $columns                                            = array_merge(self::$EXPORT_COLUMNS_INVOICING, self::$EXPORT_COLUMNS_LABOR, self::$EXPORT_COLUMNS_LESSONS);

        return Func::export_csv($columns, $rows);
    }



    public function data_export_csv_lessons($studies) {

        $rows                                               = [];

        foreach ($studies as $study) {

            self::data_export_csv_lesson_row($study, $rows);

        }

        usort($rows, function($a, $b) {

            $nameComparison = strcmp($a[0], $b[0]);

            if ($nameComparison !== 0) {

                return $nameComparison;

            }

            return strtotime($a[6]) - strtotime($b[6]);
        });

        return $rows;
    }



    public function data_export_csv_lesson_row($study, &$rows) {

        foreach ($study->getParticipants_User as $participant) {

            $first_name                                     = PersonTrait::getFullName($participant->getPerson);
            $last_name                                      = PersonTrait::getFullName($study->getHost_User->getPerson);

            $date                                           = Format::datetime($study->start, Format::$DATETIME_EXPORT);
            $start                                          = Format::datetime(StudyTrait::getStartTime($study), Format::$TIME_SINGLE);
            $end                                            = Format::datetime(StudyTrait::getEndTime($study), Format::$TIME_SINGLE);
            $location                                       = $study->{Model::$STUDY_LOCATION_TEXT};
            $service                                        = $study->getService->{Model::$SERVICE_NAME};
            $participants                                   = StudyTrait::countParticipants($study) > 1 ? __('Groepsles') : __('Privéles');
            $plan                                           = AgreementTrait::getPlanText(StudyTrait::getPlan($study, $participant));
            $status                                         = StudyTrait::getStatusText(StudyTrait::getStatus($study));
            $remark                                         = $study->{Model::$STUDY_REMARK};
            $link                                           = 'https://studied.app/les/' . $study->{Model::$BASE_KEY};
            $trial                                          = StudyTrait::isTrial($study) ? __('Ja') : __('Nee');
            $duration                                       = StudyTrait::getDuration($study, $participant) / 60.0;
            $subjects                                       = '';

            switch ($study->{Model::$STUDY_STATUS}) {

                case StudyTrait::$STATUS_REPORTED:

                    $report                                 = $study->getReport($participant);

                    if ($report) {

                        $trial                              = StudyTrait::isTrial($study) ? ($report->{Model::$REPORT_TRIAL_SUCCESS} ? __('Succes') : __('Mislukt')) : __('Nee');

                        foreach ($report->getReport_Subjects as $report_Subject) {

                            if (!$report_Subject->getSubject) {

                                dd($study->id, $report->id);

                            }

                            $subjects                      .= (strlen($subjects) > 0 ? ', ' : '') . $report_Subject->getSubject->{Model::$SUBJECT_CODE};

                        }
                    }

                    break;

                case StudyTrait::$STATUS_CANCELLED:
                case StudyTrait::$STATUS_ABSENT:

                    $subjects                               = $study->{Model::$STUDY_SUBJECT_TEXT};
                    break;
            }

            array_push($rows, [$first_name, $last_name, $subjects, $service, $plan, $participants, $trial, $date, $start, $end, $duration, $location, $status, $remark, $link]);
        }
    }



    public function data_export_csv_invoicing($studies, $filter) {

        $rows                                               = [];

        foreach ($studies as $study) {

            $group                                                      = $study->getParticipants_User->count() > 1;

            if (!in_array($study->{Model::$STUDY_STATUS}, [StudyTrait::$STATUS_REPORTED, StudyTrait::$STATUS_ABSENT])) {

                continue;

            }

            foreach ($study->getAgreements as $agreement) {

                $user                                                   = $agreement->getStudent;

                if (!array_key_exists($user->{Model::$BASE_ID}, $rows)) {

                    self::data_export_csv_invoicing_row($rows, $user->{Model::$BASE_ID});

                }

                $plan                                                   = $agreement->{Model::$AGREEMENT_PLAN};
                $rate                                                   = Service::find($study->{Model::$SERVICE})->{'rate_plan' . $plan . '_' . ($group ? 'group' : 'solo')};

                if ($study->{Model::$STUDY_STATUS} == StudyTrait::$STATUS_REPORTED) {

                    $report                                             = $study->getReport($user);

                    if (!$report) {

                        continue;

                        // ERROR CATCH FOR RESOLVED 0-DURATION ISSUE,
                        // CAN CAUSE INCONSISTENCIES IN EXPORT DATA
                    }

                    $duration                                           = ReportTrait::getDurationTotal($report) / 60.0;

                    if ($report->{Model::$STUDY_TRIAL} && !$report->{Model::$REPORT_TRIAL_SUCCESS}) {

                        $rows[$user->{Model::$BASE_ID}][2]              -= $duration * $rate;

                    }

                } else {

                    $duration                                           = StudyTrait::getDuration($study) / 60.0;

                }

                $rows[$user->{Model::$BASE_ID}][4]                      += $duration * $rate;
                $offset                                                 = 5;

                switch ($study->{Model::$SERVICE}) {

                    case ServiceTrait::$ID_HUISWERKBEGELEIDING_MBO_HBO_WO:
                    case ServiceTrait::$ID_HUISWERKBEGELEIDING_BO:
                    case ServiceTrait::$ID_HUISWERKBEGELEIDING_VO:      $offset += 0; break;

                    case ServiceTrait::$ID_BIJLES_BO:
                    case ServiceTrait::$ID_BIJLES_VO:
                    case ServiceTrait::$ID_BIJLES_MBO_HBO_WO:           $offset += 6; break;

                    case ServiceTrait::$ID_EXAMENTRAINING:
                    case ServiceTrait::$ID_TENTAMENTRAINING:
                    case ServiceTrait::$ID_TRAINING_BO:                 $offset += 12; break;

                    case ServiceTrait::$ID_COACHING:
                    case ServiceTrait::$ID_COACHING_BO:
                    case ServiceTrait::$ID_COACHING_VO:
                    case ServiceTrait::$ID_COACHING_MBO_HBO_WO:         $offset += 18; break;

                    case ServiceTrait::$ID_TAALLES_TO:                  $offset += 24; break;
                    case ServiceTrait::$ID_TAALCURSUS_TO:               $offset += 30; break;
                }

                $rows[$user->{Model::$BASE_ID}][$offset + (($plan - 1) * 2) + ($group ? 1 : 0)] += $duration;
            }
        }

        $range_date_start                                               = date('Y-m-d H:i:s', 0);
        $range_date_end                                                 = date('Y-m-d H:i:s');

        if (array_key_exists(self::$COLUMN_DATE, $filter)) {

            $range_date_start                                           = substr($filter[self::$COLUMN_DATE], 0, 10);
            $range_date_end                                             = substr($filter[self::$COLUMN_DATE], 11, 10);

        }

        $agreements                                                     = Agreement::where(Model::$AGREEMENT_END, '<=', $range_date_end)
                                                                          ->where(Model::$AGREEMENT_END, '>=', $range_date_start)
                                                                          ->get();

        foreach ($agreements as $agreement) {

            if (AgreementTrait::getHoursTotal($agreement) <= AgreementTrait::getHoursMade($agreement)) {

                continue;

            }

            if ($agreement->{Model::$AGREEMENT_PLAN} == AgreementTrait::$PLAN_LOSSE_LESSEN) {

                continue;

            }

            $user = $agreement->getStudent;

            if (!$user) {

                dd($agreement);

            }

            if (!array_key_exists($user->{Model::$BASE_ID}, $rows)) {

                self::data_export_csv_invoicing_row($rows, $user->{Model::$BASE_ID});

            }

            $plan                                                   = $agreement->{Model::$AGREEMENT_PLAN};
            $rate                                                   = Service::find($study->{Model::$SERVICE})->{'rate_plan' . $plan . '_' . ($group ? 'group' : 'solo')};

            $remainder                                              = AgreementTrait::getHoursTotal($agreement) - AgreementTrait::getHoursMade($agreement);
            $remainder                                              = (round($remainder * 4) / 4);

            $rows[$user->{Model::$BASE_ID}][3] += $remainder * $rate;
        }

        usort($rows, function($a, $b) {

            return strcmp($a[0], $b[0]);

        });

        return $rows;
    }



    public function data_export_csv_invoicing_row(&$rows, $user_id) {

        $user                                               = User::find($user_id);
        $branch                                             = StudentTrait::getBranchData()[$user->getStudent->{Model::$STUDENT_BRANCH}];

        $rows[$user_id]                                     = [

            PersonTrait::getFullName($user->getPerson), $branch,

            0,                                              // Failed trial
            0,                                              // Afrekening vakafspraken
            0,                                              // Total bruto

            0, 0, 0, 0, 0, 0,                               // Huiswerkbegeleiding
            0, 0, 0, 0, 0, 0,                               // Bijles
            0, 0, 0, 0, 0, 0,                               // Training
            0, 0, 0, 0, 0, 0,                               // Coaching
            0, 0, 0, 0, 0, 0,                               // Taalles
            0, 0, 0, 0, 0, 0                                // Taalcursus
        ];
    }



    public function data_export_csv_labor($studies) {

        $rows                                                                   = [];

        foreach ($studies as $study) {

            if (!in_array($study->{Model::$STUDY_STATUS}, [StudyTrait::$STATUS_REPORTED, StudyTrait::$STATUS_ABSENT])) {

                continue;

            }

            if (!array_key_exists($study->{Model::$STUDY_HOST_USER}, $rows)) {

                $rows[$study->{Model::$STUDY_HOST_USER}] = [

                    PersonTrait::getFullName($study->getHost_User->getPerson),

                    0, 0, 0,                                                    // Huiswerkbegeleiding
                    0, 0, 0,                                                    // Bijles
                    0, 0, 0,                                                    // Training
                    0, 0, 0,                                                    // Coaching
                    0,                                                          // Taalles
                    0                                                           // Taalcursus
                ];
            }

            $duration                                                           = StudyTrait::getDuration($study) / 60.0;
            $offset                                                             = 1;

            switch ($study->{Model::$SERVICE}) {

                case ServiceTrait::$ID_HUISWERKBEGELEIDING_BO:                  $offset += 0; break;
                case ServiceTrait::$ID_HUISWERKBEGELEIDING_VO:                  $offset += 1; break;
                case ServiceTrait::$ID_HUISWERKBEGELEIDING_MBO_HBO_WO:          $offset += 2; break;

                case ServiceTrait::$ID_BIJLES_BO:                               $offset += 3; break;
                case ServiceTrait::$ID_BIJLES_VO:                               $offset += 4; break;
                case ServiceTrait::$ID_BIJLES_MBO_HBO_WO:                       $offset += 5; break;

                case ServiceTrait::$ID_TRAINING_BO:                             $offset += 6; break;
                case ServiceTrait::$ID_TENTAMENTRAINING:                        $offset += 7; break;
                case ServiceTrait::$ID_EXAMENTRAINING:                          $offset += 8; break;

                case ServiceTrait::$ID_COACHING:
                case ServiceTrait::$ID_COACHING_BO:                             $offset += 9; break;
                case ServiceTrait::$ID_COACHING_VO:                             $offset += 10; break;
                case ServiceTrait::$ID_COACHING_MBO_HBO_WO:                     $offset += 11; break;

                case ServiceTrait::$ID_TAALLES_TO:                              $offset += 12; break;
                case ServiceTrait::$ID_TAALCURSUS_TO:                           $offset += 13; break;
            }

            $rows[$study->{Model::$STUDY_HOST_USER}][$offset] += $duration;
        }

        usort($rows, function($a, $b) {

            return strcmp($a[0], $b[0]);

        });

        foreach (self::$EXPORT_HEADOFFICE_EMPLOYEE as $employee) {

            if (!array_key_exists($employee, $rows)) {

                $rows[$employee] = [$employee, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            }
        }

        return $rows;
    }





}
