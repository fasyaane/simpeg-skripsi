<x-app-layout>
    @section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-start">Data Pegawai</h2>

        {{-- Pesan sukses tampil ramping di tengah --}}


        {{-- Tombol tambah data --}}
        <div class="text-end mb-3">
            <a href="{{ route('pegawai.create') }}" class="btn" style="background-color: #007A33; color: white;">+ Tambah Data</a>
        </div>

        {{-- Tabel data --}}
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Posisi</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawais as $pegawai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $pegawai->nama_lengkap }}</td>
                        <td>{{ $pegawai->posisi }}</td>
                        <td>{{ $pegawai->tanggal_lahir }}</td>
                        <td>{{ $pegawai->jenis_kelamin }}</td>
                        <td class="text-start">{{ $pegawai->alamat }}</td>
                        <td>{{ $pegawai->no_hp }}</td>
                        <td>
                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm" style="background-color: #007A33; color: white;">
                                <i class="bi bi-pencil-square me-1"></i>
                            </a>
                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash me-1"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
    @push('scripts')
<!-- SweetAlert untuk konfirmasi hapus -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-hapus');

        forms.forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33', // tetap merah
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, hapus!',
                    customClass: {
                        cancelButton: 'btn-batal-custom'
                    }
                    // buttonsStyling TIDAK di-nonaktifkan agar confirm tetap normal
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<style>
    .swal2-popup .btn-batal-custom {
        background-color: #007A33 !important;
        color: white !important;
        border: none !important;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        font-weight: 500;
        margin-left: 10px;
    }

    .swal2-popup .btn-batal-custom:hover {
        background-color: #006127 !important;
    }
</style>
@endpush

</x-app-layout>
