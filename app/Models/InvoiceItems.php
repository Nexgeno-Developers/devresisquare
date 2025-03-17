<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    use HasFactory;

    protected $table = 'invoice_items';

    protected $fillable = [
        'invoice_id',
        'description',
        'unit_price',
        'quantity',
        'total_price',
        'tax_rate_id'
    ];

    // Relationship with Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
