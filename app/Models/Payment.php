<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'status_code', 'transaction_status'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'order_id');
    }
}

