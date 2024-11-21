<table class="rs_table {{ $class }}">
    <thead>
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
            <th>Actions</th> <!-- Add an extra header for the actions column -->
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
                <td>
                    @php 
                    $countries = [ 'edit' => 'Edit', 'delete' => 'Delete' ]; 
                    $selectedCountry = 'edit'; 
                    @endphp
                    <x-backend.dropdown :options="$countries" :selected="$selectedCountry" isIcon={{true}} class="right_icon" />
                </td> <!-- Add an action cell with an icon -->
            </tr>
        @endforeach
    </tbody>
</table>
