<!-- resources/views/backend/properties/form_components/step8.blade.php -->
<form id="property-form-step-8" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <label class="main_title">Media</label>

    <div class="steps_wrapper" data-step-name="Media" data-step-number="8" data-step-title="Media">
        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">Photos</h5>
            <div class="media_wrapper">
                <div class="media_content">
                    <div class="image_wrapper">
                        <!-- NOTE: Repeater from here -->
                        <div class="media_images">
                            <div class="delete_image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </div>
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.thepinnaclelist.com%2Fwp-content%2Fuploads%2F2022%2F09%2FProperty-Valuation-Services.jpg" alt="">
                        </div>
                        <div class="media_images">
                            <div class="delete_image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </div>
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.thepinnaclelist.com%2Fwp-content%2Fuploads%2F2022%2F09%2FProperty-Valuation-Services.jpg" alt="">
                        </div>
                        <!-- NOTE: Repeater to here -->
                    </div>
                </div>
                <div class="media_upload">
                    <label for="photos">Upload Photos</label>
                    <input type="file" name="photos[]" id="photos" class="form-control" multiple>
                    @error('photos.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">Floor Plan</h5>
            <div class="media_wrapper">
                <div class="media_content">
                    <div class="image_wrapper">
                        <!-- NOTE: Repeater from here -->
                        <div class="media_images">
                            <div class="delete_image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </div>
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.thepinnaclelist.com%2Fwp-content%2Fuploads%2F2022%2F09%2FProperty-Valuation-Services.jpg" alt="">
                        </div>
                        <div class="media_images">
                            <div class="delete_image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </div>
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.thepinnaclelist.com%2Fwp-content%2Fuploads%2F2022%2F09%2FProperty-Valuation-Services.jpg" alt="">
                        </div>
                        <!-- NOTE: Repeater to here -->
                    </div>
                </div>
                <div class="media_upload">
                    <label for="floor_plan">Upload Floor Plan</label>
                    <input type="file" name="floor_plan" id="floor_plan" class="form-control">
                    @error('floor_plan')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">306 View</h5>
            <div class="media_wrapper">
                <div class="media_content">
                    <div class="image_wrapper">
                        <!-- NOTE: Repeater from here -->
                        <div class="media_images">
                            <div class="delete_image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </div>
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.thepinnaclelist.com%2Fwp-content%2Fuploads%2F2022%2F09%2FProperty-Valuation-Services.jpg" alt="">
                        </div>
                        <div class="media_images">
                            <div class="delete_image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </div>
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.thepinnaclelist.com%2Fwp-content%2Fuploads%2F2022%2F09%2FProperty-Valuation-Services.jpg" alt="">
                        </div>
                        <!-- NOTE: Repeater to here -->
                    </div>
                </div>
                <div class="media_upload">
                    <label for="view_360">Upload 360 View</label>
                    <input type="file" name="view_360" id="view_360" class="form-control">
                    @error('view_360')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group rs_upload_btn">
            <h5 class="sub_title mt-4">Video URL</h5>
            <label for="video_url">Video URL</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}">
            @error('video_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-secondary w-100 previous-step" data-previous-step="7">Previous</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-primary w-100 next-step" data-next-step="9">Next</button>
        </div> 
    </div> 
</form>
