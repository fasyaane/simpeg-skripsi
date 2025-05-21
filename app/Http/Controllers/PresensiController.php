<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    // Menampilkan semua data pegawai
    public function index()
    {
        $presensis = Presensi::all();
        return view('pages.presensi.index', compact('presensis'));
    }
}
