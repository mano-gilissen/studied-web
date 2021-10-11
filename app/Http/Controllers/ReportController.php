<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Route;
use App\Http\Support\Table;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\ServiceTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\SubjectTrait;
use App\Models\Agreement;
use App\Models\Location;
use App\Models\Person;
use App\Models\Report;
use App\Models\Service;
use App\Models\Subject;
use App\Models\Study;
use App\Models\User;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;



class ReportController extends Controller {





    use BaseTrait;





    public function create($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::FORM_REPORT, [

            Key::PAGE_TITLE                                                 => 'Les rapporteren',
            Key::SUBMIT_ACTION                                              => 'Rapporteren',
            Key::SUBMIT_ROUTE                                               => Route::REPORT_CREATE_SUBMIT,

            Model::$STUDY                                                   => $study
        ]);
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();

        $study                                                              = Study::find($data['_' . Model::$STUDY]);

        if (ReportTrait::create($data, $study) && StudyTrait::isReported($study)) {

            $study->{Model::$STUDY_STATUS}                                  = StudyTrait::$STATUS_REPORTED;

            $study->save();
        }

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }



    public function edit($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::FORM_REPORT_EDIT, [

            Key::PAGE_TITLE                                                 => 'Rapport bewerken',
            Key::SUBMIT_ACTION                                              => 'Opslaan',
            Key::SUBMIT_ROUTE                                               => Route::REPORT_EDIT_SUBMIT,

            Model::$STUDY                                                   => $study
        ]);
    }



    public function edit_submit(Request $request) {

        $data                                                               = $request->all();

        //dd($data);

        ReportTrait::update($data);

        $study                                                              = Study::find($data['_' . Model::$STUDY]);

        return redirect()->route('study.view', $study->{Model::$BASE_KEY});
    }



    public function create_validate(array $data) {

        $messages                                                           = [
            'required'                                                      => 'Dit veld is verplicht.',
            'max'                                                           => 'Gebruik maximaal 1000 karakters.'
        ];



        $rules                                                              = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, [Model::$REPORT_CONTENT_VOORTGANG, Model::$REPORT_CONTENT_UITDAGINGEN, Model::$REPORT_CONTENT_VOLGENDE_LES])) {

                $rules[$key]                                                = ['required', 'max:999'];

            }

            if (Func::contains($key, Model::$REPORT_SUBJECT_VERSLAG)) {

                // TODO: FINISH
                // Only add to rules if field belongs to primary subject or report for this user has secondary subject

            }
        }



        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
    }





}
