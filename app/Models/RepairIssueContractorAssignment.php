<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairIssueContractorAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_issue_id',
        'contractor_id',
        'assigned_by',
        'cost_price',
        'quote_attachment',
        'contractor_preferred_availability',
        'status'
    ];

    /**
     * Get the repair issue associated with this contractor assignment.
     */
    public function repairIssue()
    {
        return $this->belongsTo(RepairIssue::class);
    }

    /**
     * Get the contractor (user) assigned to the repair issue.
     */
    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    /**
     * Get the user (property manager) who assigned the contractor.
     */
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
