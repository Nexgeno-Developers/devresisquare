<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Contact;
use App\Models\RepairIssue;
use App\Models\RepairPhoto;
use Illuminate\Http\Request;
use App\Models\RepairHistory;
use App\Models\RepairCategory;
use App\Models\RepairAssignment;
use App\Models\RepairIssueContact;
use App\Models\RepairIssueContractorAssignment;
use App\Models\RepairIssuePropertyManager;

class PropertyRepairController
{

    public function repairRaise()
    {
        $categories = RepairCategory::with(['subCategories', 'parentCategory'])  // Pass as an array of relationships
            ->whereNull('parent_id')
            ->orderBy('level')
            ->orderBy('position')
            ->get();

        // Get the maximum level in the table
        $maxLevel = RepairCategory::max('level');

        return view('backend.repair.create_raise_issue', compact('categories', 'maxLevel'));
    }

    public function getSubCategories($categoryId)
    {
        // var_dump($categoryId);
        $subCategories = RepairCategory::where('parent_id', $categoryId)
            ->orderBy('level')
            ->orderBy('position')
            ->get();

        if ($subCategories->isEmpty()) {
            return response()->json(['message' => 'No subcategories found'], 200);
        }
        return response()->json($subCategories);
    }

    public function getCategories()
    {
        // Fetch all categories with id, name, parent_id, and level
        $categories = RepairCategory::all(['id', 'name', 'parent_id', 'level']);

        // Organize categories into a hierarchical structure (group by parent_id)
        $categoriesByParent = [];

        // Loop through the categories to group them by parent_id
        foreach ($categories as $category) {
            $categoriesByParent[$category->parent_id][] = $category;
        }

        // Return categories as a JSON response, including their hierarchical structure
        return response()->json($categoriesByParent);
    }



    public function checkLastStep(Request $request)
    {
        // Get selected categories from the request
        $selectedCategories = $request->input('selectedCategories');

        // Ensure the selectedCategories array is not empty
        if (empty($selectedCategories)) {
            return response()->json([
                'isLastStep' => false,
                'message' => 'No categories selected.'
            ]);
        }

        // Get the last selected category ID and its corresponding level
        $lastCategoryId = end($selectedCategories);
        $lastCategory = RepairCategory::find($lastCategoryId);

        if (!$lastCategory) {
            return response()->json([
                'isLastStep' => false,
                'message' => 'Invalid category selected.'
            ]);
        }

        $currentLevel = $lastCategory->level;

        // Check if there are any categories with this category as a parent (level + 1)
        $hasSubcategories = RepairCategory::where('parent_id', $lastCategoryId)
            ->where('level', $currentLevel + 1)
            ->exists();

        return response()->json([
            'isLastStep' => !$hasSubcategories, // If no subcategories exist, it's the last step
            'message' => $hasSubcategories ? 'Subcategories available.' : 'No further subcategories.'
        ]);
    }


    public function index()
    {
        $repairIssues = RepairIssue::paginate(10);
        return view('backend.repair.index', compact('repairIssues'));
    }

    // Show a single repair issue
    public function show($id)
    {
        $repairIssue = RepairIssue::findOrFail($id);
        return view('backend.repair.view_raise_issue', compact('repairIssue'));
    }

    // Show the form for editing a repair issue
    // public function edit($id)
    // {
    //     $repairIssue = RepairIssue::findOrFail($id);
    //     return view('backend.repair.edit_raise_issue', compact('repairIssue'));
    // }
    public function edit($id)
    {
        // Load the repair issue with relationships if needed
        $repairIssue = RepairIssue::with([
            'repairAssignments',
            'repairHistories',
            'repairIssueContacts',
            'repairPhotos',
            'property' // Eager load the related property
        ])->findOrFail($id);

        // Load additional data for the form:
        $categories = RepairCategory::all(); // or get only the top-level categories for step2
        // Get the maximum level in the table
        $maxLevel = RepairCategory::max('level');
        // $propertyManagers = User::ofRole('property_manager')->get();
        $propertyManagers = Contact::whereHas('category', callback: function ($query) {
            $query->where('id', 2);
        })->get();

        $assignedManagers = RepairIssuePropertyManager::where('repair_issue_id', $id)->pluck('property_manager_id')->toArray();
        $contractorAssignments = RepairIssueContractorAssignment::where('repair_issue_id', $id)->get();
        $contractors = Contact::whereHas('category', callback: function ($query) {
            $query->where('name', 'Contractor');
        })->get();
        // $contractors = User::whereHas('role', function ($query) {
        //     $query->where('name', 'contractor');
        // })->get();

        return view('backend.repair.edit_raise_issue', data: compact(
            'repairIssue',
            'categories',
            'maxLevel',
            'propertyManagers',
            'assignedManagers',
            'contractorAssignments',
            'contractors'
        ));
    }
    // Update the specified repair issue
    public function update(Request $request, $id)
    {
        $request->validate([
            'repair_category_id' => 'required',
            'description' => 'required',
        ]);

        $repairIssue = RepairIssue::findOrFail($id);
        $repairIssue->repair_category_id = $request->repair_category_id;
        $repairIssue->description = $request->description;
        $repairIssue->status = $request->status ?? $repairIssue->status; // Keep the current status if not updated
        $repairIssue->save();

        flash('Repair issue updated successfully')->success();
        return redirect()->route('admin.repairs.index');
    }

