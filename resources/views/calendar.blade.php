@extends('app')



@section('css')

    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

@endsection



@section('content')



    @include('block.header')



    <div id="content">



        <div class="calendar">

            <div class="calendar-header">

                <div>Datum</div>

                <div>07:00</div>

                <div>08:00</div>

                <div>09:00</div>

                <div>10:00</div>

                <div>11:00</div>

                <div>12:00</div>

                <div>13:00</div>

                <div>14:00</div>

                <div>15:00</div>

                <div>16:00</div>

                <div>17:00</div>

                <div>18:00</div>

                <div>19:00</div>

                <div>20:00</div>

                <div>21:00</div>

                <div>22:00</div>

                <div>23:00</div>

            </div>

            <div class="calendar-days">

                @for ($i = 0; $i < 14; $i++)

                    @php $date = \Carbon\Carbon::today()->addDays($i)->toDateString(); @endphp

                    <div class="calendar-day">

                        <div class="date" style="grid-column-start:0;grid-column-end:4;">{{ $date }}</div>

                        @foreach(\App\Models\Study::whereDate('created_at', '=', $date)->get() as $study)

                            @php $start = ((substr($study->start, 0, 2) * 4) + substr($study->start, 3, 2)) - 24 @endphp
                            @php $end = ((substr($study->end, 0, 2) * 4) + substr($study->end, 3, 2)) - 24 @endphp

                            <div class="study" style="grid-column-start:{{ $start }};grid-column-end:{{ $end }};">

                                <p>{{ \App\Http\Traits\PersonTrait::getFullName($study->getHost->getPerson) }}</p>

                                <p>{{ $study->getService->{\App\Http\Support\Model::$SERVICE_NAME} }}</p>

                            </div>

                        @endforeach

                    </div>

                @endfor

            </div>

        </div>



    </div>



@endsection




