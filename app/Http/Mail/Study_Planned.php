<?php



namespace App\Http\Mail;

use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Study_Planned extends Mailable {



    use Queueable, SerializesModels;



    public
        $study,
        $participant;



    public function __construct(Study $study, User $participant) {

        $this->study                                = $study;
        $this->participant                          = $participant;
    }



    public function build() {

        return $this->view('email.study-planned');

    }



}
