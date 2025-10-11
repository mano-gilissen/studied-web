<div style="
width: 94%;
padding:8px 16px;
border-radius:8px;
color:black;
display: flex;
align-items: center;
margin-bottom: 16px;

@switch($todo['priority'])

    @case('high')
        background: #ffdfdf;
        border: 1px solid #ff5f5f;
        @break

    @case('medium')
        background: #fff8d6;
        border: 1px solid #ffdd34;
        @break

    @default
        @break

@endswitch"

@if(strlen($todo['link']))

     onclick="window.open('{{ $todo['link'] }}')"

@endif>

    <img style="width: 24px;height: 24px;padding-right: 16px;" src="/images_app/dashboard-todo-{{ array_key_exists('icon', $todo) ? 'icon-' . $todo['icon'] : 'priority-' . $todo['priority'] }}.svg"/>

    <div>

        <div style="font-size:12px;font-weight:600;line-height: 21px">{{ $todo['title'] }}</div>

        <div style="font-size:12px;color:#666;line-height: 21px">{{ $todo['description'] }}</div>

    </div>

    <img style="width: 24px;height: 24px;margin-left: auto" src="/images_app/chevron-right.svg">

</div>
