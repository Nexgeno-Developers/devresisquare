<?php

namespace App\Http\Controllers\Backend;

use App\Models\Invoice;
use App\Models\WorkOrder;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class InvoiceController
{
    /**
    * Display a list of all invoices.
    */
    public function index(Request $request)
    {
        $query = Invoice::with(['workOrder.repairIssue.property', 'contact']);

        // Apply filters if provided
        if ($request->has('status')) {
            $statusMap = [
                'pending' => 1,
                'paid' => 2,
                'overdue' => 3,
                'cancelled' => 4
            ];
            if (array_key_exists($request->status, $statusMap)) {
                $query->where('status_id', $statusMap[$request->status]);
            }
        }
    
        // if ($request->has('search')) {
        //     $query->where(function ($q) use ($request) {
        //         $q->where('invoice_number', 'LIKE', "%{$request->search}%")
        //           ->orWhereHas('contact', function ($q) use ($request) {
        //               $q->where('full_name', 'LIKE', "%{$request->search}%");
        //           })
        //           ->orWhereHas('workOrder.repairIssue.property', function ($q) use ($request) {
        //               $q->where('name', 'LIKE', "%{$request->search}%");
        //           });
        //     });
        // }
    
        $invoices = $query->latest()->paginate(10); // Pagination with 10 records per page
        return view('backend.invoices.index', compact('invoices'));
    }

    /**
     * Generate an invoice from a Work Order.
     */
    public function createFromWorkOrder(Request $request, $workOrderId)
    {
        $workOrder = WorkOrder::with(['jobType', 'repairIssue.property'])->findOrFail($workOrderId);

        // Check if an invoice already exists for this Work Order
        if ($workOrder->invoice) {
            return response()->json(['message' => 'Invoice already exists!'], 400);
        }

        // 🔹 Get Property ID from Work Order
        $propertyId = $workOrder->repairIssue->property->id ?? null;

        // If property ID is missing, return error
        if (!$propertyId) {
            return response()->json(['message' => 'Property ID not found!'], 400);
        }

        // Generate unique invoice number
        // $invoiceNumber = 'INV-' . str_pad(Invoice::count() + 1, 6, '0', STR_PAD_LEFT);

        // Create the invoice
        $invoiceNumber = generateReferenceNumber(Invoice::class, 'invoice_no', 'RESISQREINV');
        if($workOrder->charge_to_landlord > 0){
            $subTotal = $workOrder->actual_cost + $workOrder->charge_to_landlord;
        }else{
            $subTotal = $workOrder->actual_cost;
        }
        // $taxAmount = ($workOrder->actual_cost * 20) / 100;  // Assume 20% VAT
        $taxAmount = 0;
        $totalAmount = $subTotal + $taxAmount;
        $notes = $workOrder->extra_notes;
        
        $invoice = Invoice::create([
            'invoice_number' => $invoiceNumber,
            'work_order_id' => $workOrder->id,
            'property_id' => $propertyId,
            'contact_id' => $workOrder->invoice_to_id,
            'invoice_date' => now(),
            'due_date' => now()->addDays(30), // Default 30 days due
            'subtotal' => $subTotal,
            'tax_amount' => $taxAmount,
            'notes' => $notes,
            // 'tax_amount' => ($workOrder->actual_cost * 20) / 100, // Assume 20% VAT
            'total_amount' => $totalAmount,
            'status_id' => 1, // "Pending" by default
            'invoiced_date_time' => now(),
        ]);

        // echo "<pre>";
        // var_dump($invoice);
        // echo "</pre>";
        // exit();

        // Add Work Order details as an invoice item
        InvoiceItems::create([
            'invoice_id' => $invoice->id,
            'description' => "Work Order #{$workOrder->works_order_no} - " . $workOrder->job_scope,
            'unit_price' => $workOrder->actual_cost,
            'quantity' => 1,
            'total_price' => $workOrder->actual_cost,
            // 'tax_rate_id' => 1, // Assume Standard VAT (20%)
        ]);

        // 🔹 Add Additional Charge to Landlord (if applicable)
        if ($workOrder->charge_to_landlord > 0) {
            InvoiceItems::create([
                'invoice_id' => $invoice->id,
                'description' => "Charge to Landlord for Work Order #{$workOrder->works_order_no}",
                'unit_price' => $workOrder->charge_to_landlord,
                'quantity' => 1,
                'total_price' => $workOrder->charge_to_landlord,
            ]);
        }
        
        return response()->json([
            'message' => 'Invoice generated successfully!',
            'invoice_id' => $invoice->id
        ]);
    }

    /**
     * Show invoice details.
     */
    public function show($invoiceId)
    {
        $invoice = Invoice::with(['workOrder.repairIssue.property', 'contact', 'items'])->findOrFail($invoiceId);
        return view('backend.invoices.show', compact('invoice'));
    }

    /**
     * Download Invoice as PDF.
     */
    public function download($invoiceId)
    {
        $invoice = Invoice::with('workOrder')->findOrFail($invoiceId);
        $pdf = Pdf::loadView('invoices.invoice_template', compact('invoice'));

        return $pdf->download("invoice-{$invoice->invoice_number}.pdf");
    }

    /**
     * Mark Invoice as Paid.
     */
    public function markAsPaid($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->update(['status_id' => 2]); // "Paid" status

        return response()->json(['message' => 'Invoice marked as paid!']);
    }


}
