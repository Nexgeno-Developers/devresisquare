<!-- resources/views/backend/properties/form_components/step1.blade.php -->

<div class="container-fluid mt-4 quick_add_property">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_content_img">
                    <img src="{{ asset('asset/images/svg/pin.svg') }}" alt="Property Address">
                </div>
                <div class="left_title">
                    What<br/> <span class="secondary-color">type of property</span><br/> do you have?
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="property-form-step-1"  method="POST" action="{{ route('admin.properties.store') }}">
                    <div class="right_content_wrapper" data-step-name="Property Address" data-step-number="1">
                    @csrf
                    <div class="form-group">
                        <div class="radio_bts_square_icon">
                            <input type="radio" name="propertyType" id="propertyTypeApartment" value="apartment" {{ old('propertyType') == '1' ? 'checked="checked"' : '' }} /> 
                            <label for="propertyTypeApartment">
                                <img src="{{ asset('asset/images/svg/apartment_600.svg') }}" alt="apartment">  
                                Apartment  
                            </label>
                            <input type="radio" name="propertyType" id="propertyTypeFlat" value="flat" {{ old('propertyType') == '2' ? 'checked="checked"' : '' }} /> 
                            <label for="propertyTypeFlat"> 
                                <img src="{{ asset('asset/images/svg/flat_600.svg') }}" alt="flat">  
                                Flat  
                             </label>
                            <input type="radio" name="propertyType" id="propertyTypeBungalow" value="bunglow" {{ old('propertyType') == '3' ? 'checked="checked"' : '' }} /> 
                            <label for="propertyTypeBungalow"> 
                                <img src="{{ asset('asset/images/svg/bungalow_600.svg') }}" alt="bungalow">  
                                Bungalow  
                             </label>
                            <input type="radio" name="propertyType" id="propertyTypeHouse" value="house" {{ old('propertyType') == '4' ? 'checked="checked"' : '' }} /> 
                            <label for="propertyTypeHouse"> 
                                <img src="{{ asset('asset/images/svg/house_600.svg') }}" alt="house">  
                                House  
                             </label>
                        </div>
                        @error('reception')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-primary btn-sm next-step mt-2 w-50" data-next-step="2" data-current-step="1">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>


