<?php



namespace App\Http\Middleware;

use App\Http\Support\Model;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Session;
use App\Models\User;
use Auth;



class Locale {



    const
        LOCALE_NL                                       = 'nl_NL',
        LOCALE_EN                                       = 'en';



    public function handle($request, Closure $next) {

        setlocale(LC_TIME, self::getActive());

        App::setLocale(self::getActive());

        ini_set( 'date.timezone', 'Europe/Amsterdam');

        date_default_timezone_set('Europe/Amsterdam');

        return $next($request);
    }



    public static function getActive() {

        dd(Auth::user()->{Model::$USER_LANGUAGE});

        return Auth::check() ? Auth::user()->{Model::$USER_LANGUAGE} : self::LOCALE_NL;

    }



    public static function getActive_text() {

        return self::getOption_text(self::getActive());

    }



    public static function getOptions() {

        return [
            self::LOCALE_NL,
            self::LOCALE_EN,
        ];
    }



    public static function getOption_text($option) {

        switch ($option) {

            case self::LOCALE_NL:

                return __('Nederlands');

            case self::LOCALE_EN:

                return __('Engels');

            default:

                return __('Onbekend');
        }
    }



}
