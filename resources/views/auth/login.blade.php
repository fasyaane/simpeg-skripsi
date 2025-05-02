{{-- resources/views/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Kepegawaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center" style="width: 100%; max-width: 400px;">

            <!-- Logo -->
            <img src="{{ asset('img/logoak.png') }}" alt="Logo" style="width: 100px; height: auto; margin-bottom: 20px;">

            <!-- Judul -->
            <h4 class="mb-0">Sistem Manajemen Kepegawaian</h4>
            <p class="mb-4">Pesantren Yatim Al-Kasyaf</p>

            <!-- Tampilkan pesan error -->
            @if ($errors->any())
                <div class="alert alert-danger text-start">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Nama Pengguna</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn w-100" style="background-color: #007A33; color: white;">Masuk</button>

            </form>

        </div>
    </div>
</body>
</html>

