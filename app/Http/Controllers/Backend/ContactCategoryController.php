<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactCategory;
use Illuminate\Http\Request;

class ContactCategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ContactCategory::all();
        return view('backend.contacts.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.contacts.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:155',
            'status' => 'required|boolean',
        ]);

        ContactCategory::create($request->all());
        return redirect()->route('contact-categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactCategory $contactCategory)
    {
        return view('backend.contacts.categories.edit', compact('contactCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactCategory $contactCategory)
    {
        $request->validate([
            'name' => 'required|string|max:155',
            'status' => 'required|boolean',
        ]);

        $contactCategory->update($request->all());
        return redirect()->route('contact-categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactCategory $contactCategory)
    {
        $contactCategory->delete();
        return redirect()->route('contact-categories.index')->with('success', 'Category deleted successfully.');
    }
}
