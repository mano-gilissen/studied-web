<div class="title">{{ __('Organisatie') }}</div>

@include('component.field-input', ['id' => 'category', 'tag' => __('Categorie') . '*', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => old('_category') ?? $customer->getUser->{\App\Http\Support\Model::$USER_CATEGORY}])

<div class="seperator"></div>
