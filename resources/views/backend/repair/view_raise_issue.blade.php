@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h1>Repair Issue Details</h1>

        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $repairIssue->id }}</td>
            </tr>
            <tr>
                <th>Property</th>
                <td>{{ getPropertyDetails($repairIssue->property_id, ['prop_ref_no', 'prop_name', 'line_1', 'line_2', 'city', 'country']) }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ getRepairCategoryDetails($repairIssue->repair_category_id) }}</td>
                {{-- <td>{{ $repairIssue->repair_category_id }}</td> --}}
            </tr>
            <tr>
                <th>Navigate room vise</th>
                <td>{{ getFormattedRepairNavigation($repairIssue->repair_navigation) }}</td>
                {{-- <td>{{ $repairIssue->repair_navigation }}</td> --}}
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $repairIssue->description }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $repairIssue->status }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $repairIssue->created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $repairIssue->updated_at }}</td>
            </tr>
        </table>

        <a href="{{ route('admin.property_repairs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
