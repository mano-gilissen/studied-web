<div class="block-attributes">

    <div class="title">Rapportage</div>

    @foreach($study->getParticipants_User as $participant)

        <div class="report">

            <div style="display:flex">

                @if($study->getHost->getPerson->avatar)

                    <img src="{{ asset("storage/avatar/" . $study->getHost->getPerson->avatar) }}"/>

                @else

                    <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($study->getHost->getPerson) }}</div>

                @endif

                <div class="comment-tail"></div>

                <div class="comment">{{ $study->getReport($participant)->content_verslag }}</div>

            </div>

            <div class="subjects">

                @foreach($study->getReport($participant)->getReport_Subjects as $report_subject)

                    <div>{{ $report_subject->getSubject->description_short }}</div>

                @endforeach

            </div>

        </div>

        @break

    @endforeach

</div>
