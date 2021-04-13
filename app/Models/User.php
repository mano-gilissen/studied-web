<?php



namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable {



    use Notifiable;



    protected $fillable = [
        'name', 'email', 'passwords',
    ];

    protected $hidden = [
        'passwords', 'remember_token',
    ];



}
