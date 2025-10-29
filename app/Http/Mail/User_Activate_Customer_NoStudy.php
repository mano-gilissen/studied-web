<?php

namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;



class User_Activate_Customer_NoStudy extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $subject;



    public function __construct(User $user) {

        $this->user                         = $user;

        $this->subject                      = Lang::get('Activeer uw account voor onze webapp', [], $user->{Model::$USER_LANGUAGE});
    }



    public function build() {

        return $this->view('mail.user_activate_customer_nostudy')->subject($this->subject);

    }



}
