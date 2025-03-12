<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Upload;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrderController
{
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'repair_issue_id' => 'required|exists:repair_issues,id',
            'job_type_id' => 'required|exists:job_types,id',
            'job_sub_type_id' => 'nullable|exists:job_types,id',
            'job_scope' => 'nullable|string',
            'tentative_start_date' => 'nullable|date',
            'tentative_end_date' => 'nullable|date',
            'booked_date' => 'nullable|date',
            'invoice_to' => 'required|string',
            'actual_cost' => 'nullable|numeric',
            'charge_to_landlord' => 'nullable|numeric',
            'payment_by' => 'required|string',
            'estimated_cost' => 'nullable|numeric',
            'status' => 'required|string',
            'extra_notes' => 'nullable|string',
            'quote_attachment' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('quote_attachment')) {
            $quote_attachment_id = Upload::storeFile($request->file('quote_attachment'))->id;
        }

        // $quote_attachment_path = null;
        // if ($request->hasFile('quote_attachment')) {
        //     $quote_attachment_path = $request->file('quote_attachment')->store('work_orders/attachments', 'public');
        // }

        // Create Work Order
        $workOrder = WorkOrder::create([
            'works_order_no' => $this->generateWorkorderReferenceNumber(), // Generate a unique reference number
            'repair_issue_id' => $request->repair_issue_id,
            'job_type_id' => $request->job_type_id,
            'job_sub_type_id' => $request->job_sub_type_id,
            'job_status' => $request->job_status,
            'job_scope' => $request->job_scope,
            'tentative_start_date' => $request->tentative_start_date,
            'tentative_end_date' => $request->tentative_end_date,
            'booked_date' => $request->booked_date,
            'invoice_to' => $request->invoice_to,
            'quote_attachment' => $quote_attachment_id ?? '',
            'actual_cost' => $request->actual_cost,
            'charge_to_landlord' => $request->charge_to_landlord,
            'payment_by' => $request->payment_by,
            'estimated_cost' => $request->estimated_cost,
            'status' => $request->status,
            'extra_notes' => $request->extra_notes,
            'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s'),
        ]);
        return response()->json(['message' => 'Work Order Created Successfully!', 'workOrder' => $workOrder]);
        // flash('Work Order Created Successfully!')->success();
        // return back()->json(['workOrder' => $workOrder]);
        // return back();

    }

        /**
     * Generate a unique and sequential repair reference number.
     *
     * @return string
    */
    // Generate a unique reference number
    /*private function generateWorkorderReferenceNumber()
    {
        // Find the last inserted property
        $lastProperty = WorkOrder::orderBy('id', 'desc')->first();

        // Extract and increment the numeric part
        if ($lastProperty && preg_match('/RESISQREWO(\d+)/', $lastProperty->works_order_no, $matches)) {
            $number = (int)$matches[1] + 1;
        } else {
            $number = 1; // Start from 1 if no property exists
        }

        // Format the new reference number (e.g., RESISQREP0000001)
        return 'RESISQREWO' . str_pad($number, 7, '0', STR_PAD_LEFT);
    }*/
    private function generateWorkorderReferenceNumber()
    {
        return DB::transaction(function () {
            $lastProperty = WorkOrder::orderBy('id', 'desc')->lockForUpdate()->first();
            
            if ($lastProperty && preg_match('/RESISQREWO(\d+)/', $lastProperty->works_order_no, $matches)) {
                $number = (int)$matches[1] + 1;
            } else {
                $number = 1;
            }
            
            return 'RESISQREWO' . str_pad($number, 7, '0', STR_PAD_LEFT);
        });
    }
    

    public function getWorkOrder($repairIssueId)
    {
        $workOrder = WorkOrder::where('repair_issue_id', $repairIssueId)->first();

        return response()->json([
            'work_order' => $workOrder
        ]);
    }

}
