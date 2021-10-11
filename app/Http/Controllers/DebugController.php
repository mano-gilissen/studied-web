<?php



namespace App\Http\Controllers;

use App\Http\Mail\Study_Planned_Student;
use App\Models\Study;
use App\Models\Subject;
use App\Models\Person;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Support\Model;
use Auth;



class DebugController extends Controller {





    public function landing() {

        return view(Views::LANDING);

    }



    public function lab() {

        return view(
            Views::LAB, [

                Key::PAGE_TITLE                                             => 'The Lab',

                Model::$USER                                                => Auth::user()
            ]);
    }



    public function template() {

        return view(
            'template', [

        ]);
    }



    public function form_test() {

        // TODO: Create helper method to implode autocomplete data from database

        return view(Views::FORM_TEST, [

            Key::PAGE_TITLE                                                 => 'Formulier',
            Key::SUBMIT_ACTION                                              => 'Opslaan',

            Key::AUTOCOMPLETE_DATA.'field_autocomplete'                     => Format::ac(Person::all()->pluck(Model::$PERSON_FIRST_NAME)->toArray()),
            Key::AUTOCOMPLETE_DATA.'field_autocomplete_reject'              => Format::ac(Subject::all()->pluck(Model::$SUBJECT_SHORT)->toArray()),
            Key::AUTOCOMPLETE_DATA.'field_autocomplete_reject_show_all'     => Format::ac(Subject::all()->pluck(Model::$SUBJECT_SHORT)->toArray())
        ]);
    }



    public function mail_test($key) {

        $study                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();
        $participant                        = $study->getParticipants_User[0];

        $mail                               = new Study_Planned_Student($study, $participant);

        Mail::to('b.jennissen@studied.nl'/*$participant->{Model::$USER_EMAIL}*/)->send($mail);
    }





    public static function csv_export($columnNames, $rows, $fileName = 'file.csv') {

        $headers = [
            "Content-type"                  => "text/csv",
            "Content-Disposition"           => "attachment; filename=" . $fileName,
            "Pragma"                        => "no-cache",
            "Cache-Control"                 => "must-revalidate, post-check=0, pre-check=0",
            "Expires"                       => "0"
        ];

        $callback = function() use ($columnNames, $rows ) {

            $file                           = fopen('php://output', 'w');

            fputcsv($file, $columnNames);

            foreach ($rows as $row) {

                fputcsv($file, $row);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



    public function csv_export_test($header) {

        $rows                   = [['a','b','c'],[1,2,3]];
        $columnNames            = [$header, 'yada', 'hmm'];

        return self::csv_export($columnNames, $rows);
    }





}
