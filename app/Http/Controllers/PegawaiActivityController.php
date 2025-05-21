<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;

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
        $pegawai = Pegawai::all();
        return view('pages.activity.create', compact('pegawai'));

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
            'pegawai_id' => 'required|array',
        ]);



        DB::beginTransaction();
        try {
            $activity = PegawaiActivity::create([
                'nama_aktivitas' => $request->nama_aktivitas,
                'deskripsi' => $request->deskripsi,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);
            $activity->pegawais()->attach($request->pegawai_id);
            // dd($activity->toArray());
            $fileName = 'qr_' . time() . '.png';


            $filePath = 'qrcodes/' .$activity->uuid.'/'. $fileName;

            $qrImage = QrCode::format('png')
                ->size(300)
                ->errorCorrection('H')
                ->generate($activity->uuid);

            Storage::disk('public')->put($filePath, $qrImage);

            // ✅ Update kolom qrcode_path setelah file disimpan
            $activity->update([
                'qrcode_path' => $filePath,
            ]);
            DB::commit();
            return redirect()->route('activity.index')->with('success', 'Data aktivitas berhasil ditambahkan!');

        } catch (\Throwable $th) {
            // phpinfo();
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
        $pegawai = Pegawai::all();
        $activity = PegawaiActivity::findOrFail($id);
        $pegawais = $activity->pegawais->pluck('id')->toArray();
        // dd($pegawai->toArray(), $activity->toArray(),$pegawais);
        return view('pages.activity.edit', compact('activity', 'pegawai', 'pegawais'));
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
            'pegawai_id' => 'required|array',

        ]);

        DB::beginTransaction();
        try {
            $activity = PegawaiActivity::findOrFail($id);
            $activity->update($validatedData);
            $activity->pegawais()->sync($request->pegawai_id);
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

        // Hapus folder QR code berdasarkan UUID
        $uuid = $activity->uuid;
        $folderPath = 'qrcodes/' . $uuid;
        Storage::disk('public')->deleteDirectory($folderPath);

        // Hapus data aktivitas
        $activity->delete();

        DB::commit();
        return redirect()->route('activity.index')->with('success', 'Data aktivitas berhasil dihapus!');
    } catch (\Throwable $th) {
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage());
    }
}
}
