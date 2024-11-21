<!-- resources/views/backend/properties/quick_form_components/step2.blade.php -->
@php $currentStep = 1 ; @endphp
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
            <form id="property-form-step-{{$currentStep}}" method="POST" action="{{ route('admin.properties.quick_store') }}">
                @csrf
                <!-- Hidden field for property ID with isset check -->
                <input type="hidden" id="property_id" class="property_id" name="property_id"
                    value="{{ (isset($property) ? $property->id : '') }}">
                <div data-step-name="Property Address" data-step-number="{{$currentStep}}"></div>
                <div class="right_content_wrapper">
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
                </div>
                <button type="button" class="btn btn-primary btn-sm next-step mt-2 w-50" data-next-step="{{$currentStep+1}}"
                    data-current-step="{{$currentStep}}">Next</button>

            </form>
        </div>
    </div>
</div>