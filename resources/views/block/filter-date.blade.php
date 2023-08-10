<div class="filter-wrap-date">

    <div class="note">Van</div>

    <div class="box-input date">

        <input id="{{'filter_input_' . $column->id . '_after'}}" type="date" name="{{'filter_input_' . $column->id . '_after'}}" onchange="filter_column_date('{{ $column->id }}')">

    </div>

</div>

<div class="filter-wrap-date">

    <div class="note">Tot</div>

    <div class="box-input date">

        <input id="{{'filter_input_' . $column->id . '_before'}}" type="date" name="{{'filter_input_' . $column->id . '_before'}}" onchange="filter_column_date('{{ $column->id }}')">

    </div>

</div>
