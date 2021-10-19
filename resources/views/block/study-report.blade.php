<div class="block-attributes">

    <div class="title">Rapportage</div>

    @if(\App\Http\Traits\StudyTrait::hasGroupReporting($study))

        <div class="report-tabs">

            @foreach($study->getParticipants_User as $participant)

                <div class="tab" id="{{ $participant->id }}">{{ $participant->getPerson->first_name }}</div>

            @endforeach

        </div>

    @endif

    @foreach($study->getParticipants_User as $participant)

        @php $report = $study->getReport($participant) @endphp

        <div class="report" id="report_{{ $participant->id }}">

            <div style="display:flex">

                <div id="{{ $study->getHost->getPerson->first_name }}" class="person-report" onclick="window.location.href='{{ route('person.view', ['slug' => $study->getHost->getPerson->slug]) }}'">

                    @if($study->getHost->getPerson->avatar)

                        <img src="{{ asset("storage/avatar/" . $study->getHost->getPerson->avatar) }}"/>

                    @else

                        <div>

                            <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($study->getHost->getPerson) }}</div>

                        </div>

                    @endif

                </div>

                <div class="comment-tail"></div>

                <div class="comment">"{{ \App\Http\Traits\ReportTrait::getVerslagText($report) }}"</div>

            </div>

            @if(\App\Http\Traits\StudyTrait::isTrial($study) && !($report->{\App\Http\Support\Model::$REPORT_TRIAL_SUCCESS}))

                <div class="block-note error small">Deze proefles was geen succes. Dat betekent dat de vakafspraak die hierbij hoort afgesloten is en niet gebruikt gaat worden.</div>

            @endif


            <div class="subjects">

                @foreach($report->getReport_Subjects as $report_subject)

                    <div class="subject">

                        <div class="name">{{ $report_subject->getAgreement ? \App\Http\Traits\AgreementTrait::getVakcode($report_subject->getAgreement) : $report_subject->getSubject->{ \App\Http\Support\Model::$SUBJECT_NAME} }}</div>

                        <div class="bar-wrap">

                            <div class="bar-duration" style="width: {{ $report_subject->{\App\Http\Support\Model::$REPORT_SUBJECT_DURATION} / \App\Http\Traits\ReportTrait::getDurationTotal($report) }}">

                            </div>

                        </div>

                        <div class="dots" style="display: none">

                            @for ($i = 0; $i < \App\Http\Traits\ReportTrait::getDurationDots_Total($report); $i++)

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

            <div class="content-fold">

                <div class="item">

                    <div class="item-title">

                        <div>Voortgang</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $report->{\App\Http\Support\Model::$REPORT_CONTENT_VOORTGANG} }}</p>

                </div>

                <div class="seperator"></div>

                <div class="item">

                    <div class="item-title">

                        <div>Volgende les</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $report->{\App\Http\Support\Model::$REPORT_CONTENT_VOLGENDE_LES} }}</p>

                </div>

                <div class="seperator"></div>

                <div class="item">

                    <div class="item-title">

                        <div>Uitdagingen</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $report->{\App\Http\Support\Model::$REPORT_CONTENT_UITDAGINGEN} }}</p>

                </div>

            </div>

        </div>

    @endforeach

</div>
