<!-- resources/views/backend/contacts/edit.blade.php -->
@extends('backend.layout.app')

@section('content')
<div class="container">
    <!-- Include the step add form -->
    @include('backend.contacts.contact_form.form', ['contact' => $contact])
</div>
@endsection
{{--
@extends('backend.layout.app')

@section('content')
    <div class="container-fluid">
        <h1>Edit Contact</h1>
        <form class="contact-edit-form" action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $contact->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $contact->first_name }}"
                            required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" value="{{ $contact->middle_name }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $contact->last_name }}"
                            required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" name="phone"
                            value="{{ $contact->phone }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $contact->email }}" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_line_1">Address Line 1</label>
                        <input type="text" class="form-control" name="address_line_1"
                            value="{{ $contact->address_line_1 }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_line_2">Address Line 2</label>
                        <input type="text" class="form-control" name="address_line_2"
                            value="{{ $contact->address_line_2 }}">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" name="postcode" value="{{ $contact->postcode }}"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" value="{{ $contact->city }}" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ $contact->country }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1" {{ $contact->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$contact->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@section('page.scripts')
    <script>
        $(document).ready(function() {
            $("button[type='submit']").on('click', function(e) {
                initValidate('.contact-edit-form');
            });
        });
    </script>
@endsection --}}
