@foreach($items as $item)

    <div class="item" onclick="window.location.href='{{ $item->link ?? '' }}'">

        @switch ($data_type)

            @case(\App\Http\Support\Model::$STUDY)

                @php

                    $desiredOrder = [
                        \App\Http\Controllers\StudyController::$COLUMN_DATE,
                        \App\Http\Controllers\StudyController::$COLUMN_HOST,
                        \App\Http\Controllers\StudyController::$COLUMN_TIME,
                        \App\Http\Controllers\StudyController::$COLUMN_STUDENT,
                        \App\Http\Controllers\StudyController::$COLUMN_SUBJECT,
                        \App\Http\Controllers\StudyController::$COLUMN_SERVICE,
                        \App\Http\Controllers\StudyController::$COLUMN_LOCATION,
                        \App\Http\Controllers\StudyController::$COLUMN_STATUS,
                    ];

                    $sorted = $item->sortBy(function ($attribute) use ($desiredOrder) {
                        return array_search($attribute->id, $desiredOrder);
                    })->values();

                @endphp

                @break

            @default

                @break

        @endswitch

        @foreach($columns as $column)

            <div class="attribute">

                <div class="label">{{ $column->label }}</div>

                <div class="value">@if($column->html){!! __($item->{$column->id}) !!}@else{{ __($item->{$column->id}) }}@endif</div>

            </div>

        @endforeach

    </div>

@endforeach
