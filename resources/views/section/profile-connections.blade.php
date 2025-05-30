<div class="block-users">

    <div class="title">{{ __('Connecties') }}</div>

    <div class="list-users">

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @if(\App\Http\Traits\StudentTrait::hasCustomer($person->getUser->getStudent))

                    @include('component.person', ['person' => $person->getUser->getStudent->getCustomer->getUser->getPerson])

                @endif

                @foreach($person->getUser->getEmployees as $employee)

                    @include('component.person', ['person' => $employee->getPerson, 'subtitle' => __('Student-docent')])

                @endforeach

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @break

        @endswitch

    </div>

</div>
