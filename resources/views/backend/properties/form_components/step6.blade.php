@php $currentStep = 6 ; @endphp
<!-- resources/views/backend/properties/form_components/step6.blade.php -->


<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Accessiblity</label>

    <div class="property-form-data-attribute" data-step-name="Accessiblity" data-step-number="{{ $currentStep }}" data-step-title="Accessiblity"></div>

    <div class="row h_100_vh">
        <div class="col-lg-6 col-12">

            <div class="steps_wrapper">
                <div class="form-group">
                    <x-backend.input-comp
                        class=""
                        inputOpt="input_custom_icon"
                        inputType="text"
                        rightIcon=""
                        inputName="station_name"
                        placeHolder="Station Name"
                        isLabel={{False}}
                        label="Nearest Station"
                        isDate={{false}}
                        isIcon={{true}}
                        iconName="bi-plus"
                        onIconClick="onIconClick"
                    />
                    @error('station_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul class="input_list_items">
                        <li><span>Bakerloo</span> <i class="bi bi-x-lg x_icon"></i> </li>
                        <li><span>Jubilee</span> <i class="bi bi-x-lg x_icon"></i></li>
                        <li><span>Northern</span> <i class="bi bi-x-lg x_icon"></i></li>
                    </ul>
                </div>
                <div class="form-group">
                    <x-backend.input-comp
                        class=""
                        inputOpt="input_custom_icon"
                        inputType="text"
                        rightIcon=""
                        inputName="school_name"
                        placeHolder="School Name"
                        isLabel={{False}}
                        label="Nearest School"
                        isDate={{false}}
                        isIcon={{true}}
                        iconName="bi-plus"
                        onIconClick="onIconClick"
                    />
                    @error('school_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul class="input_list_items">
                        <li><span>Hampton High</span> <i class="bi bi-x-lg x_icon"></i> </li>
                        <li><span>Tower House School</span> <i class="bi bi-x-lg x_icon"></i></li>
                    </ul>
                </div>
                <div class="form-group">
                    <x-backend.input-comp
                        class=""
                        inputOpt="input_custom_icon"
                        inputType="text"
                        rightIcon=""
                        inputName="relegious_places"
                        placeHolder="Relegious Places"
                        isLabel={{False}}
                        label="Nearest Relegious Places"
                        isDate={{false}}
                        isIcon={{true}}
                        iconName="bi-plus"
                        onIconClick="onIconClick"
                    />
                    @error('relegious_places')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul class="input_list_items">
                        <li><span>Tonbridge Street</span> <i class="bi bi-x-lg x_icon"></i> </li>
                        <li><span>East Sheen</span> <i class="bi bi-x-lg x_icon"></i></li>
                    </ul>
                </div>
                <div class="form-group">
                    <label for="usefull_info">Usefull Information</label>
                    <input type="text" name="usefull_info" id="usefull_info" class="form-control" value="">
                    @error('usefull_info')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="footer_btn">
                    <div class="row ">
                        <div class="col-6">
                            <button type="button" class="btn btn_outline_secondary w-100 previous-step" data-previous-step="{{ $currentStep - 1 }}" data-current-step="{{ $currentStep }}">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn_secondary w-100 next-step" data-next-step="{{ $currentStep + 1 }}" data-current-step="{{ $currentStep }}">Next</button>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</form>
