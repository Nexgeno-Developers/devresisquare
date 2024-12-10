<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'category_id',
        'selected_properties',
        'first_name',
        'middle_name',
        'last_name',
        'full_name',
        'phone',
        'email',
        'address_line_1',
        'address_line_2',
        'postcode',
        'city',
        'country',
        'status',
        'quick_step',
        'updated_by',
        'added_by',
    ];

    // Relationship with ContactCategory model
    public function category()
    {
        return $this->belongsTo(ContactCategory::class, 'category_id');
    }

    protected $casts = [
        'selected_properties' => 'array', // Automatically casts JSON to an array
    ];

}
