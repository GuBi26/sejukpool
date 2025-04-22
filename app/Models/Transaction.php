<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ticket_id',
        'tanggal_kunjungan',
        'jumlah',
        'total_harga',
        'status',
        'metode_pembayaran'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class, 'order_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'transaction_id');
    }

        public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}

