<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'transaction_category_id');
    }
}
