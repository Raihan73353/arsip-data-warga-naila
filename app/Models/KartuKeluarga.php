<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    //
    protected $fillable = [
        'no_kk',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'tanggal_terbit',
        'file_scan',
        'kepala_keluarga_id',
        'isteri_id',
    ];

    public function ktps()
    {
        return $this->hasMany(Ktp::class);
    }
    public function anggotas()
    {
        return $this->hasMany(Ktp::class, 'kartu_keluarga_id');
    }
    public function kepalaKeluarga()
    {
        return $this->belongsTo(Ktp::class, 'kepala_keluarga_id');
    }
    public function simamak()
    {
        return $this->belongsTo(Ktp::class, 'isteri_id');
    }
    public static function generateNoKK()
    {
        $kodeDaerah = '1234';
        $tanggal = now()->format('dmy');
        $acak = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return $kodeDaerah . $tanggal . $acak;
    }
}
