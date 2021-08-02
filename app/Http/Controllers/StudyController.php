<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Table;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Location;
use App\Models\Study;
use App\Models\User;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use DB;



class StudyController extends Controller {





    use BaseTrait;





    private static

        $COLUMN_DATE                                        = 1,
        $COLUMN_STUDENT                                     = 2,
        $COLUMN_HOST                                        = 3,
        $COLUMN_SUBJECT                                     = 4,
        $COLUMN_SERVICE                                     = 5,
        $COLUMN_LOCATION                                    = 6,
        $COLUMN_TIME                                        = 7,
        $COLUMN_STATUS                                      = 8;





    public function view($key) {

        $study                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                 => $study->getService->{Model::$SERVICE_NAME},
            Key::PAGE_BACK                                  => true,

            Model::$STUDY                                   => $study
        ]);
    }





    public function plan() {



        $objects_location                                   = Location::all();
        $objects_host                                       = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_EMPLOYEE, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_BOARD))->with('getPerson')->get();

        $ac_data_location                                   = $objects_location->pluck(Model::$LOCATION_NAME, Model::$BASE_ID)->toArray();
        $ac_data_host                                       = $objects_host->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();

        $ac_additional_host                                 = $objects_host->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        return view(Views::FORM_STUDY, [

            Key::PAGE_TITLE                                 => 'Les inplannen',
            Key::SUBMIT_ACTION                              => 'Inplannen',
            Key::SUBMIT_ROUTE                               => 'study.plan_submit',

            Key::AUTOCOMPLETE_DATA.'location'               => Format::ac($ac_data_location),
            Key::AUTOCOMPLETE_DATA.'host'                   => Format::ac($ac_data_host),

            Key::AUTOCOMPLETE_ADDITIONAL.'host'             => Format::ac($ac_additional_host),
        ]);
    }



    public function plan_submit(Request $request) {

        $study                                              = null;
        $data                                               = $request->all();

        // self::plan_validate($data);

        StudyTrait::create($data, $study);

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }



    public function plan_validate(array $data) {

        $messages = [
            'subject.required'                              => 'Vul een onderwerp in.',
        ];

        $validator = Validator::make($data, [
            'subject'                                       => ['bail', 'required'],
        ], $messages);

        $validator->validate();
    }





    public function list() {

        return view(Views::LIST_STUDY, [

            Key::PAGE_TITLE                                 => 'Lessen',

            Table::DATA_TYPE                                => Model::$STUDY,
            Table::VIEW_COUNTERS                            => $this->list_counters()
        ]);
    }



    public function list_load(Request $request) {

        return Table::load($this, $request);

    }



    public function list_query() {

        return Study::query();

    }



    public function list_type() {

        return Model::$STUDY;

    }



    public function list_columns($sort) {

        $columns                                            = [];

        /* TODO: REMOVE COLUMNS IF FILTERED */

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_CUSTOMER:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 3, true, $sort, true),
                    Table::column(self::$COLUMN_STUDENT, 'Leerling', 4, false, $sort),
                    Table::column(self::$COLUMN_HOST, 'Student', 4, true, $sort),
                    Table::column(self::$COLUMN_SERVICE, 'Dienst', 3, true, $sort),
                    Table::column(self::$COLUMN_SUBJECT, 'Onderwerp', 3, false, $sort),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 4, false, $sort),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3, true, $sort),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true, $sort, true)
                );
                break;

            case RoleTrait::$ID_EMPLOYEE:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 2, true, $sort, true),
                    Table::column(self::$COLUMN_STUDENT, 'Leerling', 3, false, $sort),
                    Table::column(self::$COLUMN_SERVICE, 'Type', 2, true, $sort),
                    Table::column(self::$COLUMN_SUBJECT, 'Vak', 2, false, $sort),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3, false, $sort),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3, true, $sort),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true, $sort, true)
                );
                break;

            case RoleTrait::$ID_STUDENT:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 2, true, $sort, true),
                    Table::column(self::$COLUMN_HOST, 'Student-docent', 3, true, $sort),
                    Table::column(self::$COLUMN_SERVICE, 'Type', 2, true, $sort),
                    Table::column(self::$COLUMN_SUBJECT, 'Vak', 2, false, $sort),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3, false, $sort),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3, true, $sort),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true, $sort, true)
                );
                break;

            default:

                break;
        }

        return $columns;
    }



    public function list_value($study, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_DATE:

                return $study->{Model::$STUDY_DATE} != null ? "<div style='font-weight: 400'>" . Format::datetime($study->{Model::$STUDY_DATE}, Format::$DATETIME_LIST) . "</div>" : Key::UNKNOWN;

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

                return $study->start != null && $study->end != null ? $study->start . ' - ' . $study->end : Key::UNKNOWN;

            case self::$COLUMN_STATUS:

                return "<div class='tag' style='background:" . StudyTrait::getStatusColor($study) . ";color:" . StudyTrait::getStatusTextColor($study) . "'>".StudyTrait::getStatus($study)."</div>";

            default:

                return 'No value';
        }
    }



    public function list_link($study) {

        return route('study.view', ['key' => $study->{Model::$BASE_KEY}]);

    }



    public function list_sort($query, $sort) {

        switch ($sort[Table::COLUMN_ID]) {

            case self::$COLUMN_DATE:

                $query->orderBy(Model::$BASE_CREATED_AT, $sort[Table::SORT_MODE]);
                break;

            case self::$COLUMN_STUDENT:

                // TODO: ENABLE ONLY IF FILTERED ON STUDY.SERVICE = PRIVELES
                /*
                $query->join(self::$STUDY_USER, self::$STUDY_USER . '.' . self::$STUDY, '=', self::$STUDY . '.' . self::$BASE_ID);
                $query->join(self::$USER, self::$USER . '.' . self::$BASE_ID, '=', self::$STUDY_USER . '.' . self::$USER);
                $query->join(self::$PERSON, self::$PERSON . '.' . self::$BASE_ID, '=', self::$USER . '.' . self::$PERSON);
                $query->orderBy(self::$PERSON . '.' . self::$PERSON_FIRST_NAME, $sort[Table::SORT_MODE]);*/
                break;

            case self::$COLUMN_HOST:

                $query->join(Model::$USER, Model::$USER . '.' . Model::$BASE_ID, '=', Model::$STUDY . '.' . Model::$STUDY_HOST_USER);
                $query->join(Model::$PERSON, Model::$PERSON . '.' . Model::$BASE_ID, '=', Model::$USER . '.' . Model::$PERSON);
                $query->orderBy(Model::$PERSON . '.' . Model::$PERSON_FIRST_NAME, $sort[Table::SORT_MODE]);
                break;

            case self::$COLUMN_SERVICE:

                $query->join(Model::$SERVICE, Model::$SERVICE . '.' . Model::$BASE_ID, '=', Model::$STUDY . '.' . Model::$SERVICE);
                $query->orderBy(Model::$SERVICE . '.' . Model::$SERVICE_NAME, $sort[Table::SORT_MODE]);
                break;

            case self::$COLUMN_TIME:

                $query->orderBy(Model::$STUDY_START, $sort[Table::SORT_MODE]);
                $query->orderBy(Model::$STUDY_END, $sort[Table::SORT_MODE]);
                break;

            case self::$COLUMN_STATUS:

                $query->orderBy(Model::$STUDY_STATUS, $sort[Table::SORT_MODE]);
                break;
        }
    }



    public function list_counters() {

        $COUNTER_PLANNED            = (object) [
            Table::COUNTER_LABEL                            => 'Ingepland',
            Table::COUNTER_VALUE                            => Study::where(Model::$STUDY_STATUS, StudyTrait::$STATUS_PLANNED)->count()
        ];

        $COUNTER_REPORTED           = (object) [
            Table::COUNTER_LABEL                            => 'Gerapporteerd',
            Table::COUNTER_VALUE                            => Study::where(Model::$STUDY_STATUS, StudyTrait::$STATUS_REPORTED)->count()
        ];

        return [
            $COUNTER_PLANNED,
            $COUNTER_REPORTED
        ];
    }



}
