<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'harga'];

    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}

