@if ($time_available ?? false)

    @if ($time_available > 0)

        @include('form.field-report-subject', ['id' => 1, 'time_available' => $time_available, 'primary' => true])

        <div style="height: 64px"></div>

        @include('form.field-report-subject', ['id' => 2, 'time_available' => $time_available, 'primary' => false])

    @else

        <div class="block-note">Selecteer een eind tijdstip dat eerder is als het start tijdstip.</div>

    @endif

@else

    <div class="block-note">Selecteer eerst de exacte start en eind tijdstip bovenaan.</div>

@endif
