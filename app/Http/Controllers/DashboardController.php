<?php

namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Route;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Support\Views;
use App\Http\Support\Model;
use App\Http\Traits\SubjectTrait;
use App\Http\Traits\UserTrait;
use App\Models\Agreement;
use App\Models\Announcement;
use App\Models\Report;
use App\Models\Service;
use App\Models\Study;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class DashboardController extends Controller {



    use BaseTrait;



    public const

        MODULE_GRAPHS_STATISTICS                                = 'graphs_statistics',
        MODULE_ANNOUNCEMENTS                                    = 'announcements',
        MODULE_TODO                                             = 'todo';





    public function view() {

        $data                                                   = [];
        $modules                                                = [];
        $role                                                   = Auth::user()->role;

        if (in_array($role, [
            RoleTrait::$ID_ADMINISTRATOR,
            RoleTrait::$ID_BOARD,
            RoleTrait::$ID_MANAGEMENT
        ])) {
            $modules[]                                          = self::MODULE_GRAPHS_STATISTICS;
            $data['data__graph_statistics']                     = self::getModuleData_graphStatistics();
        }

        if (in_array($role, [
            RoleTrait::$ID_BOARD,
            RoleTrait::$ID_MANAGEMENT,
            RoleTrait::$ID_EMPLOYEE
        ])) {
            $modules[]                                          = self::MODULE_TODO;
            $data['data__todo']                                 = self::getModuleData_todo();
        }

        $modules[]                                              = self::MODULE_ANNOUNCEMENTS;
        $data['data__announcements']                            = self::getModuleData_announcements();
        $data['modules']                                        = $modules;

        return view(Views::DASHBOARD, $data);
    }





    public static function getModuleData_graphStatistics() {

        $data_module = [
            'revenue' => [
                'bijles' => [],
                'training' => [],
                'huiswerkbegeleiding' => [],
                'taalles' => [],
                'taalcursus' => [],
                'coaching' => [],
                'total' => []
            ],

            'studies' => [
                StudyTrait::$STATUS_PLANNED => [],
                StudyTrait::$STATUS_REPORTED => [],
                StudyTrait::$STATUS_CANCELLED => [],
                StudyTrait::$STATUS_ABSENT => [],
                'total' => []
            ]
        ];

        /** Create an array populated with each year and month since September 2023 **/

        $dates = [];

        for ($year = 2023; $year <= date('Y'); $year++) {
            $start = ($year == 2023) ? 9 : 1;
            for ($month = $start; $month <= 12; $month++) {
                $dates[$year][] = $month;
            }
        }

        foreach ($dates as $year => $months) {

            foreach ($months as $month) {

                foreach (array_keys($data_module['revenue']) as $key) {

                    $data_module['revenue'][$key][$year][$month] = 0;

                }

                foreach (array_keys($data_module['studies']) as $key) {

                    $data_module['studies'][$key][$year][$month] = 0;

                }
            }
        }

        $studies = Study::where(Model::$STUDY_START, '>=', '2023-09-01 00:00:00')
                        ->where(Model::$BASE_DELETED_AT, null)
                        ->get();

        foreach ($studies as $study) {

            $revenue = 0;
            $plan = null;
            $group = $study->getParticipants_User->count() > 1;
            $service = strtolower($study->getService->{Model::$SERVICE_SHORT});

            if ($study->{Model::$STUDY_STATUS} == StudyTrait::$STATUS_CANCELLED) {

                continue;

            }

            foreach ($study->getAgreements as $agreement) {

                $user = $agreement->getStudent;
                $plan = $agreement->{Model::$AGREEMENT_PLAN};
                $rate_name = 'rate_plan' . $plan . '_' . ($group ? 'group' : 'solo');
                $rate = Service::find($study->{Model::$SERVICE})->{$rate_name};
                $report = $study->getReport($user);

                if ($report) {

                    if ($report->{Model::$STUDY_TRIAL} && !$report->{Model::$REPORT_TRIAL_SUCCESS}) {

                        continue;

                    }

                    $duration = ReportTrait::getDurationTotal($report) / 60.0;

                } else {

                    $duration = StudyTrait::getDuration($study) / 60.0;

                }

                $revenue += $duration * $rate;
            }

            $date = strtotime($study->{Model::$STUDY_START});
            $year = date('Y', $date);
            $month = date('n', $date);

            $data_module['revenue'][$service][$year][$month] += $revenue;
            $data_module['revenue']['total'][$year][$month] += $revenue;
        }

        foreach ($studies as $study) {

            $date = strtotime($study->{Model::$STUDY_START});
            $year = date('Y', $date);
            $month = date('n', $date);

            $data_module['studies'][$study->{Model::$STUDY_STATUS}][$year][$month] += 1;
            $data_module['studies']['total'][$year][$month] += 1;
        }

        return $data_module;
    }





    public static function getModuleData_announcements() {

        $role                                                               = Auth::user()->role;
        $query                                                              = Announcement::where(Model::$BASE_DELETED_AT, null);

        if (!in_array($role, [RoleTrait::$ID_ADMINISTRATOR, RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT])) {

            $query->whereIn(Model::$ROLE, [$role, 0]);

        }

        return $query->orderBy(Model::$BASE_CREATED_AT, 'desc')->get();
    }





    public static function getModuleData_todo() {

        $todos                                              = [];

        $reports                                            = Report::where(Model::$REPORT_FLAGGED, true)
                                                            ->where(Model::$BASE_DELETED_AT, null)
                                                            ->whereHas('getStudy', function (Builder $query) {
                                                            $query->where(Model::$STUDY_HOST_USER, Auth::id())
                                                            ->where(Model::$BASE_DELETED_AT, null);
                                                            })->get();

        foreach ($reports as $report) {

            $participants                                   = StudyTrait::getParticipantsText($report->getStudy);
            $link                                           = route(Route::STUDY_VIEW, $report->getStudy->{Model::$BASE_KEY});
            $title                                          = __('Je rapport voor :participants op :date is afgekeurd.', [
                'participants' => $participants,
                'date' => Format::datetime($report->getStudy->{Model::$STUDY_START}, Format::$DATETIME_EMAIL)
            ]);

            $description = __('Klik op dit bericht om het rapport te bekijken en aan te passen.');

            $todos[]                                        = [
                'title'                                     => $title,
                'description'                               => $description,
                'link'                                      => $link,
                'priority'                                  => 'high',
                'icon'                                      => 'flag',
            ];
        }



        $agreements                                         = Agreement::where(Model::$EMPLOYEE, Auth::id())
            ->where(Model::$AGREEMENT_STATUS, '!=', AgreementTrait::$STATUS_FINISHED)
            ->where(Model::$AGREEMENT_START, '<', date(Format::$DATABASE_DATE))
            ->where(Model::$AGREEMENT_START, '>=', '2025-04-01')
            ->where(Model::$AGREEMENT_PLAN, '!=', AgreementTrait::$PLAN_LOSSE_LESSEN)
            ->get();

        foreach ($agreements as $agreement) {

            $deficit                                        = AgreementTrait::calculateDeficit($agreement);

            if ($deficit >= 1) {

                $student                                    = $agreement->getStudent->getPerson->{Model::$PERSON_FIRST_NAME};
                $link                                       = route(Route::AGREEMENT_VIEW, $agreement->{Model::$AGREEMENT_IDENTIFIER});
                $title                                      = __('Je hebt een achterstand aan lessen :subject met :student', [
                    'student' => $student,
                    'subject' => $agreement->getSubject->{Model::$SUBJECT_NAME},
                ]);

                $description                                = __('Plan :deficit uur aan lessen extra in om deze achterstand in te halen.', [
                    'deficit' => str_replace('.', ',', $deficit)
                ]);

                $todos[]                                    = [
                    'title'                                 => $title,
                    'description'                           => $description,
                    'link'                                  => $link,
                    'priority'                              => 'medium',
                ];
            }
        }



        $agreements                                         = Agreement::where(Model::$EMPLOYEE, Auth::id())
            ->where(Model::$AGREEMENT_STATUS, '!=', AgreementTrait::$STATUS_FINISHED)
            ->where(Model::$AGREEMENT_START, '<=', date(Format::$DATABASE_DATE))
            ->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATE))
            ->where(Model::$AGREEMENT_PLAN, '=', AgreementTrait::$PLAN_LOSSE_LESSEN)
            ->get();

        foreach ($agreements as $agreement) {

            $student                                        = $agreement->getStudent->getPerson->{Model::$PERSON_FIRST_NAME};
            $link                                           = route(Route::AGREEMENT_VIEW, $agreement->{Model::$AGREEMENT_IDENTIFIER});
            $title                                          = __('Je hebt nog geen vervolgles :subject ingepland met :student.', [
                'student' => $student,
                'subject' => $agreement->getSubject->{Model::$SUBJECT_NAME},
            ]);

            $description                                    = __('Klik op dit bericht om de vakafspraak te bekijken en een nieuwe les in te plannen.');

            $todos[]                                        = [
                'title'                                     => $title,
                'description'                               => $description,
                'link'                                      => $link,
                'priority'                                  => 'medium',
            ];
        }

        return $todos;
    }





    public static function announcement_create() {

        $data                                                               = [];

        $data[Key::SUBMIT_ROUTE]                                            = Route::ANNOUNCEMENT_CREATE_SUBMIT;
        $data[Key::SUBMIT_ACTION]                                           = __('Versturen');
        $data[Key::PAGE_TITLE]                                              = __('Aankondiging versturen');
        $data[Key::BACK_ROUTE]                                              = 'dashboard.view';

        self::form_set_ac_data_role($data);

        return view(Views::FORM_ANNOUNCEMENT_CREATE, $data);
    }



    public static function announcement_submit(Request $request) {

        $validator = Validator::make($request->all(), [
            'title'                                                         => 'required|string|max:999',
            'body'                                                          => 'required|string',
            'author'                                                        => 'nullable|string|max:999',
        ]);

        $validator->validate();

        $announcement                                                       = new Announcement();

        $announcement->title                                                = $request->input('title');
        $announcement->body                                                 = $request->input('body');
        $announcement->author                                               = $request->input('author', null);
        $announcement->role                                                 = $request->input('_role');

        $announcement->save();

        return view(Views::FEEDBACK, [
            Key::PAGE_TITLE                                                 => __('Aankondiging verstuurd'),
            Key::PAGE_MESSAGE                                               => 'Alle ontvangers worden per email<br>op de hoogte gebracht.',
            Key::PAGE_NEXT                                                  => route(Route::DASHBOARD_VIEW),
            Key::PAGE_ACTION                                                => __('Naar het dashboard'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }



    public static function announcement_send_emails() {

        $announcements = Announcement::where('sent', false)->get();

        foreach ($announcements as $announcement) {

            $query = User::where(Model::$BASE_DELETED_AT, null);

            if ($announcement->role == 0) {

                $users = $query->get();

            } else {

                $users = $query->where(Model::$ROLE, $announcement->role)->get();

            }

            foreach ($users as $user) {

                Mail::announcementCreated($user);

            }

            $announcement->sent = true;
            $announcement->save();
        }
    }



    public static function form_set_ac_data_role(&$data) {

        $ac_data                                                            = [
            0                                                               => __('Iedereen'),
            RoleTrait::$ID_MANAGEMENT                                       => __('Management'),
            RoleTrait::$ID_EMPLOYEE                                         => __('Medewerkers'),
            RoleTrait::$ID_STUDENT                                          => __('Leerlingen'),
            RoleTrait::$ID_CUSTOMER                                         => __('Klanten')
        ];

        $data[Key::AUTOCOMPLETE_DATA . Model::$ROLE]                        = Format::encode($ac_data);
    }





}
