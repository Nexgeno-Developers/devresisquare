<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tenancy;
use App\Models\Property;
use App\Models\Offer;
use App\Models\Contact;
use App\Models\TenantMember;
use App\Models\TenancyType;
use App\Models\TenancySubStatus;
use App\Models\PropertyManagerTenancy;
use Illuminate\Http\Request;

class TenancyController
{


    // Display a list of all active tenancies for a specific property
    public function index($propertyId)
    {
        $tenancies = Tenancy::where('property_id', $propertyId)
            ->where('status', 'Active')
            ->get();

        return view('backend.properties.tabs.tenancy', compact('tenancies', 'propertyId'));
    }

    // Show the form for creating a new tenancy
    public function create()
    {
        // Get contacts where category_id is 3 (Tenant)
        $tenants = Contact::where('category_id', 3)->get();

        // Get contacts where category_id is 2 (Property Manager)
        $property_managers = Contact::where('category_id', 2)->get();

        // Fetch all tenancy types (if they're stored in a model TenancyType)
        $tenancyTypes = TenancyType::all();

        // Fetch all tenancy sub statuses (if they're stored in a model TenancySubStatus)
        $tenancySubStatuses = TenancySubStatus::all();

        return view('backend.tenancies.create', compact('tenants', 'property_managers', 'tenancyTypes', 'tenancySubStatuses'));
    }


    // Store a newly created tenancy
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'offer_id' => 'nullable|exists:offers,id',
            'status' => 'required|in:Active,Archive', // Assuming status is either Active or Archive
            // 'sub_status' => 'nullable|string|max:255',
            'move_in' => 'required|date',
            'move_out' => 'nullable|date',
            'tenancy_renewal_confirm_date' => 'nullable|date', // Assuming it's a date format
            'extension_date' => 'nullable|date',
            'rent' => 'required|numeric', // Renamed from 'price' to 'rent' to match the model
            'deposit' => 'required|numeric',
            'deposit_type' => 'nullable|string|max:255', // Adjusting validation based on possible values for 'deposit_type'
            'deposit_number' => 'nullable|string|max:255',
            'frequency' => 'nullable|string|max:255',
            'tenancy_sub_status_id' => 'nullable|exists:tenancy_sub_statuses,id', // Assuming foreign key relationship
            'tenancy_type_id' => 'nullable|exists:tenancy_types,id', // Assuming foreign key relationship
            'deposit_held_by' => 'nullable|string|max:255',
            'deposit_service' => 'nullable|string|max:255',
            // 'periodic' => 'nullable|boolean', // Assuming it's a boolean field
            // 'rolling_contract' => 'nullable|boolean', // Assuming it's a boolean field
            // 'renewal_exempt' => 'nullable|boolean', // Assuming it's a boolean field
            'term_months' => 'nullable|integer',
            'term_days' => 'nullable|integer',
            'contact_id' => 'required|array', // Validate that the contact_id is an array
            'contact_id.*' => 'exists:contacts,id', // Ensure each contact_id exists in the contacts table

