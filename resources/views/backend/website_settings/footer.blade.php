@extends('backend.layout.app')

@section('content')

<!-- Title Bar -->
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="h3">Website Footer</h1>
        </div>
    </div>
</div>

<!-- Footer Settings Section -->
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h6 class="fw-600 mb-0">Footer Widget</h6>
    </div>
    <div class="card-body">
        <div class="row gutters-10">
            <div class="col-lg-6">
                <!-- Contact Info Widget -->
                <div class="card shadow-none bg-light mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="mb-0">Invoice Info Widget</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Contact Address -->
                            <div class="form-group mb-3">
                                <label for="company_address">Contact Address</label>
                                <input type="hidden" name="types[]" value="company_address">
                                <input type="text" class="form-control" id="company_address" placeholder="Address" name="company_address" value="{{ get_setting('company_address', null) }}">
                            </div>

                            <!-- Contact Phone -->
                            <div class="form-group mb-3">
                                <label for="company_phone">Contact Phone</label>
                                <input type="hidden" name="types[]" value="company_phone">
                                <input type="text" class="form-control" id="company_phone" placeholder="Phone" name="company_phone" value="{{ get_setting('company_phone') }}">
                            </div>

                            <!-- Contact Email -->
                            <div class="form-group mb-3">
                                <label for="company_email">Contact Email</label>
                                <input type="hidden" name="types[]" value="company_email">
                                <input type="text" class="form-control" id="company_email" placeholder="Email" name="company_email" value="{{ get_setting('company_email') }}">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 float-end">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Contact Info Widget -->
                <div class="card shadow-none bg-light mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="mb-0">Contact Info Widget</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Contact Address -->
                            <div class="form-group mb-3">
                                <label for="contact_address">Contact Address</label>
                                <input type="hidden" name="types[]" value="contact_address">
                                <input type="text" class="form-control" id="contact_address" placeholder="Address" name="contact_address" value="{{ get_setting('contact_address', null) }}">
                            </div>

                            <!-- Contact Phone -->
                            <div class="form-group mb-3">
                                <label for="contact_phone">Contact Phone</label>
                                <input type="hidden" name="types[]" value="contact_phone">
                                <input type="text" class="form-control" id="contact_phone" placeholder="Phone" name="contact_phone" value="{{ get_setting('contact_phone') }}">
                            </div>

                            <!-- Contact Email -->
                            <div class="form-group mb-3">
                                <label for="contact_email">Contact Email</label>
                                <input type="hidden" name="types[]" value="contact_email">
                                <input type="text" class="form-control" id="contact_email" placeholder="Email" name="contact_email" value="{{ get_setting('contact_email') }}">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 float-end">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
