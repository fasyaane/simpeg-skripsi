<x-app-layout>
    @section('content')
        <div class="container mt-5">
            <h2 class="mb-4 text-start">Tambah Data Akun</h2>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn" style="background-color: #426B5A; color: white;">Update</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    @endsection
</x-app-layout>
