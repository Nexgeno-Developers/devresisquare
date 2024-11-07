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
        // Remove only the 'current_step' from session
        //session()->forget('current_step');
        session()->put('current_step', 1);
        return view('backend.properties.create'); // Return the create property view
    }

    // show quick form
    public function quick()
    {
        return view('backend.properties.quick'); // Return the create property view
    }
    public function store(Request $request)
    {
        // Ensure the user ID is stored in the session
        // if (!session()->has('user_id')) {
        //     $request->session()->put('user_id', Auth::id());
        // }
        $request->session()->put('current_step', $request->step + 1);

        // Validate data based on the current step
        if ($request->has('step')) {
            // Validate the request data
            $validatedData = $request->validate($this->getValidationRules($request->step));

            // Convert market_on to JSON if it's an array
            if ($request->has('market_on') && is_array($request->market_on)) {
                $validatedData['market_on'] = json_encode($request->market_on);  // Serialize the array to JSON
            }

            // Store all data in session excluding token and step
            //$request->session()->put($request->except('_token', 'step'));

            //$userId = $request->session()->get('user_id'); // Retrieve the user ID from the session

            // Get property_id from the session or request
            $property_id = $request->session()->get('property_id', $request->property_id);

            // Check if property_id is provided in the request
            if ($property_id) {
                $property = Property::find($property_id);
                if ($property) {
                    // Log the data before updating
                    \Log::info('Updating property with ID ' . $property_id, $validatedData);
                    $property->update($validatedData);
                }
            } else {
                // Create new property only on the first step
                if ($request->step == 1) {
                    // Log the data before creation
                    \Log::info('Creating new property', $validatedData);
                    $property = Property::create(array_merge($validatedData, ['added_by' => Auth::id()]));
                    // $property = Property::create(array_merge($validatedData, ['added_by' => $userId]));
                    $request->session()->put('property_id', $property->id);
                }
            }

            // Get total number of steps
            $totalSteps = $this->getTotalSteps();

            // Check if the current step is the last one
            if ($request->step >= $totalSteps) {
                // Final submission handling
                // Flush all session data except specified keys in one line
                $this->flushSessionExcept(['_token', 'url', '_previous', '_flash', 'login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d']);
                return redirect()->route('admin.properties.index')->with('success', 'Property Added/Updated successfully!');
            }

            // Load the next step view
            // return view('backend.properties.form_components.step' . ($request->step + 1));
            // return view('backend.properties.form_components.step' . ($request->step + 1))->withInput();
            return view('backend.properties.form_components.step' . ($request->step + 1), compact('property'));
        } else {
            // If no step is present, return a message (optional)
            return response()->json(['message' => 'Invalid step.']);
        }
    }


    public function getStepView($step, Request $request)
    {
        // Get property_id from the session or request
        $property_id = $request->session()->get('property_id', $request->property_id);
        $property = Property::find($property_id);

        // Get the total number of steps dynamically
        $totalSteps = $this->getTotalSteps();

        // Check if the step is valid
        if ($step > 0 && $step <= $totalSteps) {
            return view('backend.properties.form_components.step' . $step, compact('property')); // Return the corresponding Blade view
        } else {
            // Return a view with an error message if the step is invalid
            return view('backend.properties.form_components.error', ['message' => 'Invalid step.']);
        }
    }

    public function getQuickStepView($step, Request $request)
    {
        // Get property_id from the session or request
        $property_id = $request->session()->get('property_id', $request->property_id);
        $property = Property::find($property_id);

        // Get the total number of steps dynamically
        $totalSteps = $this->getTotalSteps();

        // Check if the step is valid
        if ($step > 0 && $step <= $totalSteps) {
            return view('backend.properties.quick.form_components.step' . $step, compact('property')); // Return the corresponding Blade view
        } else {
            // Return a view with an error message if the step is invalid
            return view('backend.properties.quick.form_components.error', ['message' => 'Invalid step.']);
        }
    }

    private function getTotalSteps()
    {
        // Specify the directory where your Blade files for steps are located
        $stepsDirectory = resource_path('views/backend/properties/form_components');

        // Get all Blade files in the directory that start with 'step' and count them
        return count(glob($stepsDirectory . '/step*.blade.php'));
    }

    private function flushSessionExcept(array $exceptKeys)
    {
        $sessionData = session()->only($exceptKeys);
        session()->flush();
        session()->put($sessionData);
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
    public function view($id)
    {
        $property = Property::findOrFail($id); // Fetch property by ID
        return view('backend.properties.view', compact('property'));
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
        // Optionally, check if the property is already deleted
        if ($property->trashed()) {
            return redirect()->route('admin.properties.index')->with('error', 'This property is already deleted.');
        }
        // Use soft delete
        $property->deleted_by = Auth::id(); // Set the user who deleted the property
        $property->save(); // Save changes
        $property->delete(); // Perform the soft delete
        $response = [
            'status' => true,
            'message' => 'Property Deleted successfully!',
        ];

        return response()->json($response);
        //return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }

    public function showSoftDeletedProperties()
    {
        $properties = Property::onlyTrashed()->get(); // Fetch only soft-deleted properties

        return view('backend.properties.deleted', compact('properties'));
    }


    public function restore($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
        $property->restore();

        $response = [
            'status' => true,
            'message' => 'Property restored successfully!',
        ];

        return redirect()->route('admin.properties.index')->with('success', $response['message']);

        //return redirect()->route('admin.properties.index')->with('success', 'Property restored successfully.');
    }

    public function bulkRestore(Request $request)
    {
        $propertyIds = $request->input('property_ids');
        Property::withTrashed()->whereIn('id', $propertyIds)->restore();

        return redirect()->route('admin.properties.index')->with('success', 'Selected properties restored successfully.');
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
                    'parking' => 'required|boolean',
                    'balcony' => 'required|boolean',
                    'garden' => 'required|boolean',
                    'service' => 'required|string',
                    'collecting_rent' => 'required|boolean',
                    'floor' => 'required|string',
                    'square_feet' => 'nullable|numeric|min:1',
                    'square_meter' => 'nullable|numeric|min:1',
                    'aspects' => 'required|string',
                ];
            case 4:
                return [
                    'current_status' => 'required|string',
                    'status_description' => 'nullable|string',
                    'available_from' => 'required|date',
                    'market_on' => 'required',
                    // 'market_on' => 'required|array',
                    // 'market_on.*' => 'in:resisquare,rightmove,zoopla,onthemarket',
                ];
            case 5:
                return [
                    'furniture' => 'array|nullable',
                    // 'furniture.*' => 'in:Furnished,Unfurnished,Flexible',
                    'kitchen' => 'array|nullable',
                    // 'kitchen.*' => 'in:Undercounter refrigerator without freezer,Dishwasher,Gas oven,Gas hob,Washing machine,Dryer,Electric hob,Electric oven,Washer,Washer Dryer,Undercounter refrigerator with freezer,Tall refrigerator with freezer',
                    'heating_cooling' => 'array|nullable',
                    // 'heating_cooling.*' => 'in:Air conditioning,Underfloor heating,Electric,Gas,Central heating,Comfort cooling,Portable heater',
                    'safety' => 'array|nullable',
                    // 'safety.*' => 'in:External CCTV Intruder alarm system,Smoke alarm,Carbon monoxide detector,Window locks,Security key lock',
                    'other' => 'array|nullable',
                    // 'other.*' => 'in:Roof Garden,Business Centre,Concierge,Lift,Pets Allowed,Pets Allowed With Licence,TV,Fireplace,Wood flooring,Double glazing,Not suitable for wheelchair users,Gym,None',
                ];
            case 6:
                return [
                    'price' => 'required|numeric',
                    'ground_rent' => 'nullable|numeric',
                    'service_charge' => 'nullable|numeric',
                    'annual_council_tax' => 'nullable|numeric',
                    'council_tax_band' => 'nullable|string|max:50',
                    'listing_sale_price' => 'nullable|numeric',
                    'tenure' => 'required',
                    'length_of_lease' => 'nullable|integer',
                ];
            case 7:
                return [
                    'epc_rating' => 'required',
                    'is_gas' => 'required   ',
                ];
            case 8:
                return [
                    'photos.*' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048', // For multiple photos
                    'floor_plan' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048', // For the floor plan
                    'view_360' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048', // For 360 view
                    'video_url' => 'nullable|max:255', // For the video URL
                    // 'video_url' => 'nullable|url|max:255', // For the video URL
                ];
            case 9:
                return [
                    'designation' => 'required',
                    'branch' => 'required',
                    'commission_percentage' => 'required',
                    'commission_amount' => 'required',
                ];
            default:
                return [];
        }
    }
}