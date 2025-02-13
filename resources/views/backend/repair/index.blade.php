@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h1>Repair Issues</h1>

        <!-- Display success message if any -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table displaying repair issues -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Property</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($repairIssues as $issue)
                    <tr>
                        <td>{{ $issue->id }}</td>
                        {{-- <td>{{ $issue->property_id }}</td> --}}
                        <td>{{ getPropertyDetails($issue->property_id, ['prop_ref_no', 'prop_name', 'line_1', 'line_2', 'city', 'country']) }}</td>
                        {{-- <td>{{ $issue->repair_category_id }}</td> --}}
                        <td>{{ getRepairCategoryDetails($issue->repair_category_id) }}</td>
                        <td>{{ $issue->description }}</td>
                        <td>{{ $issue->status }}</td>
                        <td>{{ $issue->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.property_repairs.show', $issue->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.property_repairs.edit', $issue->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.property_repairs.delete', $issue->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination (if there are many records) -->
        {{ $repairIssues->links() }}
    </div>
@endsection

@section('page.scripts')
    <script>
        // Additional JS scripts (e.g., for confirming delete action)
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function (e) {
                if (!confirm('Are you sure you want to delete this repair issue?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
