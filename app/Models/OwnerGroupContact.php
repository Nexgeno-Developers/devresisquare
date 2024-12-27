<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OwnerGroupContact extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'owner_group_id',
        'contact_id',
        'is_main',
        'added_by', // Add added_by field to fillable
        'updated_by', // Add updated_by field to fillable
        'deleted_by', // Add deleted_by field to fillable
    ];

    // Define the relationship with the OwnerGroup model
    public function ownerGroup(): BelongsTo
    {
        return $this->belongsTo(OwnerGroup::class, 'owner_group_id');
    }


    /**
     * Relationship with the Contact model.
     * An OwnerGroup belongs to a Contact.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }


}
