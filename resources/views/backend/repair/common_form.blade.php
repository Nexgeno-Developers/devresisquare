<!-- resources/views/backend/repair/common_form.blade.php -->

<form id="repair-form">
    <!-- Textarea for description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" rows="4" name="description" required></textarea>
    </div>

    <!-- Multiple Image Select -->
    <div class="mb-3">
        <label for="images" class="form-label">Select Images</label>
        <input class="form-control" type="file" id="images" name="images[]" accept="image/*" multiple>
    </div>

    <!-- Hidden Fields -->
    <input type="hidden" id="property_id" name="property_id" value="">
    <input type="hidden" id="selected_categories" name="selected_categories" value="">
    <input type="hidden" id="last_selected_category" name="last_selected_category" value="">

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
