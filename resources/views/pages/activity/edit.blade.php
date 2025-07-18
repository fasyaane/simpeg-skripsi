<x-app-layout>
    @section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-start">Edit Data Aktivitas</h2>

        <form action="{{ route('activity.update', $activity->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                    <label class="form-label">Nama Aktivitas</label>
                    <input type="text" name="nama_aktivitas" class="form-control" value="{{ old('nama_aktivitas', $activity->nama_aktivitas) }}"
                        required>
                    @error('nama_aktivitas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi',$activity->deskripsi) }}" required>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="datetime-local" name="jam_mulai" class="form-control" value="{{ old('jam_mulai',$activity->jam_mulai) }}" required>
                    @error('jam_mulai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="datetime-local" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', $activity->jam_selesai) }}" required>
                    @error('jam_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Akun User</label>
                    <select name="pegawai_id[]" class="form-control select2" required multiple>
                        <option value="">-- Pilih User --</option>
                        @foreach ($pegawai as $pegawai)
                            <option value="{{ $pegawai->id }}" {{ in_array($pegawai->id,$pegawais)? 'selected' : '' }}>
                                {{ $pegawai->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @error('pegawai_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            <button type="submit" class="btn" style="background-color: #426B5A; color: white;">Update</button>
            <a href="{{ route('activity.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    @endsection
     @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
     @push('scripts')
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "-- Pilih User --",
                    allowClear: false,
                    width: '100%'
                });
            });
        </script>
    @endpush
</x-app-layout>
