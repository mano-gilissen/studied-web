@if ($time_available ?? false)

    @if ($time_available > 0)

        @include('form.field-report-subject', ['id' => 1, 'time_available' => $time_available, 'primary' => true])

        <div style="height:64px"></div>

        <div id="secondary" style="display: none">

            @include('form.field-report-subject', ['id' => 2, 'time_available' => $time_available, 'primary' => false])

        </div>

        <div id="button-subject-add" class="button grey">Er was nog een activiteit</div>

    @else

        <div class="block-note">Selecteer een eind tijdstip dat eerder is als het start tijdstip.</div>

    @endif

@else

    <div class="block-note">Selecteer eerst de exacte start en eind tijdstip bovenaan.</div>

@endif

<script>

    $(function(){

        $(OBJECT_BUTTON_SUBJECT_ADD).on('click', function() {

            $(OBJECT_BUTTON_SUBJECT_ADD).hide();

            $('#secondary').show();
        });
    });

</script>
