@php
    $headers = ['id','Name', 'Position', 'Phone', 'email', 'City'];
    $rows = [
        [1, 'John Doe', 'Owner', '456798462', 'john@example.com', 'London'],
        [2, 'Jane Smith', 'Owner', '974511268', 'jane@example.com', 'Mumbai'],
    ];
@endphp
<x-backend.dynamic-table :headers="$headers" :rows="$rows" class='' />