<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantMember extends Model
{
    /** @use HasFactory<\Database\Factories\TenantMemberFactory> */
    use HasFactory;

    protected $fillable = [
        'tenancy_id', 'name', 'email', 'phone', 'is_main_person', 'group_id'
    ];

    public function tenancy()
    {
        return $this->belongsTo(Tenancy::class);
    }
}
