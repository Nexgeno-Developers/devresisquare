@extends('backend.layout.app')

@section('content')
<div class="container-fluid">
    <h1>Contact Categories</h1>
    <a href="{{ route('contact-categories.create') }}" class="btn btn-primary">Create Category</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('contact-categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('contact-categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
