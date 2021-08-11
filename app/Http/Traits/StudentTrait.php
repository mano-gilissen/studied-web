<?php



namespace App\Http\Traits;



use App\Http\Support\Key;

trait StudentTrait {





    public static function hasCustomer($student) {

        return $student->getCustomer != null;

    }



    public static function getNiveauText($status) {

        switch ($status) {

            case 1:                                         return "VMBO Basis";
            case 2:                                         return "VMBO Kader";
            case 3:                                         return "VMBO TL";
            case 4:                                         return "HAVO";
            case 5:                                         return "Atheneum";
            case 6:                                         return "Gymnasium";
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
