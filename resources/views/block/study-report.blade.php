<div class="block-attributes">

    <div class="title">Rapportage</div>

    <div class="report">

        <div style="display:flex">

            @foreach($study->getParticipants_User as $participant)

                @if($study->getHost->getPerson->avatar)

                    <img src="{{ asset("storage/avatar/" . $study->getHost->getPerson->avatar) }}"/>

                @else

                    <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($study->getHost->getPerson) }}</div>

                @endif

                <div class="comment-tail"></div>

                <div class="comment">{{ $study->getReport($participant)->content_verslag }}</div>

                @break

            @endforeach

        </div>

    </div>

</div>
