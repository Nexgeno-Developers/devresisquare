@php $currentStep = 6 ; @endphp
<!-- resources/views/backend/properties/form_components/step6.blade.php -->


<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Accessiblity</label>

    <div class="property-form-data-attribute" data-step-name="Accessiblity" data-step-number="{{ $currentStep }}" data-step-title="Accessiblity"></div>

    <div class="row">
        <div class="col-lg-6 col-12">

            <div class="steps_wrapper">
                <div class="">
                    <div class="rs_sub_title">Nearest Station</div>
                    Bakerloo, Jubilee Victoria, Northern
                </div>
                <div class="">
                    <div class="rs_sub_title">Nearest School</div>
                    
                </div>
                <div class="">
                    <div class="rs_sub_title">Nearest Relegious Places</div>
                    
                </div>
                <div class="form-group">
                    <label for="usefull_info">Usefull Information</label>
                    <input type="text" name="usefull_info" id="usefull_info" class="form-control" value="">
                    @error('usefull_info')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn_outline_secondary w-100 previous-step" data-previous-step="{{ $currentStep - 1 }}" data-current-step="{{ $currentStep }}">Previous</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn_secondary w-100 next-step" data-next-step="{{ $currentStep + 1 }}" data-current-step="{{ $currentStep }}">Next</button>
                </div> 
            </div> 
        </div> 
    </div> 
</form>
