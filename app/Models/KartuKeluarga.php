<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    //
    protected $fillable = [
        'no_kk',
        'nama_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'tanggal_terbit',
        'file_scan'
    ];

    public function ktps()
    {
        return $this->hasMany(Ktp::class);
    }
    public function anggotas()
    {
        return $this->hasMany(Ktp::class, 'kartu_keluarga_id');
    }
}
