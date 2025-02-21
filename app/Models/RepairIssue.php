<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairIssue extends Model
{
    use HasFactory;

    protected $fillable = ['repair_category_id', 'repair_navigation', 'description', 'tenant_availability', 'access_details', 'estimated_price', 'vat_type', 'vat_percentage', 'priority', 'status', 'property_id', 'tenant_id', 'final_contractor_id'];

    // protected $casts = [
    //     'repair_navigation' => 'array', // Cast repair_navigation as an array (JSON)
    // ];

    // Optionally cast tenant_availability to datetime.
    protected $casts = [
        'tenant_availability' => 'datetime',
    ];

    /**
     * Get the associated property for this repair issue.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    public function repairCategory()
    {
        return $this->belongsTo(RepairCategory::class);
    }

    public function repairPhotos()
    {
        return $this->hasMany(RepairPhoto::class);
    }

    public function repairAssignments()
    {
        return $this->hasMany(RepairAssignment::class);
    }

    /**
     * Get the property manager assignments for this repair issue.
     */
    public function repairIssuePropertyManagers()
    {
        return $this->hasMany(RepairIssuePropertyManager::class);
    }

    /**
     * Get the contractor assignments for this repair issue.
     */
    public function repairIssueContractorAssignments()
    {
        return $this->hasMany(RepairIssueContractorAssignment::class);
    }

    public function repairHistories()
    {
        return $this->hasMany(RepairHistory::class);
    }

    public function repairIssueContacts()
    {
        return $this->hasMany(RepairIssueContact::class);
    }

    public function finalContractor()
    {
        return $this->belongsTo(Contact::class, 'final_contractor_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Contact::class, 'tenant_id')
                    ->where('category_id', 3);
    }
}
