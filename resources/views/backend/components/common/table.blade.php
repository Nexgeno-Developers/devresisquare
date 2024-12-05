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
                                @php 
                                    $options = [ 'edit' => 'Edit', 'delete' => 'Delete' ]; 
                                    $selectedOptions = 'edit'; 
                                @endphp
                                <x-backend.dropdown :options="$options" :selected="$selectedOptions" isIcon={{true}} class="right_icon" />
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mobile_only">
        <div class="rs_mobile_table">
            @foreach($rows as $row)
                <div class="data-row">
                    @foreach($row as $index => $value)
                        <div class="tr_row">
                            <div>{{ $headers[$index] }}</div>
                            <div class="text_right fw_normal">{{ $value }}</div>
                        </div>
                    @endforeach
                    <div class="flex">
                        @foreach($options as $value => $label)
                        <a class="btn" href="#" onclick="selectOption('{{ $value }}', '{{ $label }}')">{{ $label }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
