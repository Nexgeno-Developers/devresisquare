@extends('backend.layout.app')

@section('content')
<div class="container-fluid rs_container_fluid">
    <h1>Contacts</h1>

    <!-- Category Filter Form -->
    <form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request()->category == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="top_button">
        <a href="{{ route('admin.contacts.create') }}" class="btn btn_secondary">Create Contact</a>
    </div>
    <div class="contact_content_Detail">
        <table id="contacts-table" class="table table-striped mt-3 rs_responsive_table">
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
                        <td><span class="mobile_only">Name</span> <span> {{ $contact->first_name }} {{ $contact->last_name }}</span></td>
                        <td><span class="mobile_only">Phone</span> <span> {{ $contact->phone }}</span></td>
                        <td><span class="mobile_only">Email</span> <span> {{ $contact->email }}</span></td>
                        <td><span class="mobile_only">Status</span> <span> {{ $contact->status ? 'Active' : 'Inactive' }}</span></td>
                        <td><span class="mobile_only">Category</span> <span> {{ $contact->category->name }}</span></td>
                        <td class="action_btns">
                            <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn_primary me-2">Edit</a>
                            <a href="javascript:void(0);" class="action-icon btn btn-danger" onclick="confirmModal('{{ url(route('admin.contacts.delete', $contact->id)) }}', responseHandler)"><i class="mdi mdi-delete" title="Delete"></i>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('backend.components.modal')
@endsection

@section('page.scripts')
<script>
    $(document).ready(function () {
        $('#contacts-table').DataTable();
    });

    var responseHandler = function(response) {
        console.log("Reloading the page"); // Debugging log
        window.location.reload(true); // Force reload
    };

</script>
@endsection
