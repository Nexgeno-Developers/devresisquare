<table class="rs_table">
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
                    <a href="#" class="btn btn-sm btn-primary">
                        <i class="fa fa-cog"></i> <!-- Change this icon to whatever suits your need -->
                    </a>
                </td> <!-- Add an action cell with an icon -->
            </tr>
        @endforeach
    </tbody>
</table>
