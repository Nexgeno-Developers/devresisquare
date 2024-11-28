<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('category')->get();
        return view('backend.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ContactCategory::all();
        return view('backend.contacts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:contact_categories,id',
    //         'first_name' => 'required|string|max:55',
    //         'last_name' => 'required|string|max:55',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'required|email|max:55',
    //         'status' => 'required|boolean',
    //     ]);

    //     Contact::create($request->all());
    //     flash("Contact Added Successfully!")->success();
    //     return redirect()->route('contacts.index');
    // }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'category_id' => 'required|exists:contact_categories,id',
            'first_name' => 'required|string|max:55',
            'middle_name' => 'nullable|string|max:55',
            'last_name' => 'required|string|max:55',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:55',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'postcode' => 'required|string|max:15',
            'city' => 'required|string|max:55',
            'country' => 'required|string|max:55',
            'status' => 'required|in:0,1',
        ]);

        // Concatenate first, middle, and last names to create full_name
        $fullName = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);
        $Category_id = $request->category_id;
        // Store the contact
        Contact::create([
            'category_id' => $Category_id,
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'full_name' => $fullName,
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address_line_1' => $validatedData['address_line_1'],
            'address_line_2' => $validatedData['address_line_2'],
            'postcode' => $validatedData['postcode'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'status' => $validatedData['status'],
            'updated_by' => Auth::user()->id,
        ]);

        // Redirect or return a response
        flash("Contact Added Successfully!")->success();
        return redirect()->route('contacts.index');
        // return redirect()->route('contacts.index')->with('success', 'Contact created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $categories = ContactCategory::all();
        return view('backend.contacts.edit', compact('contact', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Contact $contact)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:contact_categories,id',
    //         'first_name' => 'required|string|max:55',
    //         'last_name' => 'required|string|max:55',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'required|email|max:55',
    //         'status' => 'required|boolean',
    //     ]);

    //     $contact->update($request->all());
    //     flash("Contact Updated successfully!")->success();
    //     return redirect()->route('contacts.index');
    // }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'category_id' => 'required|exists:contact_categories,id',
            'first_name' => 'required|string|max:55',
            'middle_name' => 'nullable|string|max:55',
            'last_name' => 'required|string|max:55',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:55',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'postcode' => 'required|string|max:15',
            'city' => 'required|string|max:55',
            'country' => 'required|string|max:55',
            'status' => 'required|in:0,1',
        ]);

        // Find the contact to be updated
        $contact = Contact::findOrFail($id);

        // Concatenate first, middle, and last names to create full_name
        $fullName = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);
        $category_id = $request->category_id;
        // Update the contact
        $contact->update([
            'category_id' => $category_id,
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'full_name' => $fullName,
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address_line_1' => $validatedData['address_line_1'],
            'address_line_2' => $validatedData['address_line_2'],
            'postcode' => $validatedData['postcode'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'status' => $validatedData['status'],
            'updated_by' => Auth::user()->id,
        ]);

        // Redirect or return a response
        flash("Contact Updated Successfully!")->success();
        return redirect()->route('contacts.index');
        // return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
