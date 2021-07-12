<div id="menu" style="display: none">

    @switch(Auth::user()->role)

        @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

        @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

            @include('block.menu-item', ['label' => 'Mijn profiel', 'route' => route('person.profile', Auth::user()->getPerson->slug)])

            @include('block.menu-item', ['label' => 'Lessen', 'route' => route('study.list')])

            @include('block.menu-item', ['label' => 'Medewerkers'])

            @include('block.menu-item', ['label' => 'Leerlingen'])

            @include('block.menu-item', ['label' => 'Klanten'])

            @include('block.menu-item', ['label' => 'Locatieagenda'])

            @break

        @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

            @include('block.menu-item', ['label' => 'Mijn profiel'])

            @include('block.menu-item', ['label' => 'Lessen'])

            @include('block.menu-item', ['label' => 'Medewerkers'])

            @include('block.menu-item', ['label' => 'Leerlingen'])

            @include('block.menu-item', ['label' => 'Klanten'])

            @include('block.menu-item', ['label' => 'Locatieagenda'])

            @break

        @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

            @include('block.menu-item', ['label' => 'Mijn profiel'])

            @include('block.menu-item', ['label' => 'Lessen'])

            @include('block.menu-item', ['label' => 'Leerlingen'])

            @include('block.menu-item', ['label' => 'Locatieagenda'])

            @break

        @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

            @include('block.menu-item', ['label' => 'Mijn profiel'])

            @include('block.menu-item', ['label' => 'Lessen'])

            @break

        @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

            @include('block.menu-item', ['label' => 'Lessen'])

            @include('block.menu-item', ['label' => 'Leerlingen'])

            @break

    @endswitch

</div>
