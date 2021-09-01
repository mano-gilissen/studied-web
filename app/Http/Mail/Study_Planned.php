<?php



namespace App\Http\Mail;

use App\Http\Traits\PersonTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Study_Planned extends Mailable {



    use Queueable, SerializesModels;



    public
        $study,
        $participant,
        $subject;



    public function __construct(Study $study, User $participant) {

        $this->study                                = $study;
        $this->participant                          = $participant;
        $this->subject                              = 'Er is een les voor jou ingepland door ' . PersonTrait::getFullName($study->getHost->getPerson);
    }



    public function build() {

        return $this->view('email.template')->subject($this->subject);

    }



}
