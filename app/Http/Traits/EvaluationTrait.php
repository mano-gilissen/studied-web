<?php



namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\Evaluation_employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



trait EvaluationTrait {





    public static

        $ID_INTAKE                              = 1,
        $ID_EVALUATION                          = 2,
        $ID_YEAR_END                            = 3,
        $ID_EXIT                                = 4,

        $STATUS_PLANNED                         = 1,
        $STATUS_FINISHED                        = 2,

        $QUESTIONS_INTAKE                       = [
            'Wat wil je bereiken?',
            'Hoe weet je dat het doel is bereikt?',
            'Is het doel acceptabel?',
            'Is het doel realistisch?',
            'Wanneer wil je het doel bereiken?',
            'Hoe ziet de situatie er nu uit?',
            'Waarom is de situatie problematisch?',
            'Wat zijn je zwakke punten?',
            'Wat is reeds ondernomen om de problemen te verhelpen? Waarom werkte dat wel of niet?',
            'Wat gaat er momenteel (wel) goed?',
            'Wat zijn je sterke punten?',
            'Hoe ziet de situatie eruit als de problemen niet worden opgelost?',
            'Waar zie je mogelijkheden voor groei of verbetering?',
            'Waar zie je eventuele obstakels of uitdagingen?',
            'Wat heeft jouw voorkeur met betrekking tot leermethodes (visueel, adaptief, praktische oefeningen)?',
            'Bij welke vakken kunnen we je ondersteunen? En hoe staat het met je andere vakken?',
            'Wat heeft jouw voorkeur voor ondersteuning bij de vakken: structurele bijlessen of losse lessen?',
            'Studeer / werk je liever in een groep of individueel?',
            'Wil je de lessen in persoon of digitaal volgen? Het mag ook allebei, als we de voorkeur maar weten.',
            'Welke acties ga je buiten Studied ondernemen om het doel te bereiken?',
            'Wat zijn mogelijke obstakels voor het behalen van het gewenste resultaat?',
            'Hoe kan jij (en uiteraard wij) rekening houden met deze obstakels of uitdagingen?',
            'Zijn er aanpassingen of aanvullingen die je zou willen voorstellen voor ons plan van aanpak?',
            'Welke afspraken worden er gemaakt over de vakken?',
            'Welke afspraken worden er gemaakt over het minimum aantal uren?',
            'Welke afspraken worden er gemaakt over de begeleiding: structurele bijlessen of losse lessen?',
            'Studeer / werk je liever in een groep of individueel? Het mag ook allebei (als we de voorkeur maar weten).',
            'Wil je de lessen in persoon of digitaal volgen? Het mag ook allebei (als we de voorkeur maar weten).',
            'Indien de voorkeur uitgaat naar lessen in persoon, wáár (locatie) laten we de lessen plaatsvinden?',
            'Hoe communiceert de leerling / student met de student-docent (WhatsApp of e-mail)?',
            'Hoe houden de ouder(s) / verzorger(s) en teamleiders contact (WhatsApp of e-mail)?',
            'Wanneer vind het evaluatiegesprek plaats? In dit gesprek wordt de uitvoering van de afspraken geëvalueerd.',
            'Zijn er nog andere afspraken gemaakt?',
            'Wat is er afgesproken over de proefles(sen)?',
            'Welke afspraken worden er gemaakt over het aanleveren van studiematerialen / de stof aan de student-docent (het liefst 48 uur van tevoren)?',
            'Student-docent en de leerling / student wisselen telefoonnummers uit.',
            'Overige vragen of opmerkingen?',
        ],

