@extends('backend.layout.app')

@section('content')
<div class="container-fluid">
    <h1>Contacts</h1>
    <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary">Create Contact</a>
    <table id="contacts-table" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->status ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $contact->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
                        <a href="javascript:void(0);" class="action-icon" onclick="confirmModal('{{ url(route('admin.contacts.delete', $contact->id)) }}', responseHandler)"><i class="mdi mdi-delete" title="Delete"></i>Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('page.scripts')
<script>
    $(document).ready(function () {
        $('#contacts-table').DataTable();
    });

    var responseHandler = function(response) {
        location.reload();
    }
</script>
@endsection
