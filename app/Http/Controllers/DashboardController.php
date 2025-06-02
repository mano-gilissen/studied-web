<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Locale;
use App\Http\Support\Format;
use App\Http\Support\Route;
use App\Http\Support\Table;
use App\Http\Traits\AddressTrait;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\CustomerTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\Agreement;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Person;
use App\Models\Role;
use App\Models\Service;
use App\Models\Study;
use Cassandra\Custom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;



class DashboardController extends Controller {



    use BaseTrait;



    public const

        MODULE_TODO_PLAN_LOSSE_LESSEN                           = 'todo_plan_losse_lessons',
        MODULE_TODO_DEFICIT_VAKAFSPRAKEN                        = 'todo_deficit_vakafspraken',
        MODULE_GRAPHS_STATISTICS                                = 'graphs_statistics',
        MODULE_ANNOUNCEMENTS                                    = 'announcements',
        MODULE_ANNOUNCEMENTS_SEND                               = 'announcements_send';





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

/*
        switch (Auth::user()->role) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
                $modules = [
                    //self::MODULE_TODO_PLAN_LOSSE_LESSEN,
                    //self::MODULE_TODO_DEFICIT_VAKAFSPRAKEN,
                    //self::MODULE_ANNOUNCEMENTS,
                    //self::MODULE_ANNOUNCEMENTS_SEND
                ];
                break;

            case RoleTrait::$ID_EMPLOYEE:
                $modules = [
                    self::MODULE_TODO_PLAN_LOSSE_LESSEN,
                    self::MODULE_TODO_DEFICIT_VAKAFSPRAKEN,
                    self::MODULE_ANNOUNCEMENTS
                ];
                break;

            case RoleTrait::$ID_STUDENT:
            case RoleTrait::$ID_CUSTOMER:
                $modules = [
                    self::MODULE_ANNOUNCEMENTS
                ];
                break;
        }*/

        $data['modules'] = $modules;

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

            if (!in_array($study->{Model::$STUDY_STATUS}, [
                StudyTrait::$STATUS_REPORTED,
                StudyTrait::$STATUS_ABSENT,
                StudyTrait::$STATUS_CANCELLED
            ])) {

                continue;

            }

            $revenue = 0;
            $plan = null;
            $group = $study->getParticipants_User->count() > 1;
            $service = strtolower($study->getService->{Model::$SERVICE_SHORT});

            if ($study->{Model::$STUDY_STATUS} == StudyTrait::$STATUS_CANCELLED) {

                if ($study->{Model::$STUDY_REASON_CANCEL} == StudyTrait::$REASON_CANCEL_STUDIED) {

                    continue;

                }
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



}
