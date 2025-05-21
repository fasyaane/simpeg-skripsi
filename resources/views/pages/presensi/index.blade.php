<x-app-layout>
    @section('content')
        <div class="container mt-5">
            <h3 class="fw-bold" style="color:#3e6455;">Data Presensi</h3>



            {{-- Tabel data --}}
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Aktivitas</th>
                        <th>Jam Presensi </th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensis as $presensi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $presensi->pegawais->nama_lengkap }}</td>
                            <td class="text-center">
                                {{ $presensi->activities->nama_aktivitas }} <br>
                                {{ $presensi->activities->jam_mulai }} <br>
                                {{ $presensi->activities->jam_selesai }} <br>
                            </td>
                            <td class="text-center">{{ $presensi->created_at }}</td>
                            <td class="text-center">{{ $presensi->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
    @push('scripts')
        <!-- SweetAlert untuk konfirmasi hapus -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('.form-hapus');

                forms.forEach(function(form) {
                    form.addEventListener('submit', function(e) {
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
