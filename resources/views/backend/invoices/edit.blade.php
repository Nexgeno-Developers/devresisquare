@extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Edit Invoice #{{ $invoice->invoice_number }}</h2>

    <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Invoice Number -->
        <div class="mb-3">
            <label class="form-label">Invoice Number</label>
            <input type="text" name="invoice_number" class="form-control" value="{{ old('invoice_number', $invoice->invoice_number) }}" required>
        </div>

        <!-- Invoice Date -->
        <div class="mb-3">
            <label class="form-label">Invoice Date</label>
            <input type="date" name="invoice_date" class="form-control" value="{{ old('invoice_date', $invoice->invoice_date) }}" required>
        </div>

        <!-- Due Date -->
        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $invoice->due_date) }}" required>
        </div>

        <!-- Contact (Client) -->
        <div class="mb-3">
            <label class="form-label">Client</label>
            <select name="contact_id" class="form-control">
                @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}" {{ $invoice->contact_id == $contact->id ? 'selected' : '' }}>
                        {{ $contact->full_name }} ({{ $contact->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Invoice Items -->
        <h4>Invoice Items</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="invoice-items">
                @foreach($invoice->items as $index => $item)
                <tr>
                    <td><input type="text" name="items[{{ $index }}][description]" class="form-control" value="{{ $item->description }}" required></td>
                    <td><input type="number" name="items[{{ $index }}][unit_price]" class="form-control unit-price" value="{{ $item->unit_price }}" required></td>
                    <td><input type="number" name="items[{{ $index }}][quantity]" class="form-control quantity" value="{{ $item->quantity }}" required></td>
                    <td><input type="text" class="form-control total-price" value="{{ $item->total_price }}" readonly></td>
                    <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" id="add-item">Add Item</button>

        <!-- Notes -->
        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $invoice->notes) }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Invoice</button>
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function () {
        let index = document.querySelectorAll('#invoice-items tr').length;
        let row = `
            <tr>
                <td><input type="text" name="items[${index}][description]" class="form-control" required></td>
                <td><input type="number" name="items[${index}][unit_price]" class="form-control unit-price" required></td>
                <td><input type="number" name="items[${index}][quantity]" class="form-control quantity" required></td>
                <td><input type="text" class="form-control total-price" readonly></td>
                <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
            </tr>
        `;
        document.getElementById('invoice-items').insertAdjacentHTML('beforeend', row);
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            event.target.closest('tr').remove();
        }
    });
</script>
@endsection
