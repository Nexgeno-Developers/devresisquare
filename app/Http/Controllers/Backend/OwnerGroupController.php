<?php

namespace App\Http\Controllers\backend;

use App\Models\OwnerGroup;
use App\Models\OwnerGroupContact;
use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // Get the current logged-in user
        $userId = Auth::id();

        // Create a new OwnerGroup record
        $ownerGroup = OwnerGroup::create([
            'property_id' => $validated['property_id'],
            'purchased_date' => $validated['purchased_date'],
            'sold_date' => $request->sold_date, // Optional field
            'archived_date' => $request->archived_date, // Optional field
            'status' => $validated['status'],
            'added_by' => $userId,
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
                'added_by' => $userId,
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
        $ownerGroup = OwnerGroup::with('ownerGroupContacts.contact')->findOrFail($id);
        $contacts = Contact::all(); // Retrieve all contacts for the dropdown
        $selectedContacts = $ownerGroup->ownerGroupContacts->pluck('contact_id')->toArray(); // Get the selected contact IDs

        return view('backend.owner_groups.edit-group',compact('ownerGroup', 'contacts', 'selectedContacts'));
    }
    // public function edit($id)
    // {
    //     $ownerGroup = OwnerGroup::with('ownerGroupContacts.contact')->findOrFail($id);
    //     return view('backend.owner_groups.edit', compact('ownerGroup'));
    // }

    // public function edit($id)
    // {
    //     $ownerGroup = OwnerGroup::findOrFail($id);
    //     $contacts = Contact::all();
    //     $properties = Property::all();
    //     return view('backend.owner_groups.edit', compact('ownerGroup', 'contacts', 'properties'));
    // }

    public function updateGroup(Request $request)
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

        // Get the current logged-in user
        $userId = Auth::id();

        // Find the existing OwnerGroup record by ID
        $ownerGroup = OwnerGroup::findOrFail($request->id); // Using request's id to locate the OwnerGroup

        // Update the OwnerGroup record
        $ownerGroup->update([
            'property_id' => $validated['property_id'],
            'purchased_date' => $validated['purchased_date'],
            'sold_date' => $request->sold_date, // Optional field
            'archived_date' => $request->archived_date, // Optional field
            'status' => $validated['status'],
            'updated_by' => $userId, // Log who updated this group
        ]);

        // Get the existing contacts in the owner group
        $existingContacts = $ownerGroup->ownerGroupContacts->pluck('contact_id')->toArray();

        // Determine which contacts are to be kept (new + existing ones in the request)
        $newContacts = $validated['contact_id'];

        // Find contacts that need to be removed (existing but not in the request)
        $contactsToRemove = array_diff($existingContacts, $newContacts);

        // Force delete contacts that are in the group but not in the request
        if (!empty($contactsToRemove)) {
            OwnerGroupContact::where('owner_group_id', $ownerGroup->id)
                ->whereIn('contact_id', $contactsToRemove)
                ->forceDelete(); //permanently delete
                // ->delete(); //soft delete if used
        }

        // Reset the `is_main` flag for all contacts in the group
        OwnerGroupContact::where('owner_group_id', $ownerGroup->id)
            ->update([
                'is_main' => 0,
                'updated_by' => $userId,
            ]);

        // Merge the existing and new contacts
        $mergedContacts = array_unique(array_merge($existingContacts, $newContacts));

        // Loop through the merged contacts and either update or insert
        foreach ($mergedContacts as $contactId) {
            // Determine if the current contact should be marked as 'is_main'
            $isMain = (intval($contactId) === intval($validated['is_main'])) ? 1 : 0;

            // If the contact already exists, update it
            if (in_array($contactId, $existingContacts)) {
                OwnerGroupContact::where('owner_group_id', $ownerGroup->id)
                    ->where('contact_id', $contactId)
                    ->update([
                        'is_main' => $isMain,
                    ]);
            } else {
                // Otherwise, create a new contact association
                OwnerGroupContact::create([
                    'owner_group_id' => $ownerGroup->id,
                    'contact_id' => $contactId,
                    'is_main' => $isMain,
                    'added_by' => $userId,
                ]);
            }
        }

        // Flash a success message
        flash("Owner Group updated successfully!")->success();

        return back();
    }



    /**
     * Update the specified OwnerGroup in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $ownerGroup = OwnerGroup::findOrFail($id);

    //     $validatedData = $request->validate([
    //         'contact_id' => 'required|exists:contacts,id',
    //         'property_id' => 'required|exists:properties,id',
    //         'purchased_date' => 'required|date',
    //         'sold_date' => 'nullable|date',
    //         'archived_date' => 'nullable|date',
    //         'status' => 'required|string|max:255',
    //     ]);

    //     $ownerGroup->update($validatedData);
    //     // $response = [
    //     //     'status' => true,
    //     //     'notification' => 'Owner Group Deleted successfully!',
    //     // ];

    //     // return response()->json($response);
    //     // return back()->with('success', 'Owner Group deleted successfully');

    //     flash('Owner Group Updated successfully!')->success();
    //     return back();

    //     // return redirect()->route('owner_groups.index')->with('success', 'Owner Group updated successfully');
    // }

    /**
     * Remove the specified OwnerGroup from storage.
     */
    // public function destroy($id)
    // {
    //     $ownerGroup = OwnerGroup::findOrFail($id);
    //     $ownerGroup->delete();
    //     // Return response
    //     $response = [
    //         'status' => true,
    //         'notification' => 'Owner Group Deleted successfully!',
    //     ];

    //     return response()->json($response);
    //     // return back()->with('success', 'Owner Group deleted successfully');

    //     // flash('Owner Group deleted successfully!')->success();
    //     // return back();
    //     // return redirect()->route('owner_groups.index')->with('success', 'Owner Group deleted successfully');
    // }


    public function deleteGroup($id)
    {
        // Get the current logged-in user
        $userId = Auth::id();

        // Find the OwnerGroup record by ID or fail if not found
        $ownerGroup = OwnerGroup::findOrFail($id);

        // Soft delete the related OwnerGroupContact records (soft delete instead of permanent delete)
        foreach ($ownerGroup->ownerGroupContacts as $contact) {
            // Soft delete each associated contact
            $contact->deleted_by = $userId; // Log who deleted the contact
            $contact->save(); // Save to update the deleted_by field
            $contact->delete(); // Soft delete the contact
        }

        // Soft delete the OwnerGroup itself
        $ownerGroup->deleted_by = $userId; // Log who deleted the OwnerGroup
        $ownerGroup->save(); // Save to update the deleted_by field
        $ownerGroup->delete(); // Soft delete the OwnerGroup

        // Flash a success message
        flash("Owner Group and associated contacts deleted successfully!")->success();

        // Redirect back to the previous page (or any other page as needed)
        return back();
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

        // Get the current logged-in user
        $userId = Auth::id();

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
            ->update([
                'is_main' => 0,
                'updated_by' => $userId,
            ]);

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
