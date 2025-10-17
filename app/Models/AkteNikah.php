<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkteNikah extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'suami_ktp_id',
        'istri_ktp_id',
        'no_akte',
        'tanggal_nikah',
        'tempat_nikah',
        'nama_penghulu',
        'file_scan',
    ];

    public function suami()
    {
        return $this->belongsTo(Ktp::class, 'suami_ktp_id');
    }

    public function istri()
    {
        return $this->belongsTo(Ktp::class, 'istri_ktp_id');
    }
}
