<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    // Menampilkan semua data pegawai
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('pages.pegawai.index', compact('pegawais'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        $users = User::whereDoesntHave('pegawai')->get();

        return view('pages.pegawai.create', compact('users'));
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|unique:pegawais,user_id',
            'nama_lengkap' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        DB::beginTransaction();
        try {
            $pegawai = new Pegawai();
            $pegawai->user_id = $request->user_id;
            $pegawai->nama_lengkap = $request->nama_lengkap;
            $pegawai->alamat = $request->alamat;
            $pegawai->posisi = $request->posisi;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->no_hp = $request->no_hp;
            $pegawai->save();
            DB:
            DB::commit();
            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambah pegawai: ' . $th->getMessage());
        }

    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pages.pegawai.edit', compact('pegawai'));
    }

    // Memperbarui data pegawai
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        DB::beginTransaction();
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update($validatedData);
            DB::commit();
            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui pegawai: ' . $th->getMessage());
        }

    }

    // Menghapus data pegawai
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();
            DB::commit();
            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menghapus pegawai: ' . $th->getMessage());

        }
    }
}
