<!-- resources/views/backend/properties/form_components/step8.blade.php -->
<form id="property-form-step-8" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}"
    enctype="multipart/form-data">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id"
        value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Media</label>

    <div class="steps_wrapper" data-step-name="Media" data-step-number="8" data-step-title="Media">

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">Photos</h5>
            <div class="media_wrapper">
                <div class="media_content">
                    <div class="image_wrapper">
                        <!-- Preview images will be dynamically added here -->
                    </div>
                <div class="media_upload">
                    <label for="photos">Upload Photos</label>
                    <input type="file" name="photos[]" id="photos" class="form-control" multiple accept="image/*"
                        onchange="previewMultipleImage(this)">
                    @error('photos.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                @if($property && $property->photos)
                    @foreach(json_decode($property->photos) as $photoPath)
                        <img src="{{ asset('storage/' . $photoPath) }}" alt="Uploaded Photo" width="100">
                    @endforeach
                @endif
            </div>
            </div>
        </div>

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">Floor Plan</h5>
            <div class="media_wrapper">
                <div class="media_upload">
                    <label for="floor_plan">Upload Floor Plan Photos</label>
                    <input type="file" name="floor_plan[]" id="floor_plan" class="form-control" multiple accept="image/*"
                        onchange="previewMultipleImage(this)">
                    @error('floor_plan.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="media_content">
                    <div class="image_wrapper">
                        <!-- Preview images will be dynamically added here -->
                    </div>
                </div>
                @if($property && $property->floor_plan)
                    @foreach(json_decode($property->floor_plan) as $floor_planPath)
                        <img src="{{ asset('storage/' . $floor_planPath) }}" alt="Uploaded Photo" width="100">
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">View 360</h5>
            <div class="media_wrapper">
                <div class="media_upload">
                    <label for="view_360">Upload 360 View Photos</label>
                    <input type="file" name="view_360[]" id="view_360" class="form-control" multiple accept="image/*"
                        onchange="previewMultipleImage(this)">
                    @error('view_360.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="media_content">
                    <div class="image_wrapper">
                        <!-- Preview images will be dynamically added here -->
                    </div>
                </div>
                @if($property && $property->view_360)
                    @foreach(json_decode($property->view_360) as $view_360Path)
                        <img src="{{ asset('storage/' . $view_360Path) }}" alt="Uploaded Photo" width="100">
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">Video URL</h5>
            <label for="video_url">Video URL</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ isset($property) && $property->video_url ?? $property->video_url }}">
            @error('video_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-secondary w-100 previous-step" data-previous-step="7"
                    data-current-step="8">Previous</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-primary w-100 next-step" data-next-step="9"
                    data-current-step="8">Next</button>
            </div>
        </div>
</form>