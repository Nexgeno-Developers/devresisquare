@php
$headers = ['id','Status', 'Sub Status', 'Price', 'Frequency', 'Estate Agent', 'Move in', 'Move out'];
$rows = [
    ['id' => 1,'Status' => 'Active', 'Sub Status' => 'Ready', 'Price' => '300', 'Frequency' => 'Quarterly', 'Estate Agent' => 'Tenant','Move in'=>'22/11/24', 'Move out'=>'21/02/25'],
    ['id' => 1,'Status' => 'Inactive', 'Sub Status' => 'Not Ready', 'Price' => '2500', 'Frequency' => 'Yearly', 'Estate Agent' => 'Tenant','Move in'=>'22/11/25', 'Move out'=>'21/02/26'],
    // Add more rows as needed
];
@endphp


<x-backend.dynamic-table-new  :headers="$headers" :rows="$rows" dropdownOptions="" actionBtn={{False}} class="" />