        $QUESTIONS_EVALUATION = [
            'Wat wil je bereiken?',
            'Hoe weet je dat het doel is bereikt?',
            'Is het doel acceptabel?',
            'Is het doel realistisch?',
            'Wanneer wil je het doel bereiken?',
            'Hoe ziet de situatie er nu uit?',
            'Waarom is de situatie problematisch?',
            'Wat zijn je zwakke punten?',
            'Wat is reeds ondernomen om de problemen te verhelpen? Waarom werkte dat wel of niet?',
            'Wat gaat er momenteel (wel) goed?',
            'Wat zijn je sterke punten?',
            'Hoe ziet de situatie eruit als de problemen niet worden opgelost?',
            'Waar zie je mogelijkheden voor groei of verbetering?',
            'Waar zie je eventuele obstakels of uitdagingen?',
            'Wat heeft jouw voorkeur met betrekking tot leermethodes (visueel, adaptief, praktische oefeningen)?',
            'Bij welke vakken kunnen we je ondersteunen? En hoe staat het met je andere vakken?',
            'Wat heeft jouw voorkeur voor ondersteuning bij de vakken: structurele bijlessen of losse lessen?',
            'Studeer / werk je liever in een groep of individueel?',
            'Wil je de lessen in persoon of digitaal volgen? Het mag ook allebei, als we de voorkeur maar weten.',
            'Welke acties ga je buiten Studied ondernemen om het doel te bereiken?',
            'Wat zijn mogelijke obstakels voor het behalen van het gewenste resultaat?',
            'Hoe kan jij (en uiteraard wij) rekening houden met deze obstakels of uitdagingen?',
            'Zijn er aanpassingen of aanvullingen die je zou willen voorstellen voor ons plan van aanpak?',
            'Welke afspraken worden er gemaakt over de vakken?',
            'Welke afspraken worden er gemaakt over het minimum aantal uren?',
            'Welke afspraken worden er gemaakt over de begeleiding: structurele bijlessen of losse lessen?',
            'Studeer / werk je liever in een groep of individueel? Het mag ook allebei (als we de voorkeur maar weten).',
            'Wil je de lessen in persoon of digitaal volgen? Het mag ook allebei (als we de voorkeur maar weten).',
            'Indien de voorkeur uitgaat naar lessen in persoon, wáár (locatie) laten we de lessen plaatsvinden?',
            'Hoe communiceert de leerling / student met de student-docent (WhatsApp of e-mail)?',
            'Hoe houden de ouder(s) / verzorger(s) en teamleiders contact (WhatsApp of e-mail)?',
            'Wanneer vindt het evaluatiegesprek plaats? In dit gesprek wordt de uitvoering van de afspraken geëvalueerd.',
            'Zijn er nog andere afspraken gemaakt?',
            'Wat is er afgesproken over de proefles(sen)?',
            'Welke afspraken worden er gemaakt over het aanleveren van studiematerialen / de stof aan de student-docent (het liefst 48 uur van tevoren)?',
            'Student-docent en de leerling / student wisselen telefoonnummers uit.',
            'Hoe tevreden ben je met de ondersteuning en de voortgang tot nu toe?',
            'Heb je het doel (of doelen), dat we samen hebben opgesteld, bereikt? Zo ja, hoe weet je dat? Zo nee, wat denk je dat de obstakels of uitdagingen waren?',
            'Hoe goed sluit de huidige aanpak aan bij jouw manier van leren?',
            'Welke ondersteuning en hulpmiddelen waren voor jou het meest waardevol?',
            'Zijn er dingen die je minder of niet effectief vond?',
            'Hoe ervaart de student-docent de begeleiding voor het bereiken van het doel?',
            'Wat zou je willen veranderen?',
            'Hoe tevreden zijn de ouder(s) / verzorger(s) met de ondersteuning en de voortgang tot nu toe?',
            'Hoe ervaart de klant ervaren de ouder(s) / verzorger(s) de begeleiding voor het bereiken van het doel?',
            'Willen we de begeleiding verlengen, eventueel wijzigen of willen we de begeleiding stopzetten? Indien verlengen of eventueel wijzigen, wanneer vindt het evaluatiegesprek plaats? In dit gesprek wordt de uitvoering van de afspraken geëvalueerd.',
            'Overige vragen of opmerkingen?',
        ];





