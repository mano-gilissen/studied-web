<div id="module-announcements" class="module">

    <div id="module-announcements-top">

        <div class="title">{{ __('Aankondingen') }}</div>

        @if (\App\Http\Traits\BaseTrait::hasManagementRights())

            <div class="button" id="module-announcements-create" onclick="window.location.href='{{ route('announcement.create') }}'">{{ __('Aanmaken') }}</div>

        @endif

    </div>

    @if ($data__announcements->count() == 0)

        <div class="empty">{{ __('Er zijn op dit moment geen aankondigingen.') }}</div>

    @else

        <div class="list">

            @foreach($data__announcements as $announcement)

                <div class="announcement">

                    <div class="title">{{ $announcement->title }}</div>

                    <div class="text">{!! $announcement->body !!}</div>

                    <div class="author">
                        {!!
                            ($announcement->author ? ('<span style="font-weight:500">' . $announcement->author . '</span>&nbsp;&nbsp;') : '') .
                            (\App\Http\Traits\BaseTrait::hasManagementRights() ? ('<span style="font-style:italic;opacity:.5">voor ' . \App\Http\Traits\RoleTrait::getName($announcement->role) . '</span>&nbsp;&nbsp;-&nbsp;&nbsp;') : ($announcement->author ? '-&nbsp;&nbsp;' : '')) .
                            \App\Http\Support\Format::datetime($announcement->created_at, \App\Http\Support\Format::$DATETIME_ANNOUNCEMENT)!!}
                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>
