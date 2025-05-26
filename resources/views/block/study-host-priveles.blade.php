<div class="block-users" data-type="host">

    <div class="title">{{ __('Student-docent') }}</div>

    @include('block.person', ['person' => $study->getHost->getPerson, 'size' => 'large'])

    @if(strlen($study->{\App\Http\Support\Model::$STUDY_REMARK}) > 0)

        <div class="comment-tail up"></div>

        <div class="comment">"{{ $study->{\App\Http\Support\Model::$STUDY_REMARK} }}"</div>

    @endif

</div>
