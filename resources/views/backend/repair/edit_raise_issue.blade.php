@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h1>Edit Repair Issue</h1>

        <form action="{{ route('admin.property_repairs.update', $repairIssue->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="repair_category_id">Category</label>
                <input type="text" class="form-control" id="repair_category_id" name="repair_category_id" value="{{ old('repair_category_id', $repairIssue->repair_category_id) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $repairIssue->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="active" {{ $repairIssue->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="resolved" {{ $repairIssue->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="{{ route('admin.property_repairs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
