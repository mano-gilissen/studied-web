<?php

namespace App\Rules;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Models\Agreement;
use Illuminate\Contracts\Validation\Rule;

class DateBeforeEndAgreement implements Rule {





    private $date = null;





    public function __construct($date) {

        $this->date = $date;

    }



    public function passes($attribute, $value) {

        if (!$this->date) {

            return false;

        }

        $agreement = Agreement::find($value);

        if (!$agreement) {

            return false;

        }

        return !Func::has_passed($agreement->{Model::$AGREEMENT_END}, $this->date);
    }



    public function message() {

        return 'De vakafspraak moet op de datum van de les actief zijn.';

    }



}
