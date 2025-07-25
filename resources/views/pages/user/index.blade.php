<x-app-layout>
    @section('content')
    <div class="container mt-5">
        <h3 class="fw-bold" style="color:#3e6455;">Data Akun</h3>


        <div class="text-end mb-3">
            <a href="{{ route('user.create') }}" class="btn" style="background-color: #3e6455; color: white;">+ Tambah Data</a>
        </div>

        {{-- Tabel data --}}
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm" style="background-color: #3e6455; color: white;">
                                <i class="bi bi-pencil-square me-1"></i>
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline form-hapus">
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

@endpush

</x-app-layout>
