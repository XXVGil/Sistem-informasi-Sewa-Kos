<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kos_id',
        'lama_sewa',
        'total_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status',
    ];

    // 🔗 BOOKING MILIK USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 BOOKING UNTUK KOS
    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
