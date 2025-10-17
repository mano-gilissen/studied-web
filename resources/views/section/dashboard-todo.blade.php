<div id="module-todo" class="module">

    <div class="title">{{ __('Taken to do') }}</div>

    <div class="list">

        @if(count($data__todo) == 0)

            <div class="todo positive">

                <img class="priority" src="/images_app/dashboard-todo-check.svg">

                <div>

                    <div class="title">{{ __('Er zijn op dit moment geen to do\'s.') }}</div>

                    <div class="description">{{ __('Goed bezig! Je hebt alles goed bijgehouden en er zijn op dit moment geen taken to do.') }}</div>

                </div>

            </div>

        @else

            @foreach($data__todo as $todo)

                @include('component.todo', ['todo' => $todo])

            @endforeach

        @endif

    </div>

</div>
