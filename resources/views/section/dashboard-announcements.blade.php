<div id="module-announcements" class="module">

    <div id="module-announcements-top">

        <div class="title">{{ __('Aankondingen') }}</div>

        @if (in_array(Auth::user()->role, [
            \App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR,
            \App\Http\Traits\RoleTrait::$ID_BOARD,
            \App\Http\Traits\RoleTrait::$ID_MANAGEMENT]))

            <div class="button" id="module-announcements-create" onclick="window.location.href='{{ route('announcement.create') }}'">{{ __('Aanmaken') }}</div>

        @endif

    </div>

    @if ($loop->last && $announcements->count() == 0)

        <div class="empty">{{ __('Er zijn nog geen aankondigingen') }}</div>

    @else

        <div class="list">

            @foreach($announcements as $announcement)

                <div class="item">

                    <div class="title">{{ $announcement->title }}</div>

                    <div class="text">{!! $announcement->body !!}</div>

                    <div class="author">
                        {{
                            ($announcement->author ? ('<span style="font-weight:500">' . $announcements->author . '</span> - ') : '') .
                            Format::datetime($announcement->created_at, \App\Http\Support\Format::$DATETIME_ANNOUNCEMENT)
                        }}
                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>
