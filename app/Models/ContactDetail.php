<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'employment_status',
        'business_name',
        'guarantee',
        'previously_rented',
        'poor_credit',
    ];

    /**
     * Define relationship with Contact model.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
