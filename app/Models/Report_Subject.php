<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Report_Subject extends Model {



    use SoftDeletes;



    protected

        $table                                  = 'report_subject';



}
