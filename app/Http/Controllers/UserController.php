<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Menampilkan semua data pegawai
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('pages.user.create');
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);
        DB::beginTransaction();
        try {
            User::create($validatedData);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Data akun berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambah akun: ' . $th->getMessage());
        }
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    // Memperbarui data pegawai
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);
        DB::beginTransaction();
        try {
            if (empty($validatedData['password'])) {
                unset($validatedData['password']);
            } else {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $user = User::findOrFail($id);
            $user->update($validatedData);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Data akun berhasil diperbarui!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui akun: ' . $th->getMessage());
        }
    }

    // Menghapus data pegawai
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();

            return redirect()->route('user.index')->with('success', 'Data akun berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menghapus akun: ' . $th->getMessage());
        }
    }
}
