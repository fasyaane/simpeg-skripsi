@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color:#3e6455;">Presensi Hari Ini</h3>
            <p id="clock" class="text-muted"></p>
        </div>

        {{-- Area scanner QR --}}
        <div class="d-flex justify-content-center">
            <div style="border: 3px solid #007A33; border-radius: 10px; padding: 10px; width: fit-content;">
                <div id="reader" style="width: 300px; height: 225px;"></div>
            </div>
        </div>


        {{-- Form tersembunyi untuk submit --}}
        <form id="submitForm" method="POST" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="qr_result" id="qr_result">
            <input type="hidden" name="snapshot" id="snapshot">
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success d-none" id="btnSubmit">Kirim Presensi</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- HTML5 QR Code --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        // ⏰ Live Clock
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText =
                now.toLocaleString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
        }
        setInterval(updateClock, 1000);
        updateClock();


        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('qr_result').value = decodedText;

            Swal.fire({
                icon: 'success',
                title: 'Presensi berhasil discan!',
                text: 'Data akan dikirim otomatis.',
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                document.getElementById('submitForm').submit();
            }, 1600); // kasih waktu nunggu alert
        }

        function onScanError(errorMessage) {
            console.warn(`Scan error: ${errorMessage}`);
        }

        // buat scamner
        const html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start({
                facingMode: "environment"
            }, {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            onScanError
        ).catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Akses Kamera Gagal',
                text: err
            });
        });
    </script>
@endpush
