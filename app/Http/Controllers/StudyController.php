<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Traits\BaseTrait;
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



    /* TODO: REBUILD AS GENERIC LIST SETUP METHOD */

    public function list() {

        $counters                                           = $this->list_counters();
        $columns                                            = $this->list_columns();

        $spacing                                            = self::spacing($columns);

        $objects                                            = Study::all();

        $items                                              = [];

        foreach ($objects as $object) {

            $item                                           = [];

            foreach ($columns as $column) {

                $item[$column->label]                       = $this->getValue($object, $column);
                $item[Key::LIST_ITEM_LINK]                  = $this->getLink($object);
            }

            array_push($items, (object) $item);
        }

        return view(Views::LIST_STUDY, [

            Key::PAGE_TITLE                                 => 'Lessen',

            'columns'                                       => $columns,
            'counters'                                      => $counters,
            'column_spacing'                                => $spacing,
            'items'                                         => $items,
        ]);
    }

    public function list_counters() {

        $COUNTER_PLANNED            = (object) [
            Key::LIST_COUNTER_LABEL                         => 'Ingepland',
            Key::LIST_COUNTER_VALUE                         => Study::where(self::$STUDY_STATUS, self::$STATUS_PLANNED)->count()
        ];

        $COUNTER_REPORTED           = (object) [
            Key::LIST_COUNTER_LABEL                         => 'Gerapporteerd',
            Key::LIST_COUNTER_VALUE                         => Study::where(self::$STUDY_STATUS, self::$STATUS_REPORTED)->count()
        ];

        return [
            $COUNTER_PLANNED,
            $COUNTER_REPORTED
        ];
    }

    public function list_columns() {

        return [
            self::column(self::$COLUMN_DATE, 1),
            self::column(self::$COLUMN_STUDENT, 2),
            self::column(self::$COLUMN_HOST, 2),
            self::column(self::$COLUMN_SUBJECT, 1),
            self::column(self::$COLUMN_LOCATION, 2),
            self::column(self::$COLUMN_TIME, 1),
            self::column(self::$COLUMN_STATUS, 2)
        ];
    }

    public function getLink($study) {

        return route('study.view', ['key' => $study->{self::$BASE_KEY}]);

    }

    public function getValue($study, $column) {

        switch ($column->label) {

            case self::$COLUMN_DATE:

                return Format::datetime($study->{self::$BASE_CREATED_AT}, Format::$DATETIME_LIST);

            case self::$COLUMN_STUDENT:

                return 'Value Student';

            case self::$COLUMN_HOST:

                return UserTrait::getFullName($study->getHost->getPerson);

            case self::$COLUMN_SUBJECT:

                return $study->getSubject_Defined ? $study->getSubject_Defined->{self::$SUBJECT_CODE} : $study->{self::$STUDY_SUBJECT_TEXT};

            case self::$COLUMN_LOCATION:

                return $study->getLocation_Defined ? $study->getSubject_Defined->{self::$LOCATION_NAME} : $study->{self::$STUDY_LOCATION_TEXT};

            case self::$COLUMN_TIME:

                return $study->start . ' - ' . $study->end;

            case self::$COLUMN_STATUS:

                return StudyTrait::getStatus($study);

            default:

                return 'No value';
        }
    }



    // TODO: EXPORT TO GENERIC LIST METHOD CLASS

    public static function column($label, $spacing, $type = null) {

        return (object) [
            Key::LIST_COLUMN_LABEL                          => $label,
            Key::LIST_COLUMN_SPACING                        => $spacing,
            Key::LIST_COLUMN_TYPE                           => $type
        ];
    }

    public static function spacing($columns) {

        $column_spacing = '';

        foreach ($columns as $column) {

            $column_spacing .= $column->{Key::LIST_COLUMN_SPACING}."fr ";

        }

        return $column_spacing;
    }



}
