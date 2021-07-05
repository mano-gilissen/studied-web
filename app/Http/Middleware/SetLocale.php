<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale {



    public function handle($request, Closure $next) {

        setlocale(LC_TIME, 'nl_NL');

        return $next($request);
    }



}
