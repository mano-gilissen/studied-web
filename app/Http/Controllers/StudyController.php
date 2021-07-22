<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Table;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\SubjectTrait;
use App\Http\Traits\UserTrait;
use App\Models\Study;
use App\Http\Support\Key;
use App\Http\Support\Views;
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

        $study = Study::where(self::$BASE_KEY, $key)->firstOrFail();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                 => $study->getService->{self::$SERVICE_NAME},

            self::$STUDY                                    => $study,
            'button_contact_host'                           => true,
        ]);
    }





    public function list() {

        return view(Views::LIST_STUDY, [

            Key::PAGE_TITLE                                 => 'Lessen',

            Table::DATA_TYPE                                => self::$STUDY,
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

        return self::$STUDY;

    }



    public function list_columns($sort) {

        $columns                                            = [];

        /* TODO: REMOVE COLUMNS IF FILTERED */

        switch (self::getUserRole()) {

            case UserTrait::$ID_ADMINISTRATOR:
            case UserTrait::$ID_BOARD:
            case UserTrait::$ID_MANAGEMENT:
            case UserTrait::$ID_CUSTOMER:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 3, true, $sort, true),
                    Table::column(self::$COLUMN_STUDENT, 'Leerling', 4, true, $sort),
                    Table::column(self::$COLUMN_HOST, 'Student', 4, true, $sort),
                    Table::column(self::$COLUMN_SERVICE, 'Dienst', 3, true, $sort),
                    Table::column(self::$COLUMN_SUBJECT, 'Onderwerp', 2, false, $sort),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3, false, $sort),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3, true, $sort),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true, $sort, true)
                );
                break;

            case UserTrait::$ID_EMPLOYEE:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 2, true, $sort, true),
                    Table::column(self::$COLUMN_STUDENT, 'Leerling', 3, true, $sort),
                    Table::column(self::$COLUMN_SERVICE, 'Type', 2, true, $sort),
                    Table::column(self::$COLUMN_SUBJECT, 'Vak', 2, false, $sort),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3, false, $sort),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3, true, $sort),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true, $sort, true)
                );
                break;

            case UserTrait::$ID_STUDENT:

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

                return "<div style='font-weight: 400'>" . Format::datetime($study->{self::$BASE_CREATED_AT}, Format::$DATETIME_LIST) . "</div>";

            case self::$COLUMN_STUDENT:

                $participants                               = StudyTrait::getParticipants_Person($study);

                switch(count($participants)) {

                    case 0:                                 return "Geen deelnemers";
                    case 1:                                 return PersonTrait::getFullName($participants[0]);
                    case 2:                                 return $participants[0]->{self::$PERSON_FIRST_NAME} . " en " . $participants[1]->{self::$PERSON_FIRST_NAME};
                    case 3:                                 return $participants[0]->{self::$PERSON_FIRST_NAME} . ", " . $participants[1]->{self::$PERSON_FIRST_NAME} . " en " . $participants[2]->{self::$PERSON_FIRST_NAME};
                    default:                                return count($participants) . " deelnemers";
                }

            case self::$COLUMN_HOST:

                return UserTrait::getFullName($study->getHost->getPerson);

            case self::$COLUMN_SERVICE:

                return $study->getService->{self::$SERVICE_NAME};

            case self::$COLUMN_SUBJECT:

                return $study->getSubject_Defined ? $study->getSubject_Defined->{self::$SUBJECT_CODE} : $study->{self::$STUDY_SUBJECT_TEXT};

            case self::$COLUMN_LOCATION:

                return $study->getLocation_Defined ? $study->getLocation_Defined->{self::$LOCATION_NAME} : $study->{self::$STUDY_LOCATION_TEXT};

            case self::$COLUMN_TIME:

                return $study->start . ' - ' . $study->end;

            case self::$COLUMN_STATUS:

                return "<div class='tag' style='background:" . StudyTrait::getStatusColor($study) . ";color:" . StudyTrait::getStatusTextColor($study) . "'>".StudyTrait::getStatus($study)."</div>";

            default:

                return 'No value';
        }
    }



    public function list_link($study) {

        return route('study.view', ['key' => $study->{self::$BASE_KEY}]);

    }



    public function list_sort($query, $sort) {

        switch ($sort[Table::COLUMN_ID]) {

            case self::$COLUMN_DATE:

                $query->orderBy(self::$BASE_CREATED_AT, $sort[Table::SORT_MODE]);
                break;

            case self::$COLUMN_STATUS:

                $query->orderBy(self::$STUDY_STATUS, $sort[Table::SORT_MODE]);
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

                $query->join(self::$USER, self::$USER . '.' . self::$BASE_ID, '=', self::$STUDY . '.' . self::$STUDY_HOST_USER);
                $query->join(self::$PERSON, self::$PERSON . '.' . self::$BASE_ID, '=', self::$USER . '.' . self::$PERSON);
                $query->orderBy(self::$PERSON . '.' . self::$PERSON_FIRST_NAME, $sort[Table::SORT_MODE]);
                break;

            case self::$COLUMN_SERVICE:

                $query->join(self::$SERVICE, self::$SERVICE . '.' . self::$BASE_ID, '=', self::$STUDY . '.' . self::$SERVICE);
                $query->orderBy(self::$SERVICE . '.' . self::$SERVICE_NAME, $sort[Table::SORT_MODE]);
                break;
        }
    }



    public function list_counters() {

        $COUNTER_PLANNED            = (object) [
            Table::COUNTER_LABEL                            => 'Ingepland',
            Table::COUNTER_VALUE                            => Study::where(self::$STUDY_STATUS, self::$STATUS_PLANNED)->count()
        ];

        $COUNTER_REPORTED           = (object) [
            Table::COUNTER_LABEL                            => 'Gerapporteerd',
            Table::COUNTER_VALUE                            => Study::where(self::$STUDY_STATUS, self::$STATUS_REPORTED)->count()
        ];

        return [
            $COUNTER_PLANNED,
            $COUNTER_REPORTED
        ];
    }



}
