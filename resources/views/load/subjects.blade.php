@if ($time_available ?? false)

    @if ($time_available > 0)

        @if ($time_available <= 180)

            @include('form.field-report-subject', ['id' => 1, 'id_user' => $id_usera, 'time_available' => $time_available, 'primary' => true])

            <div class="seperator small"></div>

            <div id="secondary" style="display: none">

                @include('form.field-report-subject', ['id' => 2, 'id_user' => $id_usera, 'time_available' => $time_available, 'primary' => false])

            </div>

            <div id="button-subject-add" class="button grey">Er was nog een activiteit</div>

        @else

            <div class="block-note">Een les kan maximaal 3 uur duren, kies een ander start en eind tijdstip.</div>

        @endif

    @else

        <div class="block-note">Selecteer een eind tijdstip dat eerder is als het start tijdstip.</div>

    @endif

@else

    <div class="block-note">Selecteer eerst het exacte start en eind tijdstip bovenaan.</div>

@endif

<script>

    $(function(){

        $(OBJECT_BUTTON_SUBJECT_ADD).on('click', function() {

            $(OBJECT_BUTTON_SUBJECT_ADD).hide();

            $('#secondary').show();
        });
    });

</script>
