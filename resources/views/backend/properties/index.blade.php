@extends('backend.layout.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Properties</h1>
    <div>
        <button id="quick-add-btn" class="btn btn-primary">Quick Add Property</button>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-secondary">Add Property</a>
    </div>
</div>



<!-- Properties DataTable -->
<table id="properties-table" class="table table-striped">
    <thead>
        <tr>
            <th>Property Name</th>
            <th>City</th>
            <th>Country</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($properties as $property)
        <tr>
            <td>{{ $property->prop_name }}</td>
            <td>{{ $property->city }}</td>
            <td>{{ $property->country }}</td>
            <td>${{ number_format($property->price, 2) }}</td>
            <td>
                <button class="btn btn-info" onclick="showOptions(this)">Actions</button>
                <div class="action-options" style="display: none;">
                    <ul>
                        <li><a href="#">View</a></li>
                        <li><a href="#">Edit</a></li>
                        <li><a href="#">Delete</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('page.scripts')
<script>
    $(document).ready(function() {
        $('#properties-table').DataTable();
        
        $('#quick-add-btn').on('click', function() {
            $('#quick-add-form').toggle();
        });
    });

    function showOptions(button) {
        const actionOptions = $(button).siblings('.action-options');
        actionOptions.toggle();
    }
</script>
@endsection
