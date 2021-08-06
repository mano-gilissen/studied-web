<div class="person {{ $size ?? 'regular' }}" onclick="window.location.href='{{ route('person.view', ['slug' => $person->slug]) }}'">

    @if($person->avatar)

        <img src="{{ asset("storage/avatar/" . $person->avatar) }}"/>

    @else

        <div>

            <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($person) }}</div>

        </div>

    @endif

    @if(($size ?? 'regular') != 'grid')

        <div class="values">

            <div class="name">{{ \App\Http\Traits\PersonTrait::getFullName($person) }}</div>

            <div class="role">{{ \App\Http\Traits\PersonTrait::getSubtitle($person) }}</div>

        </div>

    @endif

</div>
