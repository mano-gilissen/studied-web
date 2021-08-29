<?php



namespace App\Http\Controllers;

use App\Http\Support\Format;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\RoleTrait;
use App\Models\Agreement;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Evaluation;
use App\Models\Level;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class AgreementController extends Controller {





    use BaseTrait;





    public function view($identifier) {

        $agreement                                                         = Agreement::where(Model::$AGREEMENT_IDENTIFIER, $identifier)->firstOrFail();

        return view(Views::AGREEMENT, [

            Key::PAGE_TITLE                                                 => 'Vakafspraak',
            Key::PAGE_BACK                                                  => true,

            Model::$AGREEMENT                                               => $agreement
        ]);
    }



    public function create($leerling) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $leerling)->firstOrFail();
        $student_id                                                         = $person->getUser->{Model::$BASE_ID};

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = 'Nieuwe vakafspraak';
        $data[Key::SUBMIT_ACTION]                                           = 'Aanmaken';
        $data[Key::SUBMIT_ROUTE]                                            = 'agreement.create_submit';
        $data[Key::SINGLE]                                                  = true;



        self::create_set_ac_data($data, $student_id);



        return view(Views::FORM_AGREEMENT_CREATE, $data);
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();

        self::create_validate($data);

        $agreement                                                          = AgreementTrait::create($data, 1);

        if (!$agreement) {

            abort(500);

        }

        return redirect()->route('agreement.view', [Model::$AGREEMENT_IDENTIFIER => $agreement->{Model::$AGREEMENT_IDENTIFIER}]);

    }



    public function create_validate($data) {

        $rules                                                              = [];

        // TODO: ADD RULES

        $validator                                                          = Validator::make($data, $rules, self::getValidationMessages());

        $validator->validate();
    }



    public static function create_set_ac_data(&$data, $student_id) {

        $objects_employee                                                   = User::whereIn(Model::$ROLE, array(RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_EMPLOYEE))->with('getPerson')->get();
        $objects_student                                                    = User::where(Model::$ROLE, RoleTrait::$ID_STUDENT)->with('getPerson')->get();
        $objects_subject                                                    = Subject::all();
        $objects_level                                                      = Level::all();
        $objects_agreement                                                  = Agreement::where(Model::$STUDENT, $student_id)->with('getSubject')->get();



        $ac_data_employee                                                   = $objects_employee->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_employee                                             = $objects_employee->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_student                                                    = $objects_student->pluck('getPerson.' . 'fullName', Model::$BASE_ID)->toArray();
        $ac_additional_student                                              = $objects_student->pluck(Model::$USER_EMAIL, Model::$BASE_ID)->toArray();

        $ac_data_subject                                                    = $objects_subject->pluck(Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();
        $ac_data_level                                                      = $objects_level->pluck('withYear', Model::$BASE_ID)->toArray();

        $ac_data_agreements                                                 = $objects_agreement->pluck(Model::$AGREEMENT_IDENTIFIER, Model::$BASE_ID)->toArray();
        $ac_additional_agreements                                           = $objects_agreement->pluck('getSubject.' . Model::$SUBJECT_NAME, Model::$BASE_ID)->toArray();



        $data[Model::$STUDENT]                                              = $student_id;

        $data[Key::AUTOCOMPLETE_DATA . Model::$EMPLOYEE]                    = Format::encode($ac_data_employee);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$EMPLOYEE]              = Format::encode($ac_additional_employee);

        $data[Key::AUTOCOMPLETE_DATA . Model::$STUDENT]                     = Format::encode($ac_data_student);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . Model::$STUDENT]               = Format::encode($ac_additional_student);

        $data[Key::AUTOCOMPLETE_DATA . Model::$SUBJECT]                     = Format::encode($ac_data_subject);
        $data[Key::AUTOCOMPLETE_DATA . Model::$LEVEL]                       = Format::encode($ac_data_level);

        $data[Key::AUTOCOMPLETE_DATA . 'replace']                           = Format::encode($ac_data_agreements);
        $data[Key::AUTOCOMPLETE_ADDITIONAL . 'replace']                     = Format::encode($ac_additional_agreements);
    }





}
