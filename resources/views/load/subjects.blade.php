@if ($time_available ?? false)

    @if ($time_available > 0)

        @if ($time_available <= 180)

            @include('component.field-report-subject', ['id' => 1, 'time_available' => $time_available, 'primary' => true])

            <div class="seperator small"></div>

            @if(!$report || ($report && $report->getReport_Subjects->count() == 1))

                <div id="button-subject-add-{{ $user->id }}" class="button grey">{{ __('Er was nog een activiteit') }}</div>

            @endif

            <div id="secondary-{{ $user->id }}" style="display: {{ $report && $report->getReport_Subjects->count() > 1 ? 'block' : 'none' }}">

                @include('component.field-report-subject', ['id' => 2, 'time_available' => $time_available, 'primary' => false])

            </div>

        @else

            <div class="block-note">{{ __('Een les kan maximaal 3 uur duren, kies een ander start en eind tijdstip.') }}</div>

        @endif

    @else

        <div class="block-note">{{ __('Selecteer een eind tijdstip dat eerder is als het start tijdstip.') }}</div>

    @endif

@else

    <div class="block-note">{{ __('Selecteer eerst het exacte start en eind tijdstip bovenaan.') }}</div>

@endif

<script>

    $(function(){

        $(OBJECT_BUTTON_SUBJECT_ADD + '-{{ $user->id }}').on('click', function() {

            $(OBJECT_BUTTON_SUBJECT_ADD + '-{{ $user->id }}').hide();

            $('#secondary-{{ $user->id }}').show();
        });
    });

</script>
