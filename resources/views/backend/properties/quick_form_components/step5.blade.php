<!-- resources/views/backend/properties/form_components/step1.blade.php -->

<div class="container-fluid mt-4 quick_add_property">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_content_img">
                    <img src="{{ asset('asset/images/svg/pound.svg') }}" alt="Property Address">
                </div>
                <div class="left_title">
                    Property <span class="secondary-color">price</span><br/> and <span class="secondary-color">availability</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="property-form-step-1"  method="POST" action="{{ route('admin.properties.store') }}">
                    <div class="right_content_wrapper" data-step-name="Property Address" data-step-number="1">
                    @csrf
                    <div class="form-group">
                        <label for="price">Sale Price</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">£</div>
                            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
                        </div>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


