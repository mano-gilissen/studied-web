<?php



namespace App\Http\Traits;



use App\Http\Support\Format;
use App\Http\Support\Model;

trait AgreementTrait {



    public static function getDescription($agreement, $for_host = false) {

        return $agreement->getSubject->{Model::$SUBJECT_NAME} . ' met <span style="font-weight: 600">'
            . ($for_host ? $agreement->getStudent->getPerson->{Model::$PERSON_FIRST_NAME} : $agreement->getEmployee->getPerson->{Model::$PERSON_FIRST_NAME})
            . '</span>,<br> actief tot ' . Format::datetime($agreement->{Model::$AGREEMENT_END}, Format::$DATETIME_AGREEMENT) . '.';
    }



    public static function getVakcode($agreement) {

        dd($agreement->getLevel->{Model::$LEVEL_CODE});

        return $agreement->getSubject->{Model::$SUBJECT_CODE} . '-' . $agreement->getLevel->{Model::$LEVEL_CODE};

    }



}
