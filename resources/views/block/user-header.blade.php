<div class="user">

    <div style="display: grid">

        <div class="name">{{ \App\Http\Traits\UserTrait::getFullName(Auth::user()) }}</div>

        <div class="role">{{ \App\Http\Traits\UserTrait::getRoleName(Auth::user()) }}</div>

    </div>

    <img src="{{ Auth::user()->avatar }}"/>

</div>
