<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $fillable = [
    'admin_id',
    'nama_kos',
    'kota',
    'daerah',
    'kelas_kos',
    'alamat',
    'harga_perbulan',
    'jenis_kos',
    'fasilitas',
    'deskripsi',
    'status',
];
public function images()
{
    return $this->hasMany(KosImage::class);
}

}
