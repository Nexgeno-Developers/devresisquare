@extends('backend.layout.app')

@section('content')


@php
    // Table headers
    $headers = ['id' => 'id', 'name' => 'Name', 'status' => 'Status', 'Actions' => ''];

@endphp

<div class="container-fluid">
    <h1>Categories</h1>
    <a href="{{ route('contact-categories.create') }}" class="btn btn-primary">Create Category</a>
    {{-- <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody> --}}
            <x-backend.dynamic-table
            :headers="$headers"
            :rows="$categories"
            class=""
            />

            {{-- @foreach($categories as $category)
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
    </table> --}}
</div>
@endsection
