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

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'term' => 'required|string|max:255',
            'move_in_date' => 'required|date',
        ]);

        Offer::create($request->all());
        return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
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
