<?php

namespace App\Http\Controllers\backend;

use App\Models\OwnerGroup;
use App\Models\OwnerGroupContact;
use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Log;

class OwnerGroupController
{
    /**
     * Display a listing of the OwnerGroup.
     */
    public function index()
    {
        $ownerGroups = OwnerGroup::with( 'property')->get();
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
    // Validate the request data
    $validated = $request->validate([
        'property_id' => 'required|exists:properties,id',
        'contact_id' => 'required|array|min:1', // Ensure at least one contact is selected
        'contact_id.*' => 'exists:contacts,id', // Validate each contact ID exists
        'is_main' => 'required', // Ensure main contact is one of the selected contacts
        'purchased_date' => 'required|date',
        'sold_date' => 'nullable|date|after_or_equal:purchased_date', // Optional, must be after purchased date
        'archived_date' => 'nullable|date|after_or_equal:purchased_date', // Optional, must be after purchased date
        'status' => 'required|in:active,inactive,archived',
    ]);


    // Create a new OwnerGroup record
    $ownerGroup = OwnerGroup::create([
        'property_id' => $validated['property_id'],
        'purchased_date' => $validated['purchased_date'],
        'sold_date' => $request->sold_date, // Optional field
        'archived_date' => $request->archived_date, // Optional field
        'status' => $validated['status'],
    ]);

    // Loop through selected contacts and create OwnerGroupContact records
    foreach ($validated['contact_id'] as $contactId) {
        // Debugging the contact ID and is_main value
        // dd($contactId, $validated['is_main']); // This will help confirm the values you're comparing

        // Ensure type matching by casting to integer
        $isMain = (intval($contactId) === intval($validated['is_main'])) ? 1 : 0; // Set `is_main` for the selected main contact
        // dd($isMain);

        OwnerGroupContact::create([
            'owner_group_id' => $ownerGroup->id,
            'contact_id' => $contactId,
            'is_main' => $isMain, // Assign 1 if it's the main contact, 0 otherwise
        ]);
    }

    // Flash a success message
    flash("Owner Group created successfully!")->success();

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


    public function updateMain(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'contact_id' => 'required|exists:contacts,id', // Ensure the contact ID exists in the contacts table
            'owner_group_id' => 'required|exists:owner_group,id', // Validate that the owner_group_id exists
        ]);

        // Find the OwnerGroup based on the provided ID (use $id from the route)
        $ownerGroup = OwnerGroup::find($id);

        if (!$ownerGroup) {
            return response()->json([
                'status' => false,
                'notification' => 'Owner Group not found.',
            ]);
        }

        // Get the contact ID from the validated data
        $contactId = $validated['contact_id'];

        // Get the owner_group_id from the request (this can be useful for logging or extra validation)
        $ownerGroupId = $validated['owner_group_id'];

        // Check if the owner_group_id from the form matches the one in the URL (for additional safety)
        if ($ownerGroupId != $ownerGroup->id) {
            return response()->json([
                'status' => false,
                'notification' => 'Owner Group ID mismatch.',
            ]);
        }

        // Reset all other contacts in this owner group to not be main
        $updateMain = OwnerGroupContact::where('owner_group_id', $ownerGroup->id)
            ->update(['is_main' => 0]);

        if ($updateMain === false) {
            return response()->json([
                'status' => false,
                'notification' => 'Failed to reset other contacts to non-main.',
            ]);
        }

        // Set the selected contact as the main contact
        $contactUpdated = OwnerGroupContact::where('owner_group_id', $ownerGroup->id)
            ->where('id', $contactId)
            ->update(['is_main' => 1]);

        // Check if the contact was successfully updated
        if ($contactUpdated) {
            return response()->json([
                'status' => true,
                'notification' => 'Owner Group Main contact updated successfully!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'notification' => 'Failed to update the main contact!',
            ]);
        }
    }



}
