<div class="table">
    <ul class="nav">
        @foreach ($tabs as $key => $tab)
            <li class="{{ $key === 0 ? 'active' : '' }}">
                <a href="#{{ Str::slug($tab['name']) }}" class="tab-link {{ $key === 0 ? 'active' : '' }}">
                    {{ $tab['name'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($tabs as $key => $tab)
            <div id="{{ Str::slug($tab['name']) }}" class="tab-pane {{ $key === 0 ? 'active' : '' }}">
                {{ $tab['content'] }}
            </div>
        @endforeach
    </div>
</div>
