<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketVerification extends Model
{
    use HasFactory;

    protected $fillable = ['order_item_id', 'verified_by', 'waktu_verifikasi', 'status'];

    public function transactionItem(): BelongsTo
    {
        return $this->belongsTo(TransactionItem::class, 'order_item_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}

