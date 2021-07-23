<div class="block-users">

    <div class="title">Connecties</div>

    <div class="list-users">

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @if(\App\Http\Traits\StudentTrait::hasCustomer($person->getUser->getStudent))

                    @include('block.person', ['person' => $person->getUser->getStudent->getCustomer->getUser->getPerson])

                @endif

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @break

        @endswitch

    </div>

</div>
