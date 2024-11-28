{{-- Owners page  --}}
@php
    $headers = ['id','Name', 'Position', 'Phone', 'email', 'City'];
    $rows = [
        ['id' => 1, 'name' => 'John Doe', 'position' => 'Owner', 'phone' => '456798462', 'email' => 'john@example.com', 'city' => 'London'],
        ['id' => 1, 'name' => 'Jane Smith', 'position' => 'Landlord', 'phone' => '974511268', 'email' => 'jane@example.com', 'city' => 'Paris'],
        // Add more rows as needed
    ];
    $dropdownOptions = [
        ['label' => 'Edit', 'url' => '/edit'],
        ['label' => 'Delete', 'url' => '/delete'],
        // Add more options as needed
    ];
@endphp


<x-backend.dynamic-table-new  :headers="$headers" :rows="$rows" :dropdownOptions="$dropdownOptions" actionBtn={{True}} class="" />

