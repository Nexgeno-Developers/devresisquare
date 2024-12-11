@extends('backend.layout.app')

@section('content')
    <h1>Designations</h1>
    <a href="{{ route('admin.designations.create') }}" class="btn btn-primary">Add New Designation</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($designations as $designation)
                <tr>
                    <td>{{ $designation->id }}</td>
                    <td>{{ $designation->title }}</td>
                    <td>
                        <a href="{{ route('admin.designations.edit', $designation->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.designations.destroy', $designation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
