<div class="user {{ $size ?? 'regular' }}">

    @if($user->getPerson->avatar)

        <img src="{{ asset("storage/avatar/" . $user->getPerson->avatar) }}"/>

    @else

        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($user->getPerson) }}</div>

    @endif

    <div class="values">

        <div class="name">{{ \App\Http\Traits\PersonTrait::getFullName($user->getPerson) }}</div>

        <div class="role">Porta Mosana College</div>

    </div>

</div>
