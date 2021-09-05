<div class="title">{{ __('Klantgegevens') }}</div>

@include('form.field-input', ['id' => 'refer', 'tag' => 'Referentie', 'placeholder' => 'Hoe komt de klant bij Studied terecht?', 'required' => true, 'value' => $customer->{\App\Http\Support\Model::$CUSTOMER_REFER}])

<div class="seperator"></div>
