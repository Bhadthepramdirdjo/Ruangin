<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';
    public $timestamps = false;

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'tipe',
        'lokasi',
        'kapasitas',
        'fasilitas',
        'keterangan',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_ruangan');
    }
}
