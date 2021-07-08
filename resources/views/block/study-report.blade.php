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

                    <div class="subject">

                        <div class="name">{{ $report_subject->getSubject->description_short }}</div>

                        <div class="dots">

                            @for ($i = 0; $i < \App\Http\Traits\ReportTrait::getDurationDots_Total($study->getReport($participant)); $i++)

                                @if($i < \App\Http\Traits\Report_SubjectTrait::getDurationDots($report_subject))

                                    <div class="dot" style="background:#FFDD34"></div>

                                @else

                                    <div class="dot" style="background:#E6E6E6"></div>

                                @endif

                            @endfor

                        </div>

                        <div class="duration">{{ \App\Http\Traits\Report_SubjectTrait::getDurationReadable($report_subject) }}</div>

                    </div>

                @endforeach

            </div>

            <div class="content">

                <div class="item">

                    <div>Voortgang</div>

                    <img src="/images/chevron.svg">

                </div>

                <div class="seperator"></div>

                <div class="item">

                    <div>Volgende les</div>

                    <img src="/images/chevron.svg">

                </div>

                <div class="seperator"></div>

                <div class="item">

                    <div>Uitdagingen</div>

                    <img src="/images/chevron.svg">

                </div>

            </div>

        </div>

    @endforeach

</div>
