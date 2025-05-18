<?php

namespace App\Http\Controllers;

use App\Models\PegawaiActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activity = PegawaiActivity::all();
        return view('pages.activity.index', compact("activity"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jam_mulai' => 'required|date',
            'jam_selesai' => 'required|date',
        ]);

        // Simpan data ke database

        DB::beginTransaction();
        try {
            PegawaiActivity::create([
                'nama_aktivitas' => $request->nama_aktivitas,
                'deskripsi' => $request->deskripsi,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);
            DB::commit();
            return redirect()->route('activity.index')->with('success', 'Data aktivitas berhasil ditambahkan!');
        } catch (\Throwable $th) {
            dd(
                $request->toArray(),
                $th
            );
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambah data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PegawaiActivity $pegawaiActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activity = PegawaiActivity::findOrFail($id);
        return view('pages.activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
          'nama_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jam_mulai' => 'required|date',
            'jam_selesai' => 'required|date',
        ]);
        DB::beginTransaction();
        try {
            $activity = PegawaiActivity::findOrFail($id);
            $activity->update($validatedData);
            DB::commit();
            return redirect()->route('activity.index')->with('success', 'Data aktivitas berhasil diperbarui!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $activity = PegawaiActivity::findOrFail($id);
            $activity->delete();
            DB::commit();
            return redirect()->route('activity.index')->with('success', 'Data aktivitas berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage());

        }
    }
}
