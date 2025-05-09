<x-app-layout>
    @section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-start">Edit Data Pegawai</h2>

        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Posisi</label>
                <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $pegawai->posisi) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pegawai->no_hp) }}" required>
            </div>

            <button type="submit" class="btn" style="background-color: #426B5A; color: white;">Update</button>
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    @endsection
</x-app-layout>
