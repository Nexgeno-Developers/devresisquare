<!-- resources/views/backend/properties/form_components/step8.blade.php -->
<form id="property-form-step-8" method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <div class="property-form-data-attribute" data-step-name="Media" data-step-number="8" data-step-title="Media">
        <h3>Media</h3>
    </div>
    
    <div class="form-group">
        <label for="photos">Upload Photos</label>
        <input type="file" name="photos[]" id="photos" class="form-control" multiple>
        @error('photos.*')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="floor_plan">Upload Floor Plan</label>
        <input type="file" name="floor_plan" id="floor_plan" class="form-control">
        @error('floor_plan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="view_360">Upload 360 View</label>
        <input type="file" name="view_360" id="view_360" class="form-control">
        @error('view_360')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="video_url">Video URL</label>
        <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}">
        @error('video_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="button" class="btn btn-secondary previous-step" data-previous-step="7">Previous</button>
    <button type="button" class="btn btn-primary next-step" data-next-step="9">Next</button>
</form>
