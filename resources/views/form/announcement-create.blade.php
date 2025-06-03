@extends('form.template')



@section('fields')



    <div class="title">{{ __('Inhoud') }}</div>

    @include('component.field-input', ['id' => 'title', 'tag' => __('Titel *'), 'required' => true, 'value' => old('title')])

    @include('component.field-textarea', ['id' => 'body', 'tag' => __('Inhoud *'), 'required' => true, 'value' => old('body')])

    @include('component.field-input', ['id' => 'author', 'tag' => __('Auteur'), 'value' => old('body')])

    <div class="seperator"></div>



    <div class="title">{{ __('Zichtbaarheid') }}</div>

    @include('component.field-input', ['id' => 'role', 'tag' => __('Voor wie is deze aankondiging? *'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'uses_id' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'set_id' => \App\Http\Traits\RoleTrait::$ID_MANAGEMENT])

    <div class="seperator"></div>



@endsection
