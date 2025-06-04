<div class="todo {{ $todo['priority'] }}" onclick="window.location.href='{!! $todo['link'] !!}'">

    <img class="priority" src="/images_app/dashboard-todo-priority-{{ $todo['priority'] }}.svg">

    <div>

        <div class="title">{{ $todo['title'] }}</div>

        <div class="description">{!! $todo['description'] !!}</div>

    </div>

    <img class="action" src="/images_app/chevron-right.svg">

</div>
