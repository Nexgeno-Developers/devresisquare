<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
{
    use HasFactory;

    protected $table = 'contacts_categories';

    protected $fillable = [
        'name',
        'status',
    ];

    // Relationship with Contact model
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'category_id');
    }
}
