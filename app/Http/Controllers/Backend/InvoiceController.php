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
     * Generate an invoice from a Work Order.
     */
    public function createFromWorkOrder(Request $request, $workOrderId)
    {
        $workOrder = WorkOrder::with('jobType')->findOrFail($workOrderId);

        // Check if an invoice already exists for this Work Order
        if ($workOrder->invoice) {
            return response()->json(['message' => 'Invoice already exists!'], 400);
        }

        // Generate unique invoice number
        // $invoiceNumber = 'INV-' . str_pad(Invoice::count() + 1, 6, '0', STR_PAD_LEFT);

        // Create the invoice
        $invoiceNumber = generateReferenceNumber(Invoice::class, 'invoice_no', 'RESISQREINV');
        $invoice = Invoice::create([
            'invoice_number' => $invoiceNumber,
            'work_order_id' => $workOrder->id,
            'invoice_date' => now(),
            'due_date' => now()->addDays(30), // Default 30 days due
            'subtotal' => $workOrder->actual_cost,
            'tax_amount' => ($workOrder->actual_cost * 20) / 100, // Assume 20% VAT
            'total_amount' => $workOrder->actual_cost + ($workOrder->actual_cost * 20) / 100,
            'status_id' => 1, // "Pending" by default
        ]);

        // Add Work Order details as an invoice item
        InvoiceItems::create([
            'invoice_id' => $invoice->id,
            'description' => "Work Order #{$workOrder->works_order_no} - " . $workOrder->job_scope,
            'unit_price' => $workOrder->actual_cost,
            'quantity' => 1,
            'total_price' => $workOrder->actual_cost,
            'tax_rate_id' => 1, // Assume Standard VAT (20%)
        ]);

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
        $invoice = Invoice::with(['workOrder', 'items'])->findOrFail($invoiceId);
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
