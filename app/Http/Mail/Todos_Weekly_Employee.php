<?php

namespace App\Http\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Todos_Weekly_Employee extends Mailable {



    use Queueable, SerializesModels;



    public
        $todos,
        $user,
        $subject;



    public function __construct($todos, User $user) {

        $this->todos                        = $todos;
        $this->user                         = $user;
        $this->subject                      = __('Wekelijkse overzicht van TODO\'s in de Studied app');
    }



    public function build() {

        return $this
            ->view('mail.todos_weekly_employee')
            ->subject($this->subject);
    }



}
