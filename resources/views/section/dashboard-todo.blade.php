<div id="module-todo" class="module">

    <div class="title">{{ __('Taken to do') }}</div>

    <div class="list">

        @foreach($data__todo as $todo)

            @include('component.todo', ['todo' => $todo])

        @endforeach

    </div>

</div>
