<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    // actual DB primary key is `id` (from database dump)
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        // keep DB column names here
        'nama_ruangan',
        'kode',
        'kapasitas',
        'tipe',
        'status',
        'dibuat',
        'diubah',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'ruangan_id', 'id');
    }

    // Accessors to keep compatibility with existing views that expect
    // `id_ruangan`, `nama_ruang`, `kode_ruang` and `lokasi` attributes.
    // These map to the actual DB columns used in the SQL dump.
    public function getIdRuanganAttribute()
    {
        return $this->attributes['id'] ?? null;
    }

    public function getNamaRuangAttribute()
    {
        return $this->attributes['nama_ruangan'] ?? null;
    }

    public function getKodeRuangAttribute()
    {
        return $this->attributes['kode'] ?? null;
    }

    public function getLokasiAttribute()
    {
        // database doesn't have `lokasi` column in dump; fall back to status if available
        return $this->attributes['lokasi'] ?? ($this->attributes['status'] ?? null);
    }

    public function getKeteranganAttribute()
    {
        return $this->attributes['keterangan'] ?? null;
    }
}
