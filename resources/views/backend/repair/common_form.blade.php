<!-- resources/views/backend/repair/common_form.blade.php -->

<form id="repair-form">
    <!-- Textarea for description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" rows="4" name="description" required></textarea>
    </div>

    {{-- <!-- Multiple Image Select -->
    <div class="mb-3">
        <label for="images" class="form-label">Select Images</label>
        <input class="form-control" type="file" id="images" name="images[]" accept="image/*" multiple>
    </div> --}}

    <div class="form-group rs_upload_btn">
        <h5 class="sub_title mt-4">Select images</h5>
        <div class="media_wrapper">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                <label for="view_360">Upload Photos</label>
                <div class="d-none input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                </div>
                <div class="d-none form-control file-amount">Choose File</div>
                <input type="hidden" id="view_360" name="view_360" class="selected-files">
            </div>
            <div class="d-flex gap-3 file-preview box sm">
            </div>
        </div>
    </div>

    <!-- Hidden Fields -->
    <input type="hidden" id="property_id" name="property_id" value="">
    <input type="hidden" id="selected_categories" name="selected_categories" value="">
    <input type="hidden" id="last_selected_category" name="last_selected_category" value="">

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
