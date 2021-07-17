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



class StudyController extends Controller {



    use BaseTrait;



    private static

        $COLUMN_DATE                                        = 'Datum',
        $COLUMN_STUDENT                                     = 'Leerling',
        $COLUMN_HOST                                        = 'Student',
        $COLUMN_SUBJECT                                     = 'Vak',
        $COLUMN_SERVICE                                     = 'Soort',
        $COLUMN_LOCATION                                    = 'Locatie',
        $COLUMN_TIME                                        = 'Tijdstip',
        $COLUMN_STATUS                                      = 'Status';



    public function view($key) {

        $study = Study::where(self::$BASE_KEY, $key)->firstOrFail();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                                 => $study->getService->{self::$SERVICE_NAME},

            self::$STUDY                                                    => $study,
            'button_contact_host'                                           => true,
        ]);
    }





    public function list() {

        return Table::view($this, Views::LIST_STUDY, 'Lessen', Study::all());

    }

    public function list_counters() {

        $COUNTER_PLANNED            = (object) [
            Table::COUNTER_LABEL                         => 'Ingepland',
            Table::COUNTER_VALUE                         => Study::where(self::$STUDY_STATUS, self::$STATUS_PLANNED)->count()
        ];

        $COUNTER_REPORTED           = (object) [
            Table::COUNTER_LABEL                         => 'Gerapporteerd',
            Table::COUNTER_VALUE                         => Study::where(self::$STUDY_STATUS, self::$STATUS_REPORTED)->count()
        ];

        return [
            $COUNTER_PLANNED,
            $COUNTER_REPORTED
        ];
    }

    public function list_columns() {

        $columns                                        = [];

        switch (self::getUserRole()) {

            default:
                array_push($columns, Table::column(self::$COLUMN_DATE, 3, true));

            case UserTrait::$ID_ADMINISTRATOR:
            case UserTrait::$ID_BOARD:
                array_push($columns, Table::column(self::$COLUMN_STUDENT, 4));
                array_push($columns, Table::column(self::$COLUMN_HOST, 4));
                array_push($columns, Table::column(self::$COLUMN_SERVICE, 3));  /* TODO: CHECK IF FILTERED ON SERVICE */
                break;

            case UserTrait::$ID_MANAGEMENT:
            case UserTrait::$ID_EMPLOYEE:
            case UserTrait::$ID_STUDENT:
            case UserTrait::$ID_CUSTOMER:
        }



        return [
            Table::column(self::$COLUMN_DATE, 2, true),
            Table::column(self::$COLUMN_STUDENT, 4),
            Table::column(self::$COLUMN_HOST, 4),
            Table::column(self::$COLUMN_SERVICE, 3),
            Table::column(self::$COLUMN_SUBJECT, 3),
            Table::column(self::$COLUMN_TIME, 3),
            Table::column(self::$COLUMN_STATUS, 3, true)
        ];

        return $columns;
    }

    public function list_link($study) {

        return route('study.view', ['key' => $study->{self::$BASE_KEY}]);

    }

    public function list_value($study, $column) {

        switch ($column->label) {

            case self::$COLUMN_DATE:

                return "<div style='font-weight: 400'>" . Format::datetime($study->{self::$BASE_CREATED_AT}, Format::$DATETIME_LIST) . "</div>";

            case self::$COLUMN_STUDENT:

                $participants                           = StudyTrait::getParticipants_Person($study);

                switch(count($participants)) {

                    case 0:                             return "Geen deelnemers";
                    case 1:                             return PersonTrait::getFullName($participants[0]);
                    case 2:                             return PersonTrait::getFullName($participants[0]) . ", " . PersonTrait::getFullName($participants[1]);
                    case 3:                             return $participants[0]->{self::$PERSON_FIRST_NAME} . ", " . $participants[1]->{self::$PERSON_FIRST_NAME} . " en " . $participants[2]->{self::$PERSON_FIRST_NAME};
                    default:                            return count($participants) . " personen";
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
