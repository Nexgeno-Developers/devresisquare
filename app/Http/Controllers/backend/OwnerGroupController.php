<?php

namespace App\Http\Controllers\backend;

use App\Models\OwnerGroup;
use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\Request;

class OwnerGroupController
{
    /**
     * Display a listing of the OwnerGroup.
     */
    public function index()
    {
        $ownerGroups = OwnerGroup::with('contact', 'property')->get();
        return view('backend.owner_groups.index', compact('ownerGroups'));
    }

    /**
     * Show the form for creating a new OwnerGroup.
     */
    public function create()
    {
        $contacts = Contact::all();
        $properties = Property::all();
        return view('backend.owner_groups.create', compact('contacts', 'properties'));
    }

    public function createGroup()
    {
        $contacts = Contact::all();
        $properties = Property::all();
        return view('backend.owner_groups.create-group', compact('contacts', 'properties'));
    }

    /**
     * Store a newly created OwnerGroup in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'property_id' => 'required|exists:properties,id',
            'purchased_date' => 'required|date',
            'sold_date' => 'nullable|date',
            'archived_date' => 'nullable|date',
            'status' => 'required|string|max:255',
        ]);

        OwnerGroup::create($validatedData);
        flash("Owner Group created successfully!")->success();
        return back();
    }

    public function storeGroup(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'contact_id' => 'required|array',
            'contact_id.*' => 'exists:contacts,id',
            'property_id' => 'required|exists:properties,id', // Ensure that the property_id exists
            'purchased_date' => 'required|date',
            'status' => 'required|in:active,inactive,archived',
        ]);

        // Convert contact IDs to a comma-separated string or JSON, depending on your choice
        $contactIds = implode(',', $validated['contact_id']); // Comma-separated list

        // Create a new OwnerGroup record using Eloquent
        OwnerGroup::create([
            'property_id' => $validated['property_id'],
            'contact_ids' => $contactIds, // Store contact IDs as a string or JSON
            'purchased_date' => $validated['purchased_date'],
            'sold_date' => $request->sold_date, // optional
            'archived_date' => $request->archived_date, // optional
            'status' => $validated['status'],
        ]);

        // Provide a success message
        flash("Owner Group created successfully!")->success();

        // Redirect back
        return back();
    }


    /**
     * Display the specified OwnerGroup.
     */
    public function show($id)
    {
        $ownerGroup = OwnerGroup::with('contact', 'property', 'estateCharges')->findOrFail($id);
        return view('backend.owner_groups.show', compact('ownerGroup'));
    }

    /**
     * Show the form for editing the specified OwnerGroup.
     */
    public function edit($id)
    {
        $ownerGroup = OwnerGroup::findOrFail($id);
        $contacts = Contact::all();
        $properties = Property::all();
        return view('backend.owner_groups.edit', compact('ownerGroup', 'contacts', 'properties'));
    }

    /**
     * Update the specified OwnerGroup in storage.
     */
    public function update(Request $request, $id)
    {
        $ownerGroup = OwnerGroup::findOrFail($id);

        $validatedData = $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'property_id' => 'required|exists:properties,id',
            'purchased_date' => 'required|date',
            'sold_date' => 'nullable|date',
            'archived_date' => 'nullable|date',
            'status' => 'required|string|max:255',
        ]);

        $ownerGroup->update($validatedData);
        // $response = [
        //     'status' => true,
        //     'notification' => 'Owner Group Deleted successfully!',
        // ];

        // return response()->json($response);
        // return back()->with('success', 'Owner Group deleted successfully');

        flash('Owner Group Updated successfully!')->success();
        return back();

        // return redirect()->route('owner_groups.index')->with('success', 'Owner Group updated successfully');
    }

    /**
     * Remove the specified OwnerGroup from storage.
     */
    public function destroy($id)
    {
        $ownerGroup = OwnerGroup::findOrFail($id);
        $ownerGroup->delete();
        // Return response
        $response = [
            'status' => true,
            'notification' => 'Owner Group Deleted successfully!',
        ];

        return response()->json($response);
        // return back()->with('success', 'Owner Group deleted successfully');

        // flash('Owner Group deleted successfully!')->success();
        // return back();
        // return redirect()->route('owner_groups.index')->with('success', 'Owner Group deleted successfully');
    }
}
