<div id="menu" style="display: none">

    <div>

        @switch(Auth::user()->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                @include('block.menu-item', ['label' => 'Lesoverzicht', 'route' => route('study.list')])

                @include('block.menu-item', ['label' => 'Agenda'])

                @include('block.menu-item', ['label' => 'Leerlingen', 'route' => route('student.list')])

                @include('block.menu-item', ['label' => 'Klanten', 'route' => route('customer.list')])

                @include('block.menu-item', ['label' => 'Medewerkers', 'route' => route('employee.list')])

                @include('block.menu-item', ['label' => 'Mijn profiel', 'route' => route('person.self')])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                @include('block.menu-item', ['label' => 'Lesoverzicht', 'route' => route('study.list')])

                @include('block.menu-item', ['label' => 'Agenda'])

                @include('block.menu-item', ['label' => 'Mijn leerlingen', 'route' => route('student.list')])

                @include('block.menu-item', ['label' => 'Mijn profiel', 'route' => route('person.self')])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @include('block.menu-item', ['label' => 'Lesoverzicht', 'route' => route('study.list')])

                @include('block.menu-item', ['label' => 'Mijn profiel', 'route' => route('person.self')])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @include('block.menu-item', ['label' => 'Lesoverzicht', 'route' => route('study.list')])

                @if(\App\Http\Traits\CustomerTrait::hasMultipleStudents(Auth::user()->getCustomer))

                    @include('block.menu-item', ['label' => 'Mijn leerlingen', 'route' => route('student.list')])

                @else

                    @include('block.menu-item', ['label' => 'Mijn leerling', 'route' => route('person.view', Auth::user()->getCustomer->getStudents->first()->getUser->getPerson->slug)])

                @endif

                @include('block.menu-item', ['label' => 'Mijn profiel', 'route' => route('person.self')])

                @break

        @endswitch

    </div>

    <div id="menu-actions">

        <img id="button-logout" src="/images_app/logout.svg" onclick="event.preventDefault(); document.getElementById('logout').submit();"/>

        <img id="button-settings" src="/images_app/settings.svg"/>

        <form id="logout" method="POST" action="{{ route('logout') }}">

            @csrf

        </form>

    </div>

</div>
