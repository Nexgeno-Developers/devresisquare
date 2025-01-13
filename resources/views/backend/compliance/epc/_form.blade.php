<form id='epc'>
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
        <label for="expiryDate" class="form-label">Expiry Date</label>
        <input type="date" class="form-control" id="expiryDate" name="expiryDate" required>
    </div>

    <!-- Image Upload Field -->
    <div class="mb-3">
        <label for="imageUpload" class="form-label">Upload EPC Image</label>
        <input type="file" class="form-control" id="imageUpload" name="imageUpload" accept="image/*" required>
    </div>

</form>
