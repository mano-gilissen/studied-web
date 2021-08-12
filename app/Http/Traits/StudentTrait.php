<?php



namespace App\Http\Traits;



use App\Http\Support\Key;

trait StudentTrait {





    public static function hasCustomer($student) {

        return $student->getCustomer != null;

    }



    public static function getNiveauText($status) {

        switch ($status) {

            case 1:                                         return "Vmbo-bb";
            case 2:                                         return "Vmbo-kb";
            case 3:                                         return "Vmbo-gl";
            case 4:                                         return "Vmbo-tl";
            case 5:                                         return "Tl-Havo";
            case 6:                                         return "Havo";
            case 7:                                         return "Havo/vwo";
            case 8:                                         return "Vwo";
            case 9:                                         return "Gymnasium";
            case 10:                                        return "TTO havo";
            case 11:                                        return "TTO vwo";
            case 12:                                        return "TTO gymnasium";
            default:                                        return Key::UNKNOWN;
        }
    }



    public static function getNiveauFilterData() {

        return [
            1                                               => self::getNiveauText(1),
            2                                               => self::getNiveauText(2),
            3                                               => self::getNiveauText(3),
            4                                               => self::getNiveauText(4),
            5                                               => self::getNiveauText(5),
            6                                               => self::getNiveauText(6)
        ];
    }



    public static function getLeerjaarFilterData() {

        return [
            1                                               => 1,
            2                                               => 2,
            3                                               => 3,
            4                                               => 4,
            5                                               => 5,
            6                                               => 6
        ];
    }





}
