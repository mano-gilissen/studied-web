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
use App\Http\Traits\RoleTrait;
use App\Http\Traits\UserTrait;
use App\Models\Agreement;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Person;
use App\Models\Role;
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

        switch (Auth::user()->role) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
                $modules = [
                    //self::MODULE_TODO_PLAN_LOSSE_LESSEN,
                    //self::MODULE_TODO_DEFICIT_VAKAFSPRAKEN,
                    self::MODULE_GRAPHS_STATISTICS,
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
        }

        return view(Views::DASHBOARD, ['modules' => $modules]);
    }



}
