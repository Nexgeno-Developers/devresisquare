<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property; // Make sure to import the Property model
use Illuminate\Support\Facades\Auth;

class PropertyController
{
    public function index()
    {
        $properties = Property::all(); // Fetch all properties
        return view('backend.properties.index', compact('properties'));
    }
    
    // Show the form for creating a new property.
    public function create()
    {
        return view('backend.properties.create'); // Return the create property view
    }

    public function store(Request $request)
    {
        // Validate and save property
        $validatedData = $request->validate([
            'prop_name' => 'required|string|max:255',
            'line_1' => 'required|string|max:255',
            'line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'property_type' => 'required|string',
            'transaction_type' => 'required|string',
            'specific_property_type' => 'required|string',
            'bedroom' => 'required|string',
            'bathroom' => 'required|string',
            'reception' => 'required|string',
            'service' => 'nullable|string',
            'price' => 'required|numeric',
            'available_from' => 'required|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        // Create property with the authenticated user ID
        Property::create(array_merge($validatedData, ['added_by' => Auth::id()]));

        return redirect()->route('admin.properties.index')->with('success', 'Property added successfully.');
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id); // Fetch property by ID
        return view('backend.properties.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update property
        $validatedData = $request->validate([
            'prop_name' => 'required|string|max:255',
            'line_1' => 'required|string|max:255',
            'line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'property_type' => 'required|string',
            'transaction_type' => 'required|string',
            'specific_property_type' => 'required|string',
            'bedroom' => 'required|string',
            'bathroom' => 'required|string',
            'reception' => 'required|string',
            'service' => 'nullable|string',
            'price' => 'required|numeric',
            'available_from' => 'required|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        $property = Property::findOrFail($id);
        $property->update($validatedData); // Update the property

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Use soft delete
        $property->deleted_by = Auth::id(); // Set the user who deleted the property
        $property->save(); // Save changes
        $property->delete(); // Perform the soft delete

        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
