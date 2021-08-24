<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\EvaluationTrait;
use App\Models\Evaluation;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class EvaluationController extends Controller {





    use BaseTrait;





    public function create() {

        return view(Views::FORM_STUDENT_CREATE, [

            Key::PAGE_TITLE                                                 => 'Gesprek aanmaken',
            Key::SUBMIT_ACTION                                              => 'Aanmaken',
            Key::SUBMIT_ROUTE                                               => 'evaluation.create_submit'
        ]);
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();

        self::create_validate($data);

        $evaluation                                                         = EvaluationTrait::create($data);

        if (!$evaluation) {

            abort(500);

        }

        return redirect()->route('evaluation.view', [Model::$BASE_KEY => $evaluation->{Model::$BASE_KEY}]);
    }



    public function create_validate(array $data) {

        $rules                                                              = [];

        // TODO: ADD RULES

        $validator                                                          = Validator::make($data, $rules, self::getValidationMessages());

        $validator->validate();
    }





}
