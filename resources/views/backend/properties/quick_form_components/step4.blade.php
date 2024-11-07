<!-- resources/views/backend/properties/form_components/step1.blade.php -->

<div class="container-fluid mt-4 quick_add_property">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_content_img">
                    <img src="{{ asset('asset/images/svg/sofa.svg') }}" alt="Property Address">
                </div>
                <div class="left_title">
                    How many <span class="secondary-color">rooms</span><br/> do you have?
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="property-form-step-1"  method="POST" action="{{ route('admin.properties.store') }}">
                    <div class="right_content_wrapper" data-step-name="Property Address" data-step-number="1">
                    @csrf
                    <div class="">
                        <div class="">Bedrooms</div>
                        <div class="radio_bts_square">
                            <input type="radio" name="bedrooms" id="bedrooms1" value="1" {{ old('bedrooms') == '1' ? 'checked="checked"' : '' }} /> 
                            <label for="bedrooms1"> 1 </label>
                            <input type="radio" name="bedrooms" id="bedrooms2" value="2" {{ old('bedrooms') == '2' ? 'checked="checked"' : '' }} /> 
                            <label for="bedrooms2"> 2 </label>
                            <input type="radio" name="bedrooms" id="bedrooms3" value="3" {{ old('bedrooms') == '3' ? 'checked="checked"' : '' }} /> 
                            <label for="bedrooms3"> 3 </label>
                            <input type="radio" name="bedrooms" id="bedrooms4" value="4" {{ old('bedrooms') == '4' ? 'checked="checked"' : '' }} /> 
                            <label for="bedrooms4"> 4 </label>
                            <input type="radio" name="bedrooms" id="bedrooms5" value="5" {{ old('bedrooms') == '5' ? 'checked="checked"' : '' }} /> 
                            <label for="bedrooms5"> 5 </label>
                            <input type="radio" name="bedrooms" id="bedrooms6" value="6+" {{ old('bedrooms') == '6+' ? 'checked="checked"' : '' }} /> 
                            <label for="bedrooms6">6+</label>
                        </div>
                        @error('reception')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <div class="">Reception Rooms</div>
                        <div class="radio_bts_square">
                            <input type="radio" name="reception" id="reception1" value="1" {{ old('reception') == '1' ? 'checked="checked"' : '' }} /> 
                            <label for="reception1"> 1 </label>
                            <input type="radio" name="reception" id="reception2" value="2" {{ old('reception') == '2' ? 'checked="checked"' : '' }} /> 
                            <label for="reception2"> 2 </label>
                            <input type="radio" name="reception" id="reception3" value="3" {{ old('reception') == '3' ? 'checked="checked"' : '' }} /> 
                            <label for="reception3"> 3 </label>
                            <input type="radio" name="reception" id="reception4" value="4" {{ old('reception') == '4' ? 'checked="checked"' : '' }} /> 
                            <label for="reception4"> 4 </label>
                            <input type="radio" name="reception" id="reception5" value="5" {{ old('reception') == '5' ? 'checked="checked"' : '' }} /> 
                            <label for="reception5"> 5 </label>
                            <input type="radio" name="reception" id="reception6" value="6+" {{ old('reception') == '6+' ? 'checked="checked"' : '' }} /> 
                            <label for="reception6">6+</label>
                        </div>
                        @error('reception')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


