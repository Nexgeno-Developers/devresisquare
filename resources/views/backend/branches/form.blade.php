<div class="form-group">
    <label for="name">Branch Name</label>
    <input type="text" name="name" id="name" class="form-control"
        value="{{ old('name', $branch->name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" id="address" class="form-control"
        value="{{ old('address', $branch->address ?? '') }}" >
</div>

<div class="form-group">
    <label for="city">City</label>
    <input type="text" name="city" id="city" class="form-control"
        value="{{ old('city', $branch->city ?? '') }}" >
</div>

<div class="form-group">
    <label for="postcode">Postcode</label>
    <input type="text" name="postcode" id="postcode" class="form-control"
        value="{{ old('postcode', $branch->postcode ?? '') }}" >
</div>

<div class="form-group">
    <label for="contact_email">Contact Email</label>
    <input type="email" name="contact_email" id="contact_email" class="form-control"
        value="{{ old('contact_email', $branch->contact_email ?? '') }}" >
</div>

<div class="form-group">
    <label for="contact_phone">Contact Phone</label>
    <input type="text" name="contact_phone" id="contact_phone" class="form-control"
        value="{{ old('contact_phone', $branch->contact_phone ?? '') }}" >
</div>

<button type="submit" class="btn btn_secondary">{{ $buttonText ?? 'Save' }}</button>
