<form id='epc'>
    @csrf
    <input type="hidden" name="property_id" class="form-control" value="">
    <input type="hidden" name="compliance_type_id" class="form-control" value="">
    <!-- Rating Field -->
    <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <select class="form-select" id="rating" name="rating" required>
            <option value="" selected disabled>Select Rating</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
        </select>
    </div>

    <!-- Expiry Date Field -->
    <div class="mb-3">
        <label for="expiry_date" class="form-label">Expiry Date</label>
        <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
    </div>

    <!-- Image Upload Field -->
    <div class="form-group rs_upload_btn">
        <h6 class="sub_title mt-4">Upload Image</h6>
        <div class="media_wrapper2">
            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                <label class="col-form-label" for="photos">Photos</label>
                <div class="d-none input-group-prepend">
                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                </div>
                <div class="d-none form-control file-amount">Choose File</div>
                <input id="photos" id="photos" type="hidden" name="photos" value="" class="selected-files">
            </div>
            <div class="d-flex gap-3 file-preview box sm">
            </div>
        </div>
    </div>

</form>
