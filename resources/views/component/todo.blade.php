<div class="todo {{ $todo['priority'] }}" onclick="navigate('{!! $todo['link'] !!}')">

    <img class="priority" src="/images_app/dashboard-todo-{{ array_key_exists('icon', $todo) ? 'icon-' . $todo['icon'] : 'priority-' . $todo['priority'] }}.svg">

    <div>

        <div class="title">{{ $todo['title'] }}</div>

        <div class="description">{!! $todo['description'] !!}</div>

    </div>

    <img class="action" src="/images_app/chevron-right.svg">

</div>
