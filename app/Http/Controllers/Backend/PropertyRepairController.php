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

    public function repairRaise(){
        $categories = RepairCategory::with('subCategories')->whereNull('parent_id')->get();
        return view('backend.repair.create_raise_issue', compact('categories'));
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

