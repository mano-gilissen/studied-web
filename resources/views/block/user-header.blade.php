<div class="user">

    <div style="display: grid">

        <div class="name">{{ \App\Http\Traits\UserTrait::getFullName(Auth::user()) }}</div>

        <div class="role">{{ \App\Http\Traits\UserTrait::getRoleName(Auth::user()) }}</div>

    </div>

    @if(Auth::user()->avatar)

        <img src="{{ asset("storage/avatar/" . Auth::user()->avatar) }}"/>

    @else

        <div class="no-avatar">{{ \App\Http\Traits\UserTrait::getInitials(Auth::user()) }}</div>

    @endif

</div>
