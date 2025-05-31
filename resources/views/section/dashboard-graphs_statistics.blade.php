<div id="module-graphs_statistics" class="module">

    <div class="graph" style="margin-bottom: 32px">

        <div class="title">{{ __('Omzet per maand') }}</div>

        <div class="graph-options">

            @foreach(/*$years*/[2023, 2024, 2025] as $year)

                <div class="option {{ $loop->last ? 'selected' : '' }}" onclick="module_graphs_statistics__set_year('revenue', {{ $year }})">{{ $year }}</div>

            @endforeach

            <div class="option" onclick="module_graphs_statistics__set_data('revenue', false)" style="margin-left: auto">{{ __('Totaal') }}</div>

            <div class="option selected" onclick="module_graphs_statistics__set_data('revenue', true)">{{ __('Per dienst') }}</div>

        </div>

        <div class="canvas-wrap">

            <canvas id="graph_revenue" style="width: 100%"></canvas>

        </div>

    </div>

    <div class="graph">

        <div class="title">{{ __('Aantal lessen') }}</div>

        <div class="graph-options">

            @foreach(/*$years*/[2023, 2024, 2025] as $year)

                <div class="option {{ $loop->last ? 'selected' : '' }}" onclick="module_graphs_statistics__set_year('revenue', {{ $year }})">{{ $year }}</div>

            @endforeach

            <div class="option" onclick="module_graphs_statistics__set_data('studies', false)" style="margin-left: auto">{{ __('Totaal') }}</div>

            <div class="option selected" onclick="module_graphs_statistics__set_data('studies', true)">{{ __('Per status') }}</div>

        </div>

        <div class="canvas-wrap">

            <canvas id="graph_studies" style="width: 100%"></canvas>

        </div>

    </div>

</div>
