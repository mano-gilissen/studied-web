@extends('form.template')



@section('css-form')

    <!-- Align subject and level fields vertically on mobile -->

    <style>

        @media (max-width: 840px) {

            #form .block-form #field-subject-level  {
                display: grid;
                grid-template-columns: 1fr 2fr;
                grid-template-rows: auto auto;
                grid-row-gap: 32px;
            }

            #form .block-form #field-subject-level .width-third {
                width: 100%;
            }

            #form .block-form #field-subject-level .width-third.name {
                justify-content: start;
            }
        }

    </style>

@endsection



@section('fields')



    @include('load.agreement', ['id' => 1])



@endsection
