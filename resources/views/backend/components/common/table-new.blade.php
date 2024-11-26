<div class="dynamic_div">
    <div class="desktop_only">
        <table class="table rs_table {{ $class }}">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        @if ($header !== 'id')
                            <th>{{ $header }}</th>
                        @endif
                    @endforeach
                    @if($actionBtn == True)
                        <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        @foreach ($row as $key => $value)
                            @if ($key !== 'id')
                                <td>{{ $value }}</td>
                            @endif
                        @endforeach
                        @if($actionBtn == True )
                            <td>
                                <x-backend.dropdown :options="$dropdownOptions" class="" isIcon={{True}} />
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
