<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\EvaluationTrait;
use App\Http\Traits\RoleTrait;
use App\Models\Evaluation;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Location;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class EvaluationController extends Controller {





    use BaseTrait;





    public function plan($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        $objects_host                                                       = User::where(Model::$ROLE, RoleTrait::$ID_EMPLOYEE)->with('getPerson')->get();
        $objects_employee                                                   = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_EMPLOYEE))->with('getPerson')->get();
        $objects_student                                                    = User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)->with('getPerson')->get();

        $objects_location                                                   = Location::all();

        $ac_data_host                                                       = $objects_host->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_host                                                 = $objects_host->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_employee                                                   = $objects_employee->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_employee                                             = $objects_employee->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_student                                                    = $objects_student->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_student                                              = $objects_student->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_location                                                   = $objects_location->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();

        return view(Views::FORM_EVALUATION_PLAN, [

            Key::PAGE_TITLE                                                 => 'Gesprek aanmaken',
            Key::SUBMIT_ACTION                                              => 'Aanmaken',
            Key::SUBMIT_ROUTE                                               => 'evaluation.plan_submit'
        ]);
    }



    public function plan_submit(Request $request) {

        $data                                                               = $request->all();

        self::plan_validate($data);

        $evaluation                                                         = EvaluationTrait::create($data);

        if (!$evaluation) {

            abort(500);

        }

        return redirect()->route('evaluation.view', [Model::$BASE_KEY => $evaluation->{Model::$BASE_KEY}]);
    }



    public function plan_validate(array $data) {

        $rules                                                              = [];

        // TODO: ADD RULES

        $validator                                                          = Validator::make($data, $rules, self::getValidationMessages());

        $validator->validate();
    }





}
