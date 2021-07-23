<div class="block-users">

    <div class="title">Connecties</div>

    <div class="list-users">

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @if($person->getUser->getStudent->hasCustomer)

                    @include('block.person', ['person' => $person->getUser->getStudent->getCustomer->getUser->getPerson])

                @endif

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @break

        @endswitch

    </div>

</div>
