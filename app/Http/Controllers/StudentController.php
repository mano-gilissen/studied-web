<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Illuminate\Http\Request;
use Auth;



class StudentController extends Controller {



    use BaseTrait;



    public static

        $COLUMN_CUSTOMER                                    = 201;



    public static function list_column_label($column) {

        switch (self::getUserRole()) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_CUSTOMER:
                switch ($column) {
                    case self::$COLUMN_CUSTOMER:            return 'Klant';
                }
                break;

            case RoleTrait::$ID_EMPLOYEE:
                switch ($column) {
                    case self::$COLUMN_CUSTOMER:            return 'Ouder/Verzorger';
                }
                break;

            case RoleTrait::$ID_STUDENT:
                switch ($column) {
                    case self::$COLUMN_CUSTOMER:            return 'Ouder/Verzorger';
                }
                break;
        }

        return Key::UNKNOWN;
    }



}
