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
            return response()->json(['message' => 'No subcategories found'], 404);
        }
        return response()->json($subCategories);
    }

    public function checkLastStep(Request $request)
    {
        // Get selected categories from the request
        $selectedCategories = $request->input('selectedCategories');

        // Get the maximum category level
        $maxLevel = RepairCategory::max('level'); // Assuming 'level' is the column indicating category depth

        // Determine if the selected categories are at the last step
        $isLastStep = count($selectedCategories) >= $maxLevel;

        return response()->json([
            'isLastStep' => $isLastStep
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

