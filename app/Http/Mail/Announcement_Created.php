<?php

namespace App\Http\Mail;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Agreement;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;



class Announcement_Created extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $subject;



    public function __construct(User $user) {

        $this->user                         = $user;
        $this->subject                      = Lang::get('Nieuw bericht voor jou in het Studied dashboard', [], $user->{Model::$USER_LANGUAGE});

    }



    public function build() {

        return $this
            ->view('mail.announcement_created')
            ->subject($this->subject);
    }



}
