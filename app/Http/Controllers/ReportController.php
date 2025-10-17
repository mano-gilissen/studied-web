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

            Key::PAGE_TITLE                                                 => __('Les rapporteren'),
            Key::SUBMIT_ACTION                                              => __('Rapporteren'),
            Key::SUBMIT_ROUTE                                               => Route::REPORT_CREATE_SUBMIT,

            Model::$STUDY                                                   => $study
        ]);
    }



    public function create_submit(Request $request) {

        $data                                                               = $request->all();
        $study                                                              = Study::find($data['_' . Model::$STUDY]);

        if (!StudyTrait::canReport($study)) {

            abort(403);

        }

        if (ReportTrait::create($data, $study) && StudyTrait::isReported($study)) {

            $study->{Model::$STUDY_STATUS}                                  = StudyTrait::$STATUS_REPORTED;

            $study->save();
        }

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Rapport verstuurd'),
            Key::PAGE_MESSAGE                                               => __('De deelnemers en ouders hiervan kunnen dit nu bekijken.'),
            Key::PAGE_NEXT                                                  => route(Route::STUDY_VIEW, $study->{Model::$BASE_KEY}),
            Key::PAGE_ACTION                                                => __('Naar de les'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }



    public function edit($key) {

        $study                                                              = Study::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::FORM_REPORT_EDIT, [

            Key::PAGE_TITLE                                                 => __('Rapport bewerken'),
            Key::SUBMIT_ACTION                                              => __('Opslaan'),
            Key::SUBMIT_ROUTE                                               => Route::REPORT_EDIT_SUBMIT,

            Model::$STUDY                                                   => $study
        ]);
    }



    public function edit_submit(Request $request) {

        $data                                                               = $request->all();

        $study                                                              = Study::find($data['_' . Model::$STUDY]);

        ReportTrait::update($data, $study);

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                                 => __('Rapport gewijzigd'),
            Key::PAGE_NEXT                                                  => route(Route::STUDY_VIEW, $study->{Model::$BASE_KEY}),
            Key::PAGE_ACTION                                                => __('Naar de les'),
            Key::ICON                                                       => 'check-circle-green.svg'
        ]);
    }



    public function create_validate(array $data) {

        $messages                                                           = [
            'required'                                                      => __('Dit veld is verplicht.'),
            'max'                                                           => __('Gebruik maximaal 1000 karakters.')
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



    public function data_export_csv($time) {

        $rows = [];
        $columns = ['Datum', 'Link naar les', 'Medewerker', 'Verslag', 'Wat ging goed', 'Wat gaan jullie volgende les doen', 'Wat kan worden verbeterd'];
        $reports = Report::where(Model::$BASE_CREATED_AT, '<', date(Format::$DATABASE_DATE, $time))
            ->where(Model::$BASE_CREATED_AT, '>=', date(Format::$DATABASE_DATE, $time - (7 * 86400)))
            ->get();

        foreach ($reports as $report) {

            $rows[] = [
                Format::datetime($report->{Model::$BASE_CREATED_AT}, Format::$DATETIME_EXPORT . ' %H:%M'),
                'https://studied.app/les/' . $report->getStudy->{Model::$BASE_KEY},
                PersonTrait::getFullName($report->getStudy->getHost_User->getPerson),
                ReportTrait::getVerslagText($report),
                $report->{Model::$REPORT_CONTENT_VOORTGANG},
                $report->{Model::$REPORT_CONTENT_VOLGENDE_LES},
                $report->{Model::$REPORT_CONTENT_UITDAGINGEN}
            ];
        }

        $filename = 'reports_' . date(Format::$DATABASE_DATE) . '-' . date(Format::$DATABASE_DATE, strtotime('-7 days')) . '.csv';

        return Func::export_csv($columns, $rows, $filename);
    }





}
