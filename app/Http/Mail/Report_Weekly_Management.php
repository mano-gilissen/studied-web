<?php

namespace App\Http\Mail;

use App\Http\Support\Format;
use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Agreement;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Report_Weekly_Management extends Mailable {



    use Queueable, SerializesModels;



    public
        $list_deficit,
        $list_unreported,

        $subject;



    public function __construct($list_deficit, $list_unreported) {

        $this->list_deficit                 = $list_deficit;
        $this->list_unreported              = $list_unreported;

        $this->subject                      = __('Wekelijkse controle rapporten en uren ') . date('d-m-Y');
    }



    public function build() {

        return $this
            ->view('email.report_weekly_management')
            ->subject($this->subject);
    }



}
