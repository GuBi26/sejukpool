<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'tanggal_kunjungan',
        'jumlah',
        'total_harga',
        'status',
        'tipe_transaksi',
        'nama_pembeli',
        'voucher_code',         // Tambahkan ini
        'discount_applied',     // Tambahkan ini
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

}
