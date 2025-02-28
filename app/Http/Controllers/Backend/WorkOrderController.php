<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\WorkOrder;

class WorkOrderController
{
    public function store(Request $request)
    {
        $request->validate([
            'repair_issue_id' => 'required|exists:repair_issues,id',
            'job_type_id' => 'required|exists:job_types,id',
            'estimated_cost' => 'nullable|numeric',
        ]);

        $workOrder = WorkOrder::create([
            'repair_issue_id' => $request->repair_issue_id,
            'job_type' => $request->job_type_id,
            'estimated_cost' => $request->estimated_cost,
            'status' => 'Raised',
        ]);

        return response()->json(['message' => 'Work Order Created Successfully!', 'workOrder' => $workOrder]);
    }
}