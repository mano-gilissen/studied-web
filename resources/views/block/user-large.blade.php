<div class="user large">

    @if($user->getPerson->avatar)

        <img src="{{ asset("storage/avatar/" . $user->getPerson->avatar) }}"/>

    @else

        <div class="no-avatar">{{ \App\Http\Traits\UserTrait::getInitials($user) }}</div>

    @endif

    <div class="values">

        <div class="name">{{ \App\Http\Traits\UserTrait::getFullName($user) }}</div>

        <div class="role">{{ $role }}</div>

    </div>

</div>
