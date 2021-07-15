<div class="person {{ $size ?? 'regular' }}" onclick="window.location.href='{{ route('person.profile', ['slug' => $person->slug]) }}'">

    @if($person->avatar)

        <img src="{{ asset("storage/avatar/" . $person->avatar) }}"/>

    @else

        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($person) }}</div>

    @endif

    <div class="values">

        <div class="name">{{ \App\Http\Traits\PersonTrait::getFullName($person) }}</div>

        <div class="role">Porta Mosana College</div>

    </div>

</div>
