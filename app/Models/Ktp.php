<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ktp extends Model
{
    //
        protected $fillable = [
        'kartu_keluarga_id', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'golongan_darah', 'alamat','rt','rw','kelurahan','kecamatan','kabupaten','provinsi', 'agama',
        'status', 'pekerjaan', 'kewarganegaraan',
        'nama_ayah', 'nama_ibu', 'berlaku_hingga', 'file_scan'
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }
}
