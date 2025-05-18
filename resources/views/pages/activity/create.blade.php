<x-app-layout>
    @section('content')
        <div class="container mt-5">
            <h2 class="mb-4 text-start">Tambah Data Aktivitas</h2>

            <form action="{{ route('activity.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Aktivitas</label>
                    <input type="text" name="nama_aktivitas" class="form-control" value="{{ old('nama_aktivitas') }}"
                        required>
                    @error('nama_aktivitas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}" required>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="datetime-local" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="datetime-local" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                <button type="submit" class="btn" style="background-color: #426B5A; color: white;">Simpan</button>
                <a href="{{ route('activity.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    @endsection
</x-app-layout>
