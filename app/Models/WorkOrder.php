<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'works_order_no',
        'repair_issue_id',
        'job_type_id',
        'job_sub_type_id',
        'job_status',
        'job_scope',
        'tentative_start_date',
        'tentative_end_date',
        'booked_date',
        'invoice_to',
        'quote_attachment',
        'actual_cost',
        'charge_to_landlord',
        'payment_by',
        'estimated_cost',
        'status',
        'extra_notes',
        'date_time',
    ];

    // Relationship with RepairIssue
    public function repairIssue()
    {
        return $this->belongsTo(RepairIssue::class);
    }

    public function quoteAttachment()
    {
        return $this->belongsTo(Upload::class, 'quote_attachment');
    }
    // Relationship with Supplier
    // public function supplier()
    // {
    //     return $this->belongsTo(Supplier::class);
    // }
}

