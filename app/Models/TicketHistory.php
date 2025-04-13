<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'jumlah',
        'tanggal_pemesanan',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
