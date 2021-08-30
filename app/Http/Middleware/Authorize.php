<?php



namespace App\Http\Middleware;

use App\Http\Support\Route;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\RoleTrait;
use Closure;
use Auth;



class Authorize {





    use BaseTrait;





    public function handle($request, Closure $next, $guard = null) {

        $role                               = Auth::check() ? Auth::user()->role : null;
        $route                              = $request->route()->getName();
        $routes                             = [];

        switch($role) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
                $routes                     = array_merge(Route::ALL_AUTH, $routes);
                $routes                     = array_merge(ROUTE::ALL_BOARD, $routes);
                $routes                     = array_merge(ROUTE::ALL_MANAGEMENT, $routes);
                $routes                     = array_merge(ROUTE::ALL_EMPLOYEE, $routes);
                break;

            case RoleTrait::$ID_MANAGEMENT:
                $routes                     = array_merge(Route::ALL_AUTH, $routes);
                $routes                     = array_merge(ROUTE::ALL_MANAGEMENT, $routes);
                $routes                     = array_merge(ROUTE::ALL_EMPLOYEE, $routes);
                break;

            case RoleTrait::$ID_EMPLOYEE:
                $routes                     = array_merge(Route::ALL_AUTH, $routes);
                $routes                     = array_merge(ROUTE::ALL_EMPLOYEE, $routes);
                break;

            case RoleTrait::$ID_STUDENT:
                $routes                     = array_merge(Route::ALL_AUTH, $routes);
                $routes                     = array_merge(ROUTE::ALL_STUDENT, $routes);
                break;

            case RoleTrait::$ID_CUSTOMER:
                $routes                     = array_merge(Route::ALL_AUTH, $routes);
                $routes                     = array_merge(ROUTE::ALL_CUSTOMER, $routes);
                break;
        }



        if (!in_array($route, $routes)) {

            abort(403);

        }

        return $next($request);
    }





}
