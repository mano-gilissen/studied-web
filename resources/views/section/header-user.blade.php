<div class="person" onclick="navigate('{{ route('person.view', ['slug' => Auth::user()->getPerson->slug]) }}')">

    <div style="display: grid">

        <div class="name">{{ \App\Http\Traits\PersonTrait::getFullName(Auth::user()->getPerson) }}</div>

        <div class="role">{{ \App\Http\Traits\UserTrait::getRoleName(Auth::user()) }}</div>

    </div>

    @if(Auth::user()->getPerson->avatar)

        <img src="{{ asset("storage/avatar/" . Auth::user()->getPerson->avatar) }}"/>

    @else

        <div>

            <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials(Auth::user()->getPerson) }}</div>

        </div>

    @endif

</div>
