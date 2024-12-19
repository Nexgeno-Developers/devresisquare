<?php

namespace App\Http\Controllers\Backend;

use App\Models\Offer;
use App\Models\Property;
use Illuminate\Http\Request;

class OfferController
{
    public function index()
    {
        $offers = Offer::with('property')->get();
        return view('backend.offers.index', compact('offers'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('backend.offers.create', compact('properties'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'property_id' => 'required|exists:properties,id',
    //         'price' => 'required|numeric',
    //         'deposit' => 'required|numeric',
    //         'term' => 'required|string|max:255',
    //         'move_in_date' => 'required|date',
    //     ]);

    //     Offer::create($request->all());
    //     return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'property_id' => 'required|exists:properties,id',  // Ensure property exists in database
            'price' => 'required|numeric',                      // Validate the price to be a number
            'deposit' => 'required|numeric',                    // Validate the deposit to be a number
            'term' => 'required|string|max:255',                 // Validate the term as a string
            'moveInDate' => 'required|date',                    // Validate move-in date
        ]);

        // Collect tenant details from the request
        $tenantDetails = [];
        $tenantIndex = 1;

        while ($request->has("tenantName_{$tenantIndex}")) {
            $tenantDetails[] = [
                'tenantName' => $request->input("tenantName_{$tenantIndex}"),
                'tenantPhone' => $request->input("tenantPhone_{$tenantIndex}"),
                'tenantEmail' => $request->input("tenantEmail_{$tenantIndex}"),
                'employmentStatus' => $request->input("employmentStatus_{$tenantIndex}"),
                'businessName' => $request->input("businessName_{$tenantIndex}"),
                'guarantee' => $request->input("guarantee_{$tenantIndex}"),
                'previouslyRented' => $request->input("previouslyRented_{$tenantIndex}"),
                'poorCredit' => $request->input("poorCredit_{$tenantIndex}"),
                'mainPerson' => $request->input("mainPerson_{$tenantIndex}") == 'on' ? true : false,  // Main person flag
            ];
            $tenantIndex++;
        }

        // Create the offer in the database
        $offer = Offer::create([
            'property_id' => $request->input('property_id'),
            'price' => $request->input('price'),
            'deposit' => $request->input('deposit'),
            'term' => $request->input('term'),
            'move_in_date' => $request->input('moveInDate'),
            'tenant_details' => json_encode($tenantDetails),  // Store tenant details as JSON
            'status' => 'Pending',  // Default status for the offer
        ]);

        $response = [
            'status' => true,
            'message' => 'Offer Added successfully!',
        ];

        return response()->json($response);

        // Redirect back with a success message
        // return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $properties = Property::all();
        return view('backend.offers.edit', compact('offer', 'properties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'term' => 'required|string|max:255',
            'move_in_date' => 'required|date',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->update($request->all());
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully.');
    }
}
