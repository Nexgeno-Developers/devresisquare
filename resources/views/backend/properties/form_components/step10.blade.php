@php $currentStep = 10 ; @endphp
<!-- resources/views/backend/properties/form_components/step9.blade.php -->
<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">
    <input type="hidden" name="step" value="{{ $currentStep }}">

    <label class="main_title">Responsibility</label>

    <div class="row h_100_vh">
        <div class="col-lg-4 col-12">
            <div class="steps_wrapper property-form-data-attribute" data-step-name="Responsibility" data-step-number="{{ $currentStep }}" data-step-title="Responsibility">


                <div class="form-group">
                    <label for="user">User</label>
                    <select name="user_id[]" id="designation" class="form-control" required>
                        <option value="user1->id" >user1</option>
                        <option value="user2->id" >user2</option>
                        <option value="user3->id" >user3</option>
                        <option value="user4->id" >user4</option>
                    </select>
                    @error('designation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="designation">Designation</label>
                    <select name="designation_id[]" id="designation" class="form-control" required>
                        <option value="designation1->id" >designation1</option>
                        <option value="designation2->id" >designation2</option>
                        <option value="designation3->id" >designation3</option>
                        <option value="designation4->id" >designation4</option>
                    </select>
                    @error('designation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="branch">Branch</label>
                    <select name="branch[]" id="branch" class="form-control" required>
                        <option value="branch1->id">Branch1</option>
                        <option value="branch2->id">Branch2</option>
                        <option value="branch3->id">Branch3</option>
                        <option value="branch4->id">Branch4</option>
                    </select>
                    @error('branch')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="commission_percentage">Commission (%)</label>
                    <input required type="text" name="commission_percentage" id="commission_percentage" class="form-control" value="{{ (isset($property) && $property->commission_percentage) ? $property->commission_percentage : '' }}">
                    @error('commission_percentage')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="commission_amount">Commission (£)</label>
                    <div class="price_input_wrapper">
                        <div class="pound_sign">£</div>
                        <input required type="text" name="commission_amount" id="commission_amount" class="form-control" value="{{ (isset($property) && $property->commission_amount) ? $property->commission_amount : '' }}">
                    </div>
                    @error('commission_amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="footer_btn">
                    <div class="row ">
                        <div class="col-6">
                            <button type="button" class="btn btn_outline_secondary w-100 previous-step" data-previous-step="{{ $currentStep - 1 }}" data-current-step="{{ $currentStep }}">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn_secondary w-100 last-step-submit" data-current-step="{{ $currentStep }}">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