    // Remove the specified repair issue
    public function destroy($id)
    {
        $repairIssue = RepairIssue::findOrFail($id);
        $repairIssue->delete();

        flash('Repair issue deleted successfully')->success();
        return redirect()->route('admin.repairs.index');
    }

    public function raiseIssueStore(Request $request)
    {
        $request->validate([
            'property_id' => 'required',  // Ensure it's an array with at least one item
            'repair_category_id' => 'required|integer|exists:repair_categories,id',
            'repair_navigation' => 'required|json',
            'description' => 'required|string',
        ]);

        // Decode JSON categories
        $categories = json_decode($request->repair_navigation, true);

        // dd([
        //     'original_categories' => $request->repair_navigation,
        //     'converted_categories' => $categories,
        // ]);

        // Decode `property_id` if it's a stringified array (e.g., "[5]")
        $propertyId = $request->property_id;

        if (is_string($propertyId) && str_starts_with($propertyId, '[') && str_ends_with($propertyId, ']')) {
            $propertyId = json_decode($propertyId, true); // Convert JSON string to PHP array
        }

        // If it's an array, extract the first value
        if (is_array($propertyId)) {
            $propertyId = reset($propertyId);
        }

        // Ensure it's a valid integer
        $propertyId = (int) $propertyId;

        // dd([
        //     'original_property_id' => $request->property_id,
        //     'converted_property_id' => $propertyId,
        // ]);

        // Store repair request
        $repair = RepairIssue::create([
            'property_id' => $propertyId,
            'repair_navigation' => json_encode($categories),
            'repair_category_id' => $request->repair_category_id,
            'description' => $request->description,
            'status' => 'active',
        ]);

        // Store repair photos
        if ($request->has('repair_photos')) {
            RepairPhoto::create([
                'photos' => $request->repair_photos,
                'repair_issue_id' => $repair->id,
                'photo_type' => 'jpg',
            ]);
        }

        flash('Repair request raised successfully')->success();
        return redirect()->route('admin.property_repairs.create');
    }


    // public function update(Request $request, $id)
    // {
    //     $repairIssue = RepairIssue::findOrFail($id);
    //     $repairIssue->update($request->all());
    //     return redirect()->route('repairs.index');
    // }

    public function assignRepair(Request $request, $repairIssueId)
    {
        $repairAssignment = new RepairAssignment();
        $repairAssignment->repair_issue_id = $repairIssueId;
        $repairAssignment->assigned_to = $request->assigned_to;
        $repairAssignment->assigned_at = now();
        $repairAssignment->status = 'assigned';
        $repairAssignment->save();

        return redirect()->route('repairs.index');
    }

    public function createHistory($repairIssueId, $action)
    {
        RepairHistory::create([
            'repair_issue_id' => $repairIssueId,
            'action' => $action,
            'previous_status' => 'pending', // Example
            'new_status' => 'in-progress', // Example
        ]);

        return redirect()->route('repairs.index');
    }

    public function getPropertyTenants(Request $request)
    {
        // Get the property_id from the request.
        // Note: The property ID may be passed as an array; if so, we take the first element.
        $propertyId = $request->input('property_id');
        if (is_array($propertyId)) {
            $propertyId = (int) reset($propertyId);
        } else {
            $propertyId = (int) $propertyId;
        }

        // Retrieve tenancy IDs for the given property.
        $tenancyIds = \App\Models\Tenancy::where('property_id', $propertyId)
            ->pluck('id')
            ->toArray();

        // Retrieve tenant members associated with those tenancies, with their contact details.
        $tenantMembers = \App\Models\TenantMember::whereIn('tenancy_id', $tenancyIds)
            ->with('contact')
            ->get();

        // Map the results to a unique list of tenants.
        $tenants = $tenantMembers->map(function($member) {
            if ($member->contact) {
                return [
                    'id' => $member->contact->id,
                    'full_name' => $member->contact->full_name,
                    'email' => $member->contact->email,
                    'phone' => $member->contact->phone,
                ];
            }
            return null;
        })->filter()      // Remove any null entries.
          ->unique('id')  // Ensure unique tenant contacts.
          ->values();     // Reset the keys.


        return response()->json($tenants);
    }




    // Additional methods as necessary
}

