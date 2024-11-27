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
        return redirect()->route('owner_groups.index')->with('success', 'Owner Group updated successfully');
    }

    /**
     * Remove the specified OwnerGroup from storage.
     */
    public function destroy($id)
    {
        $ownerGroup = OwnerGroup::findOrFail($id);
        $ownerGroup->delete();
        return redirect()->route('owner_groups.index')->with('success', 'Owner Group deleted successfully');
    }
}
