<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nilai_diskon', 'kuota', 'tanggal_berlaku', 'tanggal_expired', 'status'];

    protected static function booted()
    {
        static::updating(function ($voucher) {
            if ($voucher->kuota <= 0) {
                $voucher->status = 'habis';
            }
        });
    }

    public function isExpired()
    {
        return Carbon::today()->gt($this->tanggal_expired);
    }
    
    public function isActive()
    {
        return $this->status === 'active' && !$this->isExpired() && $this->kuota > 0;
    }

}
