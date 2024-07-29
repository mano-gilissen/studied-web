@extends('template.form')



@section('scripts')

    <script>

        var study                       = '{{ $study->id }}';

    </script>

    <script src="{{ asset('js/form_100823.js') }}"></script>

@endsection



@section('fields')



    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('form.field-select-time', ['set_start' => $study->getReports[0]->start, 'set_end' => $study->getReports[0]->end, 'trigger' => 'report'])

    <div class="seperator"></div>



    @foreach($study->getAgreements as $agreement)



        @php
            $user             = $agreement->getStudent;
            $report           = $study->getReport($user);
            $id_user          = 'user_' . $user->id . '_';
        @endphp



        @if(\App\Http\Traits\StudyTrait::hasGroupReporting($study))

            <div class="seperator"></div>

            <div class="block-note">{{ __('Dit is het rapport voor ') }}<span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($user->getPerson) }}</span></div>

            <div class="seperator"></div>

        @endif



        <div class="title">{{ __('Wat is er behandeld?') }}</div>

        <div class="subjects" id="subjects_{{ $user->id }}" data-user="{{ $user->id }}" data-agreement="{{ $agreement->id }}" data-report="{{ $report->id }}"> @include('load.subjects') </div>

        <div class="seperator large"></div>



        <div class="title">{{ __('Hoe verloopt de begeleiding?') }}</div>

        @include('form.field-textarea', ['id' => $id_user . 'content_volgende_les', 'tag' => __('Volgende les'), 'required' => true, 'value' => $report->{\App\Http\Support\Model::$REPORT_CONTENT_VOLGENDE_LES}])

        @include('form.field-textarea', ['id' => $id_user . 'content_uitdagingen', 'tag' => __('Uitdagingen'), 'required' => true, 'value' => $report->{\App\Http\Support\Model::$REPORT_CONTENT_UITDAGINGEN}])

        @include('form.field-textarea', ['id' => $id_user . 'content_voortgang', 'tag' => __('Voortgang'), 'required' => true, 'value' => $report->{\App\Http\Support\Model::$REPORT_CONTENT_VOORTGANG}])

        <div class="seperator"></div>



    @endforeach



    @include('form.field-hidden', ['id' => '_study', 'value' => $study->id])



@endsection



@section('actions')

    <div class="button red" onclick="if(confirm(translated('Weet je zeker dat je dit rapport en de bijhorende les wilt verwijderen? Dit kan niet ongedaan worden gemaakt.'))) { window.location.href='{{ route('study.delete', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}'; }">

        {{ __('Les verwijderen') }}

    </div>

@endsection
