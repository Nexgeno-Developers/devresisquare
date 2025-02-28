<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'works_order_no',
        'repair_issue_id',
        // 'supplier_id',
        'job_type_id',
        'job_sub_type_id',
        'job_reference_no',
        'job_description',
        // 'property_id',
        // 'property_address',
        'date',
        'time',
        'extra_notes',
        'invoice_to_name',
        'invoice_to_address',
        'invoice_to_email',
        'contact_name',
        'contact_number',
        'full_access_details',
        'problem_issue',
        'photos_videos_attached',
        'floor_plan_attached',
        'status',
    ];

    // Relationship with RepairIssue
    public function repairIssue()
    {
        return $this->belongsTo(RepairIssue::class);
    }

    // Relationship with Supplier
    // public function supplier()
    // {
    //     return $this->belongsTo(Supplier::class);
    // }
}