            'is_main_person' => 'required|exists:contacts,id', // Ensure main person is a valid contact ID
            'property_manager' => 'nullable|array', // Ensure property_manager is an array (nullable)
            'property_manager.*' => 'exists:contacts,id', // Ensure each property manager exists in the contacts table
        ]);

        // Manually convert checkbox field
        // set it to true; if not, set to false
        $validated['periodic'] = $request->has('periodic') ? true : false;
        $validated['rolling_contract'] = $request->has('rolling_contract') ? true : false;
        $validated['renewal_exempt'] = $request->has('renewal_exempt') ? true : false;

        // Create a new tenancy
        $tenancy = Tenancy::create($validated);

        // Attach property managers to the tenancy if provided
        if ($request->has('property_manager')) {
            foreach ($request->property_manager as $propertyManagerId) {
                PropertyManagerTenancy::create([
                    'tenancy_id' => $tenancy->id,
                    'property_manager_id' => $propertyManagerId,
                    'property_id' => $validated['property_id'], // Ensure property_id is passed in the form
                ]);
            }
        }

        // Generate a unique group ID (e.g., GROUP_1, GROUP_2)
        $groupId = 'GROUP_' . $tenancy->id;

        // Store multiple TenantMember records
        foreach ($request->contact_id as $contactId) {
            // Determine if the contact is the main person
            $isMainPerson = $contactId == $request->is_main_person;
            TenantMember::create([
                'tenancy_id' => $tenancy->id,
                'contact_id' => $contactId,
                'is_main_person' => $isMainPerson,
                // 'is_main_person' => false, // Default or based on logic, set is_main_person flag
                'group_id' => $groupId, // Set group_id if necessary
            ]);
        }

        flash("Tenancy Added successfully!")->success();
        return back();

        // Redirect back with success message
        // return redirect()->route('tenancies.index')->with('success', 'Tenancy created successfully!');
    }

    // Display the specified tenancy
    public function show($id)
    {
        $tenancy = Tenancy::findOrFail($id);
        return view('backend.tenancies.show', compact('tenancy'));
    }

    // Show the form for editing the specified tenancy
    public function edit($id)
    {
        // Find the tenancy by its ID
        $tenancy = Tenancy::findOrFail($id);

        // Fetch related data needed for the edit form

        // Get all tenants (contacts where category_id is 3)
        $tenants = Contact::where('category_id', 3)->get();

        // Get all property managers (contacts where category_id is 2)
        $property_managers = Contact::where('category_id', 2)->get();

        // Fetch all tenancy types
        $tenancyTypes = TenancyType::all();

        // Fetch all tenancy sub-statuses
        $tenancySubStatuses = TenancySubStatus::all();

        // Fetch the tenancy's current property managers
        $currentPropertyManagers = PropertyManagerTenancy::where('tenancy_id', $id)->pluck('property_manager_id')->toArray();

        // Fetch the tenancy's current tenant members
        $tenantMembers = TenantMember::where('tenancy_id', $id)->get();

        // Find the main person from the tenant members
        $mainPersonId = $tenantMembers->where('is_main_person', true)->pluck('contact_id')->first();

        // Pass all data to the edit view
        return view('backend.tenancies.edit', compact(
            'tenancy',
            'tenants',
            'property_managers',
            'tenancyTypes',
            'tenancySubStatuses',
            'currentPropertyManagers',
            'tenantMembers',
            'mainPersonId'
        ));
    }


    // Update the specified tenancy
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'offer_id' => 'nullable|exists:offers,id',
            'status' => 'required|in:Active,Archive', // Assuming status is either Active or Archive
            'move_in' => 'required|date',
            'move_out' => 'nullable|date',
            'tenancy_renewal_confirm_date' => 'nullable|date', // Assuming it's a date format
            'extension_date' => 'nullable|date',
            'rent' => 'required|numeric', // Renamed from 'price' to 'rent' to match the model
            'deposit' => 'required|numeric',
            'deposit_type' => 'nullable|string|max:255', // Adjusting validation based on possible values for 'deposit_type'
            'deposit_number' => 'nullable|string|max:255',
            'frequency' => 'nullable|string|max:255',
            'tenancy_sub_status_id' => 'nullable|exists:tenancy_sub_statuses,id', // Assuming foreign key relationship
            'tenancy_type_id' => 'nullable|exists:tenancy_types,id', // Assuming foreign key relationship
            'deposit_held_by' => 'nullable|string|max:255',
            'deposit_service' => 'nullable|string|max:255',
            'term_months' => 'nullable|integer',
            'term_days' => 'nullable|integer',
            'contact_id' => 'required|array', // Validate that the contact_id is an array
            'contact_id.*' => 'exists:contacts,id', // Ensure each contact_id exists in the contacts table

            'is_main_person' => 'required|exists:contacts,id', // Ensure main person is a valid contact ID
            'property_manager' => 'nullable|array', // Ensure property_manager is an array (nullable)
            'property_manager.*' => 'exists:contacts,id', // Ensure each property manager exists in the contacts table
        ]);

        // Manually convert checkbox field
        $validated['periodic'] = $request->has('periodic') ? true : false;
        $validated['rolling_contract'] = $request->has('rolling_contract') ? true : false;
        $validated['renewal_exempt'] = $request->has('renewal_exempt') ? true : false;

        // Find the existing tenancy record
        $tenancy = Tenancy::findOrFail($id);

        // Update the tenancy record
        $tenancy->update($validated);

        // Sync property managers for the tenancy
        if ($request->has('property_manager')) {
            // First, remove existing property managers
            PropertyManagerTenancy::where('tenancy_id', $tenancy->id)->delete();

            // Attach new property managers
            foreach ($request->property_manager as $propertyManagerId) {
                PropertyManagerTenancy::create([
                    'tenancy_id' => $tenancy->id,
                    'property_manager_id' => $propertyManagerId,
                    'property_id' => $validated['property_id'], // Ensure property_id is passed in the form
                ]);
            }
        }

        // Update TenantMember records
        // First, remove all existing tenant members
        TenantMember::where('tenancy_id', $tenancy->id)->delete();

        // Store new TenantMember records
        $groupId = 'GROUP_' . $tenancy->id; // Regenerate group_id
        foreach ($request->contact_id as $contactId) {
            // Determine if the contact is the main person
            $isMainPerson = $contactId == $request->is_main_person;
            TenantMember::create([
                'tenancy_id' => $tenancy->id,
                'contact_id' => $contactId,
                'is_main_person' => $isMainPerson,
                'group_id' => $groupId, // Set group_id if necessary
            ]);
        }

        flash("Tenancy updated successfully!")->success();
        return back();
    }


    // Remove the specified tenancy from storage
    public function destroy($id)
    {
        $tenancy = Tenancy::findOrFail($id);
        $tenancy->delete();

        return redirect()->route('tenancies.index')->with('success', 'Tenancy deleted successfully!');
    }
}
