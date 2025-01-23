<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairIssueContact extends Model
{
    use HasFactory;

    protected $fillable = ['repair_issue_id', 'contact_id', 'contact_category_name'];

    public function repairIssue()
    {
        return $this->belongsTo(RepairIssue::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

