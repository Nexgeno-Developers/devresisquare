<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OwnerGroup extends Model
{
    use HasFactory;

    // Specify the table if not following Laravel's naming convention
    protected $table = 'owner_group';

    // Mass-assignable attributes
    protected $fillable = [
        'property_id',
        'contact_id',
        'contact_ids',
        'purchased_date',
        'sold_date',
        'archived_date',
        'status',
    ];

    /**
     * Relationship with the EstateCharge model.
     * An OwnerGroup can have many EstateCharges.
     */
    public function estateCharges(): HasMany
    {
        return $this->hasMany(EstateCharge::class, 'ownergroup_id');
    }

    /**
     * Relationship with the Contact model.
     * An OwnerGroup belongs to a Contact.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    /**
     * Relationship with the Property model.
     * An OwnerGroup belongs to a Property.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
