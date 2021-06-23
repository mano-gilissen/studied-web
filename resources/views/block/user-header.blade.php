<div class="user">

    <div>

        <div class="name">{{ \App\Http\Traits\UserTrait::getFullName(Auth::user()) }}</div>

        <div class="title">{{ \App\Http\Traits\UserTrait::getRoleName(Auth::user()) }}</div>

    </div>

    <img src="{{ Auth::user()->avatar ?? ''}}"/>

</div>
