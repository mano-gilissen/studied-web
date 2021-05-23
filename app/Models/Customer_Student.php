<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Customer_Student extends Model {



    use SoftDeletes;



    protected

        $table                                  = 'customer_student';



}
