@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3 class="fw-bold mb-4" style="color:#3e6455;">Selamat datang, Admin</h3>

        <div class="row g-4">
            <!-- Total Pegawai -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0" style="background-color: #d1e7dd;">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-people-fill fs-1 me-3" style="color: #0f5132;"></i>
                        <div>
                            <div class="text-muted small">Total Pegawai</div>
                            <div class="fs-4 fw-bold text-success">30</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pegawai Aktif -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0" style="background-color: #cfe2ff;">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-person-check-fill fs-1 me-3" style="color: #084298;"></i>
                        <div>
                            <div class="text-muted small">Pegawai Aktif</div>
                            <div class="fs-4 fw-bold" style="color: #27548A;">30</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pegawai Nonaktif -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0" style="background-color: #f8d7da;">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-person-x-fill fs-1 me-3" style="color: #842029;"></i>
                        <div>
                            <div class="text-muted small">Pegawai Nonaktif</div>
                            <div class="fs-4 fw-bold text-danger">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