    public static function create($data) {

        self::validate($data);

        $evaluation                                                 = new Evaluation();

        $evaluation->{Model::$BASE_KEY}                             = Func::generate_key(Model::$EVALUATION);

        $evaluation->{Model::$EVALUATION_DATETIME}                  = $data['date'] . ' ' . $data['start'] . ':00';
        $evaluation->{Model::$EVALUATION_REGARDING}                 = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_REGARDING];
        $evaluation->{Model::$EVALUATION_HOST}                      = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_HOST];
        $evaluation->{Model::$STUDENT}                              = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT];

        $address                                                    = Address::find($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION]);
        $location                                                   = $address ? $address->getLocation : null;
        $link                                                       = $data[Model::$EVALUATION_LINK];

        $evaluation->{Model::$ADDRESS}                              = $address ? $address->{Model::$BASE_ID} : -1;
        $evaluation->{Model::$EVALUATION_LOCATION_TEXT}             = $link ? __("Digitaal") : ($location ? $location->{Model::$LOCATION_NAME} : $data[Model::$LOCATION]);
        $evaluation->{Model::$EVALUATION_LINK}                      = $link;

        $evaluation->save();



        $employee_ids                                               = [];

        $employee_ids[]                                             = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_1'];
        $employee_ids[]                                             = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_2'];
        $employee_ids[]                                             = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_3'];

        foreach ($employee_ids as $employee_id) {

            if ($employee_id > 0) {

                Evaluation_EmployeeTrait::create($evaluation->{Model::$BASE_ID}, $employee_id);

                Mail::evaluationCreated_forEmployee(User::find($employee_id), $evaluation);
            }
        }



        $user_host                                                  = User::find($evaluation->{Model::$EVALUATION_HOST});
        $user_student                                               = User::find($evaluation->{Model::$STUDENT});

        Mail::evaluationCreated_forHost($user_host, $evaluation);

        if (UserTrait::isActivated($user_student)) {

            Mail::evaluationCreated_forStudent($user_student, $evaluation);

        }

        if (StudentTrait::hasCustomer($user_student->getStudent)) {

            $user_customer = $user_student->getStudent->getCustomer->getUser;

            if (UserTrait::isActivated($user_customer)) {

                Mail::evaluationCreated_forCustomer($user_customer, $evaluation);

            }
        }



        return $evaluation;
    }




    public static function update_fromEvaluation($data, $evaluation) {

        self::validate_fromEvaluation($data);

        $answers                                                          = [];

        foreach ($data as $key => $value) {

            if (!Func::contains($key, [Model::$EVALUATION_ANSWERS])) {

                continue;

            }

            if (strlen($value) == 0) {

                continue;

            }

            $question                                                       = str_replace(Model::$EVALUATION_ANSWERS . '_', '', $key);
            $answers[$question]                                             = $value;
        }

        $evaluation[Model::$EVALUATION_ANSWERS]                             = json_encode($answers);
        $evaluation[Model::$EVALUATION_PERFORMED]                           = true;

        $evaluation->save();
    }



    public static function edit($data) {

        self::validate($data);

        $evaluation                                                 = Evaluation::where(Model::$BASE_KEY, $data[Model::$EVALUATION])->first();

        $evaluation->{Model::$EVALUATION_DATETIME}                  = $data['date'] . ' ' . $data['start'] . ':00';
        $evaluation->{Model::$EVALUATION_HOST}                      = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_HOST];
        $evaluation->{Model::$EVALUATION_REGARDING}                 = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_REGARDING];
        $evaluation->{Model::$EVALUATION_REMARKS}                   = $data[Model::$EVALUATION_REMARKS];

        $address                                                    = Address::find($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION]);
        $location                                                   = $address ? $address->getLocation : null;
        $link                                                       = $data[Model::$EVALUATION_LINK];

        $evaluation->{Model::$ADDRESS}                              = $address ? $address->{Model::$BASE_ID} : -1;
        $evaluation->{Model::$EVALUATION_LOCATION_TEXT}             = $link ? __("Digitaal") : ($location ? $location->{Model::$LOCATION_NAME} : $data[Model::$LOCATION]);
        $evaluation->{Model::$EVALUATION_LINK}                      = $link;

        $evaluation->save();

        \DB::delete('DELETE FROM evaluation_employee where evaluation = ' . $evaluation->{Model::$BASE_ID});

        $employee_ids                                               = [];

        $employee_ids[]                                             = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_1'];
        $employee_ids[]                                             = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_2'];
        $employee_ids[]                                             = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_3'];

        foreach ($employee_ids as $employee_id) {

            if ($employee_id > 0) {

                Evaluation_EmployeeTrait::create($evaluation->{Model::$BASE_ID}, $employee_id);

            }
        }

        return $evaluation;
    }



    public static function validate(array $data) {

        $rules                                                              = [];

        $rules['date']                                                      = ['required', 'date'];
        $rules['location']                                                  = ['required_without:link', 'nullable'];

        $rules[Model::$EVALUATION_HOST]                                     = ['required'];
        $rules[Model::$EVALUATION_REGARDING]                                = ['required'];

        $validator                                                          = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





    public static function validate_fromEvaluation(array $data) {

        $messages                                                           = [
            'max'                                                           => __('Gebruik maximaal :max karakters.')
        ];

        $rules                                                              = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, [Model::$EVALUATION_ANSWERS])) {

                $rules[$key]                                                = ['max:999'];

            }
        }

        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
    }





    public static function hasLink($evaluation) {

        return strlen($evaluation->link) > 0;

    }



    public static function getRegardingText($regarding) {

        switch ($regarding) {

            case self::$ID_INTAKE:

                return __("Intakegesprek");

            case self::$ID_EVALUATION:

                return __("Evaluatiegesprek");

            case self::$ID_YEAR_END:

                return __("Eindejaarsgesprek");

            case self::$ID_EXIT:

                return __("Exitgesprek");

            default:

                return __("Gesprek");
        }
    }



    public static function getRegardingData() {

        return [
            self::$ID_INTAKE                        => self::getRegardingText(self::$ID_INTAKE),
            self::$ID_EVALUATION                    => self::getRegardingText(self::$ID_EVALUATION),
            self::$ID_YEAR_END                      => self::getRegardingText(self::$ID_YEAR_END),
            self::$ID_EXIT                          => self::getRegardingText(self::$ID_EXIT)
        ];
    }



    public static function getStatus($evaluation) {

        return Func::has_passed($evaluation->{Model::$EVALUATION_DATETIME}) ? 2 : 1;

    }



    public static function getStatusText($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return __("Ingepland");
            case self::$STATUS_FINISHED:            return __("Afgelopen");
            default:                                return __('Onbekend');
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return Color::WHITE;
            case self::$STATUS_FINISHED:
            default:                                return Color::BLACK;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return Color::GREEN;
            case self::$STATUS_FINISHED:
            default:                                return Color::GREY_90;
        }
    }





}
