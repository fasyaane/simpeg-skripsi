<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'activity_id',
        'status',
    ];

    public function pegawai()  // dari pegawais jadi pegawai (tunggal)
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function aktivitas()  // dari activities jadi aktivitas (tunggal)
    {
        return $this->belongsTo(PegawaiActivity::class, 'activity_id');
    }
}
