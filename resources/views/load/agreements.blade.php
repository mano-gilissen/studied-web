@foreach($user->getAgreements_asEmployee as $agreement)

    <div class="agreement" id="{{ $agreement->identifier }}">

        <div class="top">

            <div class="title">{{ $agreement->identifier }}</div>

            <img class="selector" src="/images/check-white.svg"/>

        </div>

        <div class="bottom">

            @if($agreement->getStudent->getPerson->avatar)

                <img src="{{ asset("storage/avatar/" . $agreement->getStudent->getPerson->avatar) }}"/>

            @else

                <div>

                    <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($agreement->getStudent->getPerson) }}</div>

                </div>

            @endif

            <div>{!! \App\Http\Traits\AgreementTrait::getDescription($agreement, true) !!}</div>

        </div>

    </div>

@endforeach

<script>

    agreements_position();

</script>
