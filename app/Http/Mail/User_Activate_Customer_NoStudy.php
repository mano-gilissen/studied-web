<?php



namespace App\Http\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class User_Activate_Customer_NoStudy extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $subject;



    public function __construct(User $user) {

        $this->user                         = $user;

        $this->subject                      = __('Activeer uw account voor onze webapp');
    }



    public function build() {

        return $this->view('email.user_activate_customer_nostudy')->subject($this->subject);

    }



}
