<div class="user large">

    @if($user->getPerson->avatar)

        <img src="{{ asset("storage/avatar/" . $user->getPerson->avatar) }}"/>

    @else

        <div class="no-avatar">{{ \App\Http\Traits\UserTrait::getInitials($user) }}</div>

    @endif

    <div style="display: grid">

        <div class="name">{{ \App\Http\Traits\UserTrait::getFullName($user) }}</div>

        <div class="role">{{ \App\Http\Traits\UserTrait::getRoleName($user) }}</div>

    </div>

</div>
