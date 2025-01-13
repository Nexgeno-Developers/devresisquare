<form>
    <!-- Expiry Date Field -->
    <div class="mb-3">
        <label for="expiryDate" class="form-label">Expiry Date</label>
        <input type="date" class="form-control" id="expiryDate" name="expiryDate" required>
    </div>

    <!-- Image Upload Field -->
    <div class="mb-3">
        <label for="imageUpload" class="form-label">Upload EPC Image</label>
        <input type="file" class="form-control" id="imageUpload" name="imageUpload" accept="image/*" required>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary me-2">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
</form>
