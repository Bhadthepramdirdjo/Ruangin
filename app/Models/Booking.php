<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ruangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keperluan',
        'dokumen',
        'status',
        'dibuat',
        'diubah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruangan()
    {
        // ruangan table primary key is `id` according to DB dump
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }
}
