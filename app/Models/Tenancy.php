<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenancy extends Model
{
    /** @use HasFactory<\Database\Factories\TenancyFactory> */
    use HasFactory;

    protected $fillable = [
        'property_id', 'offer_id', 'sub_status', 'move_in', 'move_out',
        'tenancy_length', 'extension_date', 'price', 'frequency', 'status'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function tenantMembers()
    {
        return $this->hasMany(TenantMember::class);
    }
}
