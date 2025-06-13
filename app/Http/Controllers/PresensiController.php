<?php

namespace App\Http\Controllers;

use App\Models\PegawaiActivity;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function create()
    {
        // Tampilkan halaman scan QR
        return view('pages.absen.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string|exists:pegawai_activities,uuid',
            'status' => 'required|in:masuk,keluar',
        ]);

        $pegawai = Auth::user(); // asumsi pegawai sudah login dan auth guard pegawai aktif

        $activity = PegawaiActivity::where('uuid', $request->uuid)->first();

        if (!$activity) {
            return back()->with('error', 'Aktivitas tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            Presensi::create([
                'pegawai_id' => $pegawai->id,
                'activity_id' => $activity->id,
                'status' => $request->status,
            ]);
            DB::commit();
            return back()->with('success', 'Presensi berhasil disimpan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan presensi: ' . $e->getMessage());
        }
    }
}


