<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'ticket_id', 'jumlah_tiket', 'subtotal_harga'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'order_id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function verification(): HasOne
    {
        return $this->hasOne(TicketVerification::class, 'order_item_id');
    }
}

