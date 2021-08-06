<div class="block-users">

    <div class="title">Spreker</div>

    @include('block.person', ['person' => $study->getHost->getPerson, 'size' => 'large'])

    @if(strlen($study->{\App\Http\Support\Model::$STUDY_SUBJECT_DESCRIPTION}) > 0)

        <div class="comment-tail up"></div>

        <div class="comment">"{{ $study->{\App\Http\Support\Model::$STUDY_SUBJECT_DESCRIPTION} }}"</div>

    @endif

</div>
