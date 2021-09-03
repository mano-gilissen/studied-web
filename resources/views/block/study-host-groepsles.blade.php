<div class="block-users">

    <div class="title">Student-docent</div>

    @include('block.person', ['person' => $study->getHost->getPerson])

    @if(strlen($study->{\App\Http\Support\Model::$STUDY_REMARK}) > 0)

        <div class="comment-tail" style="transform: rotate(180deg)"></div>

        <div class="comment">"{{ $study->{\App\Http\Support\Model::$STUDY_REMARK} }}"</div>

    @endif

</div>
