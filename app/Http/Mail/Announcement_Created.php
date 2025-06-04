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



class Announcement_Created extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $subject;



    public function __construct(User $user) {

        $this->user                         = $user;
        $this->subject                      = __('Nieuw bericht voor jou in het Studied dashboard');

    }



    public function build() {

        return $this
            ->view('mail.announcement_created')
            ->subject($this->subject);
    }



}
