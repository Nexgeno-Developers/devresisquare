<!-- resources/views/backend/properties/quick_form_components/step5.blade.php -->

@php $currentStep = 9 ; @endphp
<div class="container-fluid mt-4 quick_add_property">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_content_img">
                    <img src="{{ asset('asset/images/svg/pound.svg') }}" alt="Property Address">
                </div>
                <div class="left_title">
                    Property <span class="secondary-color">price</span><br /> and <span
                        class="secondary-color">availability</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="property-form-step-{{ $currentStep }}" method="POST" action="{{ route('admin.properties.quick_store') }}">
                @csrf
                <!-- Hidden field for property ID with isset check -->
                <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ (isset($property) ? $property->id : '') }}"> 
                <input type="hidden" name="step" value="4">
                <div class="right_content_wrapper" data-step-name="Property Address" data-step-number="{{ $currentStep }}">
                    <div class="form-group">
                        <label for="price">Sale Price</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">£</div>
                            <input type="text" name="price" id="price" class="form-control" value="{{ isset($property) && $property->price ? $property->price : '' }}" required>
                        </div>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="available_from">Date of Availability</label>
                        <input type="date" name="available_from" id="available_from" class="form-control"
                            value="{{ isset($property) && $property->available_from ? $property->available_from : '' }}" required>
                        @error('available_from')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary margin-top-5 mt-5 w-100 last-step-submit" data-current-step="{{ $currentStep }}">Submit</button>
            </form>
        </div>
    </div>
</div>