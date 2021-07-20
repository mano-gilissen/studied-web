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

        $data_sort                                          = $request->input(Table::DATA_SORT, null);

        $query                                              = Study::query();

        if ($data_sort) {

            switch ($data_sort[Table::COLUMN_ID]) {

                case self::$COLUMN_DATE:

                    $query->orderBy(self::$BASE_CREATED_AT, $data_sort[Table::SORT_MODE]);
                    break;

                case self::$COLUMN_STATUS:

                    $query->orderBy(self::$STUDY_STATUS, $data_sort[Table::SORT_MODE]);
                    break;

                default:

                    break;
            }
        }

        $objects                                            = $query->get();

        return Table::load($this, $objects, $data_sort);

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

    public function list_columns($sort) {

        $columns                                            = [];

        /* TODO: REMOVE COLUMNS IF FILTERED */

        switch (self::getUserRole()) {

            case UserTrait::$ID_ADMINISTRATOR:
            case UserTrait::$ID_BOARD:
            case UserTrait::$ID_MANAGEMENT:
            case UserTrait::$ID_CUSTOMER:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 3, true),
                    Table::column(self::$COLUMN_STUDENT, 'Leerling', 4),
                    Table::column(self::$COLUMN_HOST, 'Student', 4),
                    Table::column(self::$COLUMN_SERVICE, 'Onderwerp', 3),
                    Table::column(self::$COLUMN_SUBJECT, 'Dienst', 2),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true)
                );
                break;

            case UserTrait::$ID_EMPLOYEE:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 2, true),
                    Table::column(self::$COLUMN_STUDENT, 'Leerling', 3),
                    Table::column(self::$COLUMN_SERVICE, 'Type', 2),
                    Table::column(self::$COLUMN_SUBJECT, 'Vak', 2),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true)
                );
                break;

            case UserTrait::$ID_STUDENT:

                array_push($columns,
                    Table::column(self::$COLUMN_DATE, 'Datum', 2, true),
                    Table::column(self::$COLUMN_HOST, 'Student-docent', 3),
                    Table::column(self::$COLUMN_SERVICE, 'Type', 2),
                    Table::column(self::$COLUMN_SUBJECT, 'Vak', 2),
                    Table::column(self::$COLUMN_LOCATION, 'Locatie', 3),
                    Table::column(self::$COLUMN_TIME, 'Tijdstip', 3),
                    Table::column(self::$COLUMN_STATUS, 'Status', 3, true)
                );
                break;

            default:

                break;
        }

        return $columns;
    }

    public function list_link($study) {

        return route('study.view', ['key' => $study->{self::$BASE_KEY}]);

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

                return $study->getLocation_Defined ? $study->getSubject_Defined->{self::$LOCATION_NAME} : $study->{self::$STUDY_LOCATION_TEXT};

            case self::$COLUMN_TIME:

                return $study->start . ' - ' . $study->end;

            case self::$COLUMN_STATUS:

                return "<div class='tag' style='background:" . StudyTrait::getStatusColor($study) . ";color:" . StudyTrait::getStatusTextColor($study) . "'>".StudyTrait::getStatus($study)."</div>";

            default:

                return 'No value';
        }
    }



}
