<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PegawaiActivity extends Model
{
    protected $fillable = [
        'nama_aktivitas',
        'deskripsi',
        'jam_mulai',
        'jam_selesai',
        'qrcode_path',
    ];

    public function pegawais()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_activity_pegawai');

    }
      public function presensis()
    {
        return $this->hasMany(Presensi::class,'activity_id');

    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }
}

