{{-- @extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Create Owner Group</h2> --}}
        <!-- Original Form (Step 1) -->

        <!-- Main Form (Step 1) -->
        <div id="mainForm">
            <form action="{{ route('admin.owner-groups.store') }}" method="POST">
              @csrf
              <input type="hidden" name="property_id" class="form-control" value="">

              <div class="form-group">
                <button type="button" class="btn btn-outline-primary btn-sm" id="addContactBtn">
                  Add New Contact
                </button>
                <label for="contact_id">Contact</label>
                <select name="contact_id" id="contact_id" class="form-control" required>
                  @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="purchased_date">Purchased Date</label>
                    <input type="date" name="purchased_date" id="purchased_date" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="sold_date">Sold Date</label>
                    <input type="date" name="sold_date" id="sold_date" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="archived_date">Archived Date</label>
                    <input type="date" name="archived_date" id="archived_date" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                      <option value="archived">Archived</option>
                    </select>
                  </div>
                </div>
              </div>

              <button type="submit" class="float-end mt-3 btn btn-secondary">Save</button>
            </form>
          </div>

          <!-- Add Contact Form (Step 2) -->
          <div id="addContactFormContainer" style="display: none;">
            <form id="addContactForm">
              @csrf
              <div class="mb-3">
                    <label for="contact_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="contact_name" name="full_name" required>
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="contact_email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="contact_phone" name="phone" required>
                </div>
              <button type="submit" class="btn btn-primary">Save Contact</button>
              <button type="button" class="btn btn-secondary" id="backToMainForm">Back</button>
            </form>
          </div>
{{-- </div>
@endsection --}}
