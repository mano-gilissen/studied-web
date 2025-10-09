<div id="module-graphs_statistics" class="module">

    <div id="graph_revenue" class="graph">

        <div class="title">{{ __('Omzet per maand') }}</div>

        <div class="graph-options">

            @foreach(/*$years*/[2023, 2024, 2025] as $year)

                <div class="option {{ $loop->last ? 'selected' : '' }} year" id="graph_revenue-option-year-{{ $year }}" onclick="module_graphs_statistics__set_year('revenue', {{ $year }})">{{ $year }}</div>

            @endforeach

            <div class="option selected" id="graph_revenue-option-total" onclick="module_graphs_statistics__set_data('revenue', false)" style="margin-left: auto">{{ __('Totaal') }}</div>

            <div class="option" id="graph_revenue-option-split" onclick="module_graphs_statistics__set_data('revenue', true)">{{ __('Per dienst') }}</div>

        </div>

        <div class="canvas-wrap">

            <canvas id="canvas_revenue" style="width: 100%"></canvas>

        </div>

    </div>

    <div id="graph_studies" class="graph">

        <div class="title">{{ __('Aantal uren') }}</div>

        <div class="graph-options">

            @foreach(/*$years*/[2023, 2024, 2025] as $year)

                <div class="option {{ $loop->last ? 'selected' : '' }} year" id="graph_studies-option-year-{{ $year }}" onclick="module_graphs_statistics__set_year('studies', {{ $year }})">{{ $year }}</div>

            @endforeach

            <div class="option selected" id="graph_studies-option-total" onclick="module_graphs_statistics__set_data('studies', false)" style="margin-left: auto">{{ __('Totaal') }}</div>

            <div class="option" id="graph_studies-option-split" onclick="module_graphs_statistics__set_data('studies', true)">{{ __('Per status') }}</div>

        </div>

        <div class="canvas-wrap">

            <canvas id="canvas_studies" style="width: 100%"></canvas>

        </div>

    </div>

</div>

<script> $(function() { graph_data_all = JSON.parse('{!! json_encode($data__graph_statistics) !!}'); graph_draw(); }); </script>
