<?php



namespace App\Http\Traits;



use App\Http\Support\Format;
use App\Http\Support\Model;

trait AgreementTrait {



    public static function getDescription($agreement, $for_host = false) {

        return $agreement->getSubject->{Model::$SUBJECT_DESCRIPTION_SUBJECT} . ' met <span style="font-weight: 600">'
            . ($for_host ? $agreement->getStudent->getPerson->{Model::$PERSON_FIRST_NAME} : $agreement->getEmployee->getPerson->{Model::$PERSON_FIRST_NAME})
            . '</span>,<br> actief tot ' . Format::datetime($agreement->{Model::$AGREEMENT_END}, Format::$DATETIME_AGREEMENT) . '.';
    }



}
