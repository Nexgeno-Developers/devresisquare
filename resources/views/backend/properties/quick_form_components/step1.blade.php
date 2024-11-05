<!-- resources/views/backend/properties/form_components/step1.blade.php -->

<div class="container-fluid mt-4 quick_add_property">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_content_img">
                    <img src="{{ asset('asset/images/svg/building.svg') }}" alt="">
                </div>
                <div class="left_title">
                    What is your<br/> <span class="secondary-color">property</span>  name?
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <div class="right_content_wrapper">
                <form id="property-form-step-1"  method="POST" action="{{ route('admin.properties.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="line_1" class="mb-2">Give a name to your property</label>
                        <input required type="text" name="line_1" id="line_1" class="form-control" value="{{ session('line_1') }}">
                        @error('line_1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-primary btn-sm next-step mt-2 w-50" data-next-step="2" data-current-step="1">Next</button>
                </form>
            </div>
        </div>
    </div>
</div>


