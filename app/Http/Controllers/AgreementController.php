<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Table;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Models\Agreement;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Evaluation;
use App\Models\Level;
use App\Models\Person;
use App\Models\Report;
use App\Models\Service;
use App\Models\Student;
use App\Models\Study;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class AgreementController extends Controller {





    use BaseTrait;





    public static

        $COLUMN_STUDENT                                                     = 401,
        $COLUMN_EMPLOYEE                                                    = 402,
        $COLUMN_SERVICE                                                     = 403,
        $COLUMN_PLAN                                                        = 404,
        $COLUMN_SUBJECT                                                     = 405,
        $COLUMN_START                                                       = 406,
        $COLUMN_END                                                         = 407,
        $COLUMN_HOURS_AGREED                                                = 408,
        $COLUMN_HOURS_MADE                                                  = 409,
        $COLUMN_STATUS                                                      = 410;





    public function view($identifier) {

        $agreement                                                          = Agreement::where(Model::$AGREEMENT_IDENTIFIER, $identifier)->firstOrFail();

        return view(Views::AGREEMENT, [

            Key::PAGE_TITLE                                                 => 'Vakafspraak',
            Key::PAGE_BACK                                                  => false,

            Model::$AGREEMENT                                               => $agreement
        ]);
    }



    public function create($leerling) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $leerling)->firstOrFail();
        $student_id                                                         = $person->getUser->{Model::$BASE_ID};

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = 'Nieuwe vakafspraak';
        $data[Key::SUBMIT_ACTION]                                           = 'Aanmaken';
        $data[Key::SUBMIT_ROUTE]                                            = 'agreement.create_submit';
        $data[Key::SINGLE]                                                  = true;



        self::create_set_ac_data($data, $student_id);



        return view(Views::FORM_AGREEMENT_CREATE, $data);
    }



    public function create_extend($id) {

        $agreement                                                          = Agreement::findOrFail($id);

        $data                                                               = [];

        $data[Model::$AGREEMENT_HOURS]                                      = $agreement->{Model::$AGREEMENT_HOURS};
        $data[Model::$AGREEMENT_PLAN]                                       = $agreement->{Model::$AGREEMENT_PLAN};

        $data[Model::$EMPLOYEE]                                             = $agreement->{Model::$EMPLOYEE};
        $data[Model::$SERVICE]                                              = $agreement->{Model::$SERVICE};
        $data[Model::$SUBJECT]                                              = $agreement->{Model::$SUBJECT};
        $data[Model::$LEVEL]                                                = $agreement->{Model::$LEVEL};

        return $data;
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();

        self::create_validate($data);

        $agreement                                                          = AgreementTrait::create($data);

        if (!$agreement) {

            abort(500);

        }

        return redirect()->route('agreement.view', [Model::$AGREEMENT_IDENTIFIER => $agreement->{Model::$AGREEMENT_IDENTIFIER}]);

    }



    public function create_validate($data) {

        $rules                                                              = [];

        // TODO: ADD RULES

        $validator                                                          = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }



    public static function create_set_ac_data(&$data, $student_id) {

        $objects_employee                                                   = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_EMPLOYEE))->with('getPerson')->get();
        $objects_student                                                    = User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)->with('getPerson')->get();
        $objects_service                                                    = Service::all();
        $objects_subject                                                    = Subject::all();
        $objects_level                                                      = Level::all();
        $objects_agreement                                                  = Agreement::where(Model::$STUDENT, $student_id)->with('getSubject')->get();



        $ac_data_employee                                                   = $objects_employee->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_employee                                             = $objects_employee->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_student                                                    = $objects_student->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_student                                              = $objects_student->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_service                                                    = $objects_service->pluck(Model::$SERVICE_NAME, Model::$BASE_ID)->toArray();
        $ac_data_subject                                                    = $objects_subject->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();
        $ac_data_level                                                      = $objects_level->pluck('withYear', Model::$BASE_ID)->toArray();

        $ac_data_agreements                                                 = $objects_agreement->pluck(Model::$AGREEMENT_IDENTIFIER, Model::$BASE_ID)->toArray();
        $ac_additional_agreements                                           = $objects_agreement->pluck('getSubject.' . Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();



        $data[Model::$STUDENT]                                              = $student_id;

        $data[Key::AUTOCOMPLETE_DATA . Model::$EMPLOYEE]                    = Format::encode($ac_data_employee);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$EMPLOYEE]              = Format::encode($ac_additional_employee);

        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT]                     = Format::encode($ac_data_student);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$STUDENT]               = Format::encode($ac_additional_student);

        $data[Key::AUTOCOMPLETE_DATA . Model::$AGREEMENT_PLAN]              = Format::encode(AgreementTrait::getPlanFilterData());
        $data[Key::AUTOCOMPLETE_DATA . Model::$SERVICE]                     = Format::encode($ac_data_service);
        $data[Key::AUTOCOMPLETE_DATA . Model::$SUBJECT]                     = Format::encode($ac_data_subject);
        $data[Key::AUTOCOMPLETE_DATA . Model::$LEVEL]                       = Format::encode($ac_data_level);

        $data[Key::AUTOCOMPLETE_DATA . 'replace']                           = Format::encode($ac_data_agreements);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . 'replace']                     = Format::encode($ac_additional_agreements);
    }





    public function list(Request $request) {

        return Table::view($this, $request);

    }



    public function list_load(Request $request) {

        return Table::load($this, $request);

    }



    public function list_type() {

        return Model::$AGREEMENT;

    }



    public function list_view() {

        return Views::LIST_AGREEMENT;

    }



    public function list_title() {

        return 'Vakafspraken';

    }



    public function list_columns($sort, $filter) {

        $columns                                            = [];

        array_push($columns,

            Table::column(self::$COLUMN_STUDENT, self::list_column_label(self::$COLUMN_STUDENT), 1, false, $sort, false, $filter, true),
            Table::column(self::$COLUMN_EMPLOYEE, self::list_column_label(self::$COLUMN_EMPLOYEE), 1, false, $sort, false, $filter),
            Table::column(self::$COLUMN_SERVICE, self::list_column_label(self::$COLUMN_SERVICE), 1, false, $sort, false, $filter),
            Table::column(self::$COLUMN_PLAN, self::list_column_label(self::$COLUMN_PLAN), 1, false, $sort, true, $filter),
            Table::column(self::$COLUMN_SUBJECT, self::list_column_label(self::$COLUMN_SUBJECT), 1, false, $sort, false, $filter),
            Table::column(self::$COLUMN_START, self::list_column_label(self::$COLUMN_START), 1, false, $sort, true, $filter),
            Table::column(self::$COLUMN_END, self::list_column_label(self::$COLUMN_END), 1, true, $sort, true, $filter),
            Table::column(self::$COLUMN_HOURS_AGREED, self::list_column_label(self::$COLUMN_HOURS_AGREED), 1, false, $sort, false, $filter),
            Table::column(self::$COLUMN_HOURS_MADE, self::list_column_label(self::$COLUMN_HOURS_MADE), 1, false, $sort, false, $filter),
            Table::column(self::$COLUMN_STATUS, self::list_column_label(self::$COLUMN_STATUS), 1, false, $sort, true, $filter, true)
        );

        return $columns;
    }



    public static function list_column_label($column) {

        switch ($column) {
            case self::$COLUMN_STUDENT:             return "Leerling";
            case self::$COLUMN_EMPLOYEE:            return "Medewerker";
            case self::$COLUMN_SERVICE:             return "Dienst";
            case self::$COLUMN_PLAN:                return "Begeleidingsvorm";
            case self::$COLUMN_SUBJECT:             return "Vak";
            case self::$COLUMN_START:               return "Start";
            case self::$COLUMN_END:                 return "Einde";
            case self::$COLUMN_HOURS_AGREED:        return "Uren afspraak";
            case self::$COLUMN_HOURS_MADE:          return "Uren gemaakt";
            case self::$COLUMN_STATUS:              return "Status";
        }

        return Key::UNKNOWN;
    }



    public function list_value($agreement, $column) {

        switch ($column->{Table::COLUMN_ID}) {

            case self::$COLUMN_STUDENT:

                return "<div style='font-weight: 400'>" . PersonTrait::getFullName($agreement->getStudent->getPerson) . "</div>";

            case self::$COLUMN_EMPLOYEE:

                return PersonTrait::getFullName($agreement->getEmployee->getPerson);

            case self::$COLUMN_SERVICE:

                return $agreement->getService->{Model::$SERVICE_SHORT};

            case self::$COLUMN_PLAN:

                return AgreementTrait::getPlanText($agreement->{Model::$AGREEMENT_PLAN});

            case self::$COLUMN_SUBJECT:

                return AgreementTrait::getVakcode($agreement);

            case self::$COLUMN_START:

                return $agreement->{Model::$AGREEMENT_START} ? Format::datetime($agreement->{Model::$AGREEMENT_START}, Format::$DATETIME_LIST) : '-';

            case self::$COLUMN_END:

                return $agreement->{Model::$AGREEMENT_END} ? Format::datetime($agreement->{Model::$AGREEMENT_END}, Format::$DATETIME_LIST) : '-';

            case self::$COLUMN_HOURS_AGREED:

                return AgreementTrait::getHoursTotal($agreement);

            case self::$COLUMN_HOURS_MADE:

                // TODO: CREATE LOAD IN (ECHO JS TO AJAX BELOW CODE)

                return AgreementTrait::getHoursMade($agreement);

            case self::$COLUMN_STATUS:

                $status = $agreement->{Model::$AGREEMENT_STATUS};

                return "<div class='tag' style='background:" . AgreementTrait::getStatusColor($status) . ";color:" . AgreementTrait::getStatusTextColor($status) . "'>".AgreementTrait::getStatusText($status)."</div>";

            default:

                return Key::UNKNOWN;
        }
    }



    public function list_link($agreement) {

        return route('agreement.view', [Model::$AGREEMENT_IDENTIFIER => $agreement->{Model::$AGREEMENT_IDENTIFIER}]);

    }



    public function list_sort($query, $sort) {

        foreach ($sort as $column => $mode) {

            if ($mode != Table::SORT_MODE_NONE) {

                switch ($column) {

                    case self::$COLUMN_STATUS:
                        $query->orderBy(Model::$AGREEMENT . '.' . Model::$AGREEMENT_STATUS, $mode);
                        break;

                    case self::$COLUMN_END:
                        $query->orderBy(Model::$AGREEMENT . '.' . Model::$AGREEMENT_END, $mode);
                        break;
                }
            }
        }
    }



    public function list_sort_default($query) {

        $query->orderBy(Model::$AGREEMENT_END, Table::SORT_MODE_DESC);

    }



    public function list_filter($query, $filter) {

        foreach ($filter as $column => $value) {

            switch ($column) {

                case self::$COLUMN_START:
                    $query
                        ->where(Model::$AGREEMENT_START, '>=', substr($value, 0, 10))
                        ->where(Model::$AGREEMENT_START, '<=', substr($value, 11, 10));
                    break;

                case self::$COLUMN_END:
                    $query
                        ->where(Model::$AGREEMENT_END, '>=', substr($value, 0, 10))
                        ->where(Model::$AGREEMENT_END, '<=', substr($value, 11, 10));
                    break;

                case self::$COLUMN_STATUS:
                    $query->where(Model::$AGREEMENT_STATUS, $value);
                    break;

                case self::$COLUMN_PLAN:
                    $query->where(Model::$AGREEMENT_PLAN, $value);
                    break;
            }
        }
    }



    public function list_filter_search($query, $value) {

        $query->where(function($query) use ($value) {

            $query

                ->whereHas('getEmployee.getPerson', function (Builder $q) use ($value) {

                    $q
                        ->where(Model::$PERSON_FIRST_NAME, 'LIKE', '%'.$value.'%')
                        ->orWhere(Model::$PERSON_LAST_NAME, 'LIKE', '%'.$value.'%');
                })

                ->orWhereHas('getStudent.getPerson', function (Builder $q) use ($value) {

                    $q
                        ->where(Model::$PERSON_FIRST_NAME, 'LIKE', '%'.$value.'%')
                        ->orWhere(Model::$PERSON_LAST_NAME, 'LIKE', '%'.$value.'%');
                });
        });
    }



    public function list_filter_default($query) {

        //

    }



    public function list_filter_parameter(&$data_filter, $parameter, $value) {

        //

    }



    public function list_filter_data($query, $column) {

        switch ($column->{Model::$BASE_ID}) {

            case self::$COLUMN_STATUS:

                return AgreementTrait::getStatusFilterData();

            case self::$COLUMN_PLAN:

                return AgreementTrait::getPlanFilterData();

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

                case self::$COLUMN_START:
                case self::$COLUMN_END:

                    $after                                  = Format::datetime(Carbon::createFromFormat(Format::$DATABASE_DATE, substr($value, 0, 10)), Format::$DATETIME_LIST);
                    $before                                 = Format::datetime(Carbon::createFromFormat(Format::$DATABASE_DATE, substr($value, 11, 10)), Format::$DATETIME_LIST);

                    $display                                = ' ' . $after . ' tot ' . $before;
                    break;

                case self::$COLUMN_STATUS:
                    $display                                = AgreementTrait::getStatusText($value);
                    break;

                case self::$COLUMN_PLAN:
                    $display                                = AgreementTrait::getPlanText($value);
                    break;
            }

            $filters[] = (object)[
                Table::COLUMN_ID                            => $filter,
                Table::FILTER_COLUMN                        => self::list_filter_label($filter),
                Table::FILTER_VALUE                         => $display
            ];
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

        self::list_counters_load_hours_agreed($query, $counters);

        self::list_counters_load_hours_made($query, $counters);

        return view(Views::LOAD_COUNTERS, [

            Table::VIEW_COUNTERS                            => $counters

        ]);
    }



    public function list_counters_load_total($query, &$counters) {

        $counters[] = (object)[
            Table::COUNTER_ID                               => 'counter-total',
            Table::COUNTER_LABEL                            => 'Totaal',
            Table::COUNTER_VALUE                            => $query
                ->select('agreement.*')
                ->get()
                ->count()
        ];
    }



    public function list_counters_load_hours_agreed($query, &$counters) {

        $total = 0;

        foreach ($query->get() as $agreement) {

            $total += AgreementTrait::getHoursTotal($agreement);

        }

        $counters[] = (object)[
            Table::COUNTER_LABEL => 'Uren afgesproken',
            Table::COUNTER_VALUE => $total
        ];
    }



    public function list_counters_load_hours_made($query, &$counters) {

        $total = 0;

        foreach ($query->get() as $agreement) {

            $total += AgreementTrait::getHoursMade($agreement);

        }

        $counters[] = (object)[
            Table::COUNTER_LABEL => 'Uren gemaakt',
            Table::COUNTER_VALUE => $total
        ];
    }





    public function finish($identifier) {

        $agreement                                                          = Agreement::where(Model::$AGREEMENT_IDENTIFIER, $identifier)->firstOrFail();

        if (!AgreementTrait::finish($agreement)) {

            abort(500);

        }

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => 'Vakafspraak afgehandeld',
            Key::PAGE_NEXT                                                  => route('agreement.view', [Model::$AGREEMENT_IDENTIFIER => $agreement->{Model::$AGREEMENT_IDENTIFIER}]),
            Key::PAGE_ACTION                                                => 'Naar de vakafspraak',
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }





}
