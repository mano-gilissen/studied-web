@extends('app')



@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">

    <link href="{{ asset('css/activate.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

    <script src="{{ asset('js/crop.js') }}"></script>

    <script>

        var user = '{{ Auth::user()->{\App\Http\Support\Model::$BASE_ID} }}';

    </script>

@endsection



@section('content')

    <div id="left">

        <div class="wrap">

            @include('block.header-navigation')

        </div>

    </div>

    <div id="form">

        <div class="block-form">



            @if($errors->any())

                <div class="block-note error">{{ $errors->first() }}</div>

                <div class="seperator"></div>

            @endif



            <div id="avatar-section-upload">

                <div id="avatar-wrap">

                    <div>

                        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials(Auth::user()->getPerson) }}</div>

                    </div>

                    <img id="avatar-img" src="{{ asset("/storage/avatar/" . Auth::user()->getPerson->avatar) }}" @if(!(Auth::user()->getPerson->avatar)) style="opacity:0" @endif/>

                </div>

                <form method="POST" id="avatar-form" action="{{ route('person.avatar_submit') }}" novalidate enctype="multipart/form-data">

                    @csrf

                    <input id="avatar-upload" type="file" name="image" accept="image/*"/>

                    <label id="avatar-upload-button" for="avatar-upload" class="button transparent">Foto uploaden</label>

                </form>

            </div>

            <div id="avatar-section-crop" style="display: none;">

                <div class="img-container">

                    <img src="" id="sample_image" />

                </div>

                <button type="button" id="avatar-crop-button" class="button">Opslaan</button>

            </div>



            <form method="POST" action="{{ route('user.password_submit') }}" novalidate enctype="multipart/form-data">

                @csrf

                <div class="title">Wachtwoord wijzigen</div>

                @include('form.field-input', ['id' => 'password', 'type' => 'password', 'tag' => 'Wachtwoord', 'placeholder' => 'Kies een wachtwoord', 'required' => true, 'max' => 30])

                @include('form.field-input', ['id' => 'password_confirmation', 'type' => 'password', 'tag' => 'Wachtwoord bevestigen', 'placeholder' => 'Typ je wachtwoord opnieuw', 'required' => true, 'max' => 30])

                <button class="button" id="button-submit" type="submit">

                    Wijzigen

                </button>

            </form>

        </div>

    </div>

@endsection




