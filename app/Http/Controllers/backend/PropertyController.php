<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Property;
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
        // Validate data based on the current step
        if ($request->has('step')) {
            // Validate the request data
            $validatedData = $request->validate($this->getValidationRules($request->step));
    
            // Store data in session
            $request->session()->put($request->except('_token', 'step'));
    
            // Check if property_id is provided in the request
            if ($request->has('property_id')) {
                $property = Property::find($request->property_id);
                if ($property) {
                    // Log the data before updating
                    \Log::info('Updating property with ID ' . $request->property_id, $validatedData);
                    $property->update($validatedData);
                }
            } else {
                // Create new property only on the first step
                if ($request->step == 1) {
                    // Log the data before creation
                    \Log::info('Creating new property', $validatedData);
                    $property = Property::create(array_merge($validatedData, ['added_by' => Auth::id()]));
                    $request->session()->put('property_id', $property->id);
                }
            }
    
            // Load the next step view
            return view('backend.properties.form_components.step' . ($request->step + 1));
        } else {
            // Handle final submission when no step is present
            return redirect()->route('admin.properties.index')->with('success', 'Property Added/Updated successfully!');
        }
    }
    


    // public function store(Request $request)
    // {
    //     // Validate data based on the current step
    //     if ($request->has('step')) {
    //        $validatedData = $this->validate($request, $this->getValidationRules($request->step));

    //         // Store data in session
    //         $request->session()->put($request->except('_token', 'step')); // Store all data except CSRF token and step

    //         // Load the next step view
    //         return view('backend.properties.form_components.step' . ($request->step + 1)); // Load next step
    //     } else {

    //         // Create property with the authenticated user ID
    //         Property::create(array_merge($validatedData, ['added_by' => Auth::id()]));

    //         return redirect()->route('admin.properties.index')->with('success', 'Property Added successfully!');
    //     }

    // }

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

    private function getValidationRules($step)
    {
        switch ($step) {
            case 1:
                return [
                    'prop_name' => 'required|string|max:255',
                    'line_1' => 'required|string|max:255',
                    'line_2' => 'nullable|string|max:255',
                    'city' => 'required|string|max:100',
                    'country' => 'required|string|max:100',
                    'postcode' => 'required|string|max:20',
                ];
            case 2:
                return [
                    'property_type' => 'required|string',
                    'transaction_type' => 'required|string',
                    'specific_property_type' => 'required|string',
                ];
            case 3:
                return [
                    'bedroom' => 'required|string',
                    'bathroom' => 'required|string',
                    'reception' => 'required|string',
                    
                ];
            case 4:
                return [
                    'service' => 'nullable|string',
                    'price' => 'required|numeric',
                    'available_from' => 'required|date',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'status' => 'nullable|string',
                ];
            case 5:
                return [
                    'bedroom' => 'required|string',
                    'bathroom' => 'required|string',
                    'reception' => 'required|string',
                    'service' => 'nullable|string',
                    'price' => 'required|numeric',
                    'available_from' => 'required|date',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'status' => 'nullable|string',
                ];
            case 6:
                return [
                    'bedroom' => 'required|string',
                    'bathroom' => 'required|string',
                    'reception' => 'required|string',
                    'service' => 'nullable|string',
                    'price' => 'required|numeric',
                    'available_from' => 'required|date',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'status' => 'nullable|string',
                ];
            case 7:
                return [
                    'bedroom' => 'required|string',
                    'bathroom' => 'required|string',
                    'reception' => 'required|string',
                    'service' => 'nullable|string',
                    'price' => 'required|numeric',
                    'available_from' => 'required|date',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'status' => 'nullable|string',
                ];
            case 8:
                return [
                    'bedroom' => 'required|string',
                    'bathroom' => 'required|string',
                    'reception' => 'required|string',
                    'service' => 'nullable|string',
                    'price' => 'required|numeric',
                    'available_from' => 'required|date',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'status' => 'nullable|string',
                ];
            case 9:
                return [
                    'bedroom' => 'required|string',
                    'bathroom' => 'required|string',
                    'reception' => 'required|string',
                    'service' => 'nullable|string',
                    'price' => 'required|numeric',
                    'available_from' => 'required|date',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'status' => 'nullable|string',
                ];
            default:
                return [];
        }
    }
}