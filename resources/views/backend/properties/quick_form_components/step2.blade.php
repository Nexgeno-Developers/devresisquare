<!-- resources/views/backend/properties/quick_form_components/step2.blade.php -->

<div class="container-fluid mt-4 quick_add_property">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_content_img">
                    <img src="{{ asset('asset/images/svg/pin.svg') }}" alt="Property Address">
                </div>
                <div class="left_title">
                    Where is your<br /> <span class="secondary-color">property</span>?
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="property-form-step-2" method="POST" action="{{ route('admin.properties.quick_store') }}">
                <div class="right_content_wrapper" data-step-name="Property Address" data-step-number="2">
                    <input type="hidden" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">
                    @csrf
                    <div class="form-group">
                        <label for="line_1">Address Line 1</label>
                        <input required type="text" name="line_1" id="line_1" class="form-control"
                            value="{{ (isset($property) && $property->line_1) ? $property->line_1 : '' }}">
                        @error('line_1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="line_2">Address Line 2</label>
                        <input type="text" name="line_2" id="line_2" class="form-control"
                            value="{{ (isset($property) && $property->line_2) ? $property->line_2 : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input required type="text" name="city" id="city" class="form-control"
                            value="{{ (isset($property) && $property->city) ? $property->city : '' }}">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input required type="text" name="country" id="country" class="form-control"
                            value="{{ (isset($property) && $property->country) ? $property->country : '' }}">
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input required type="text" name="postcode" id="postcode" class="form-control"
                            value="{{ (isset($property) && $property->postcode) ? $property->postcode : '' }}">
                        @error('postcode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-secondary previous-step mt-2 w-100" data-previous-step="1"
                            data-current-step="2">Previous</button>
                        <button type="button" class="btn btn-primary btn-sm next-step mt-2 w-100" data-next-step="3"
                            data-current-step="2">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>