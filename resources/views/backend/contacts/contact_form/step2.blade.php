<!-- resources/views/backend/properties/quick_form_components/step3.blade.php -->
@php $currentStep = 2 ; @endphp
<div class="container-fluid mt-4 quick_add_contact">
    <div class="row contact_type_wrapper">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_title">
                    Write<br /> <span class="secondary-color">Personal Information</span><br /> for this contact
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="contact-form-step-{{ $currentStep }}" method="POST" action="{{ route('admin.contacts.store') }}">
                @csrf
                <!-- Hidden field for contact ID with isset check -->
                <input type="hidden" id="contact_id" class="contact_id" name="contact_id" value="{{ isset($contact) ? $contact->id : '' }}">
                <div class="steps_wrapper">
                    <div class="row">
                        <div class="col-md-10 col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input required type="text" name="first_name" id="first_name"
                                            class="form-control"
                                            value="{{ isset($contact) && $contact->first_name ? $contact->first_name : '' }}">
                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input required type="text" name="last_name" id="last_name"
                                            class="form-control"
                                            value="{{ isset($contact) && $contact->last_name ? $contact->last_name : '' }}">
                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input required type="number" pattern="[0-9]*" inputmode="numeric"
                                            name="phone" id="phone" class="form-control"
                                            value="{{ isset($contact) && $contact->phone ? $contact->phone : '' }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input required type="email" name="email" id="email"
                                            class="form-control"
                                            value="{{ isset($contact) && $contact->email ? $contact->email : '' }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address_line_1">Address Line 1</label>
                                <input required type="text" name="address_line_1" id="address_line_1"
                                    class="form-control"
                                    value="{{ isset($contact) && $contact->address_line_1 ? $contact->address_line_1 : '' }}">
                                @error('address_line_1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="address_line_2">Address Line 2</label>
                                        <input type="text" name="address_line_2" id="address_line_2"
                                            class="form-control"
                                            value="{{ isset($contact) && $contact->address_line_2 ? $contact->address_line_2 : '' }}">
                                        @error('address_line_2')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input required type="text" name="city" id="city"
                                            class="form-control"
                                            value="{{ isset($contact) && $contact->city ? $contact->city : '' }}">
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-8 col-12">
                                    <label for="country">Country</label>
                                    <input required type="text" name="country" id="country" class="form-control"
                                        value="{{ isset($contact) && $contact->country ? $contact->country : '' }}">
                                    @error('country')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="postcode">Postcode</label>
                                    <input required type="text" name="postcode" id="postcode"
                                        class="form-control"
                                        value="{{ isset($contact) && $contact->postcode ? $contact->postcode : '' }}">
                                    @error('postcode')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="footer_btn">
                                <div class="row mt-lg-4">
                                    <div class="col-6">
                                        <button type="button"
                                            class="btn btn_outline_secondary previous-step mt-2 w-100"
                                            data-previous-step="{{ $currentStep - 1 }}"
                                            data-current-step="{{ $currentStep }}">Previous</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn_secondary btn-sm next-step mt-2 w-100"
                                            data-next-step="{{ $currentStep + 1 }}"
                                            data-current-step="{{ $currentStep }}">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
