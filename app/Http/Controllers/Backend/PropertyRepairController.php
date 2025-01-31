<?php

namespace App\Http\Controllers\Backend;

use App\Models\RepairCategory;
use App\Models\RepairIssue;
use App\Models\RepairAssignment;
use App\Models\RepairHistory;
use App\Models\RepairIssueContact;
use Illuminate\Http\Request;

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
        // Fetch all categories with their id and name
        $categories = RepairCategory::all(['id', 'name']); // Pluck both id and name

        return response()->json($categories);
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
        $repairIssues = RepairIssue::all();
        return view('repairs.index', compact('repairIssues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required',
            'repair_category_id' => 'required',
            'description' => 'required',
            'priority' => 'required',
        ]);

        RepairIssue::create($validated);
        return redirect()->route('repairs.index');
    }

    public function update(Request $request, $id)
    {
        $repairIssue = RepairIssue::findOrFail($id);
        $repairIssue->update($request->all());
        return redirect()->route('repairs.index');
    }

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


    // Additional methods as necessary
}

