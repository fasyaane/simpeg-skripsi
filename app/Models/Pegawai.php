<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'posisi',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function activities()
    {
        return $this->belongsToMany(PegawaiActivity::class,'pegawai_activity_pegawai');

    }
    public function presensis()
    {
        return $this->hasMany(Presensi::class,'pegawai_id');

    }
}
