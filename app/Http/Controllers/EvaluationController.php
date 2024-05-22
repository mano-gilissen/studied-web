<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\EvaluationTrait;
use App\Http\Traits\RoleTrait;
use App\Models\Agreement;
use App\Models\Evaluation;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Level;
use App\Models\Location;
use App\Models\Person;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class EvaluationController extends Controller {





    use BaseTrait;





    public function view($key) {

        $evaluation                                                         = Evaluation::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::EVALUATION, [

            Key::PAGE_TITLE                                                 => __('Gesprek'),
            Key::PAGE_BACK                                                  => true,

            Model::$EVALUATION                                              => $evaluation
        ]);
    }





    public function plan($leerling = null) {

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = __('Gesprek aanmaken');
        $data[Key::SUBMIT_ACTION]                                           = __('Aanmaken');
        $data[Key::SUBMIT_ROUTE]                                            = 'evaluation.plan_submit';



        $objects_host                                                       = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT))->with('getPerson')->get();
        $objects_employee                                                   = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_EMPLOYEE))->with('getPerson')->get();
        $objects_student                                                    = User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)->with('getPerson')->get();

        $objects_location                                                   = Location::all();



        if ($leerling) {

            $person                                                         = Person::where(Model::$PERSON_SLUG, $leerling)->first();
            $data[Model::$STUDENT]                                          = $person ? $person->getUser->{Model::$BASE_ID} : -1;
        }



        $ac_data_host                                                       = $objects_host->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_host                                                 = $objects_host->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_employee                                                   = $objects_employee->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_employee                                             = $objects_employee->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_student                                                    = $objects_student->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_student                                              = $objects_student->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_location                                                   = $objects_location->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();



        $data[Key::AUTOCOMPLETE_DATA . Model::$EVALUATION_HOST]             = Format::encode($ac_data_host);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$EVALUATION_HOST]       = Format::encode($ac_additional_host);

        $data[Key::AUTOCOMPLETE_DATA . Model::$EMPLOYEE]                    = Format::encode($ac_data_employee);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$EMPLOYEE]              = Format::encode($ac_additional_employee);

        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT]                     = Format::encode($ac_data_student);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$STUDENT]               = Format::encode($ac_additional_student);

        $data[Key::AUTOCOMPLETE_DATA . Model::$LOCATION]                    = Format::encode($ac_data_location);
        $data[Key::AUTOCOMPLETE_DATA . Model::$EVALUATION_REGARDING]        = Format::encode(EvaluationTrait::getRegardingData());



        return view(Views::FORM_EVALUATION_PLAN, $data);
    }



    public function plan_submit(Request $request) {

        $data                                                               = $request->all();

        // self::plan_validate($data);

        $evaluation                                                         = EvaluationTrait::create($data);

        if (!$evaluation) {

            abort(500);

        }

        return redirect()->route('evaluation.view', [Model::$BASE_KEY => $evaluation->{Model::$BASE_KEY}]);
    }



    public function plan_validate(array $data) {

        $rules                                                              = [];

        $rules[Model::$EVALUATION_DATETIME]                                 = ['required'];
        $rules[Model::$EVALUATION_REGARDING]                                = ['required'];
        $rules[Model::$EVALUATION_HOST]                                     = ['required'];
        $rules[Model::$STUDENT]                                             = ['required'];

        $validator                                                          = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





    public function perform($key) {

        $evaluation                                                         = Evaluation::where(Model::$BASE_KEY, $key)->firstOrFail();

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = EvaluationTrait::getRegardingText($evaluation->{Model::$EVALUATION_REGARDING});
        $data[Key::SUBMIT_ACTION]                                           = __('Voltooien');
        $data[Key::SUBMIT_ROUTE]                                            = 'evaluation.perform_submit';
        $data[Model::$EVALUATION]                                           = $evaluation;

        return view(Views::FORM_EVALUATION, $data);
    }



    public function perform_submit(Request $request) {

        $data                                                               = $request->all();

        self::perform_validate($data);

        $evaluation                                                         = Evaluation::findOrFail($data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION]);

        EvaluationTrait::updateFromEvaluation($data, $evaluation);

        AgreementTrait::createFromEvaluation($data);

        return redirect()->route('evaluation.view', [Model::$BASE_KEY => $evaluation->{Model::$BASE_KEY}]);
    }



    public function perform_validate(array $data) {

        $rules                                                              = [];

        // TODO: ADD RULES

        $validator                                                          = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }



    public function form_perform_agreement_load(Request $request) {

        $evaluation_id                                                      = $request->input(Model::$EVALUATION, null);
        $id                                                                 = $request->input(Model::$BASE_ID, null);

        $evaluation                                                         = Evaluation::find($evaluation_id);

        $data                                                               = [];
        $data[Model::$BASE_ID]                                              = $id;



        AgreementController::create_set_ac_data($data, $evaluation->{Model::$STUDENT});



        return view(Views::LOAD_AGREEMENT, $data);
    }





}
