<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tenancy;
use App\Models\Property;
use App\Models\Offer;
use App\Models\Contact;
use Illuminate\Http\Request;

class TenancyController
{


    // Display a list of all active tenancies for a specific property
    public function index($propertyId)
    {
        $tenancies = Tenancy::where('property_id', $propertyId)
            ->where('status', 'Active')
            ->get();

        return view('backend.properties.tabs.tenancy', compact('tenancies', 'propertyId'));
    }

    // Show the form for creating a new tenancy
    public function create()
    {
        // $contacts = Contact::all();
        // Get contacts where category_id is 3 (Tenant)
        $tenants = Contact::where('category_id', 3)->get();
        // Get contacts where category_id is 2 (Property Manager)
        $property_managers = Contact::where('category_id', 2)->get();
        return view('backend.tenancies.create', compact( 'tenants','property_managers'));
    }

    // Store a newly created tenancy
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'offer_id' => 'required|exists:offers,id',
            'sub_status' => 'nullable|string|max:255',
            'move_in' => 'required|date',
            'move_out' => 'nullable|date',
            'tenancy_length' => 'nullable|integer',
            'extension_date' => 'nullable|date',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'frequency' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive', // Assuming status is either Active or Inactive
        ]);

        // Create a new tenancy
        Tenancy::create($validated);

        // Redirect back with success message
        return redirect()->route('tenancies.index')->with('success', 'Tenancy created successfully!');
    }

    // Display the specified tenancy
    public function show($id)
    {
        $tenancy = Tenancy::findOrFail($id);
        return view('backend.tenancies.show', compact('tenancy'));
    }

    // Show the form for editing the specified tenancy
    public function edit($id)
    {
        $tenancy = Tenancy::findOrFail($id);
        $contacts = Contact::all();
        // Get contacts where category_id is 2 (Property Manager)
        $property_managers = Contact::where('category_id', 2)->get();
        return view('backend.tenancies.edit', compact('tenancy',  'contacts', 'property_managers'));
    }

    // Update the specified tenancy
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'sub_status' => 'nullable|string|max:255',
            'move_in' => 'required|date',
            'move_out' => 'nullable|date',
            'tenancy_length' => 'nullable|integer',
            'extension_date' => 'nullable|date',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'frequency' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Find the tenancy and update it
        $tenancy = Tenancy::findOrFail($id);
        $tenancy->update($validated);

        // Redirect back with success message
        // return redirect()->route('tenancies.index')->with('success', 'Tenancy updated successfully!');

        flash("Tenancy Updated successfully!")->success();
        return back();
    }

    // Remove the specified tenancy from storage
    public function destroy($id)
    {
        $tenancy = Tenancy::findOrFail($id);
        $tenancy->delete();

        return redirect()->route('tenancies.index')->with('success', 'Tenancy deleted successfully!');
    }
}
