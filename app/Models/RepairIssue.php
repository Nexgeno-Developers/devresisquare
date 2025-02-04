<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairIssue extends Model
{
    use HasFactory;

    protected $fillable = ['repair_category_id', 'repair_navigation', 'description', 'priority', 'status', 'property_id'];

    // protected $casts = [
    //     'repair_navigation' => 'array', // Cast repair_navigation as an array (JSON)
    // ];

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

    public function repairHistories()
    {
        return $this->hasMany(RepairHistory::class);
    }

    public function repairIssueContacts()
    {
        return $this->hasMany(RepairIssueContact::class);
    }
}
