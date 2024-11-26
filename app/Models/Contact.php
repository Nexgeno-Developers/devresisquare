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
        'updated_by',
    ];

    // Relationship with ContactCategory model
    public function category()
    {
        return $this->belongsTo(ContactCategory::class, 'category_id');
    }
}