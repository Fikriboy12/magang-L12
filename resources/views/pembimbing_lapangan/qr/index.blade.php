@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>QR Presensi Dinamis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">QR Presensi</div>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: QR Dinamis 10 Detik --}}
        <div class="col-lg-7 col-md-12 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #e2e8f0;">
                    <div>
                        <h6 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-qrcode text-primary mr-2"></i> QR Code Presensi Siswa
                        </h6>
                        <small class="text-muted" id="qr-date">{{ $today->translatedFormat('l, d F Y') }}</small>
                    </div>
                    <span class="badge badge-primary px-3 py-2" style="border-radius: 50px; background-color: #0284c7;">
                        Dinamis 10 Detik
                    </span>
                </div>

                <div class="card-body text-center py-4">
                    {{-- Jam Server Real-Time --}}
                    <div class="mb-3">
                        <span class="text-muted small d-block">Waktu Server (WIB)</span>
                        <h3 class="font-weight-bold text-dark mb-0" id="live-clock">--:--:--</h3>
                    </div>

                    {{-- Kontainer QR --}}
                    <div class="d-inline-block p-4 bg-white border mb-3" style="border-radius: 16px; border-color: #e2e8f0 !important;">
                        <div id="qrcode" class="d-flex justify-content-center align-items-center" style="width: 260px; height: 260px;">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                    </div>

                    {{-- Countdown Bar 10 Detik --}}
                    <div class="mx-auto mb-3" style="max-width: 300px;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted font-weight-bold">QR diperbarui otomatis dalam</small>
                            <span class="font-weight-bold" style="color: #0284c7;" id="countdown-text">10 detik</span>
                        </div>
                        <div class="progress" style="height: 7px; border-radius: 10px; background: #e2e8f0;">
                            <div id="countdown-bar" class="progress-bar" role="progressbar" style="width: 100%; background-color: #0284c7; transition: width 0.9s linear;"></div>
                        </div>
                    </div>

                    <button type="button" id="btn-refresh-qr" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 10px;">
                        <i class="fas fa-sync-alt mr-1"></i> Perbarui QR Sekarang
                    </button>

                    {{-- Aturan Presensi Sesuai Flowchart --}}
                    <div class="row mt-4 text-left">
                        <div class="col-md-4 mb-2">
                            <div class="p-3 rounded" style="background: #ecfdf5; border: 1px solid #a7f3d0;">
                                <div class="font-weight-bold small" style="color: #059669;">07:00 – 08:00 WIB</div>
                                <div class="text-muted" style="font-size: 12px;">Status tercatat <strong>Hadir</strong></div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="p-3 rounded" style="background: #fffbeb; border: 1px solid #fde68a;">
                                <div class="font-weight-bold small" style="color: #d97706;">Lewat 08:00 WIB</div>
                                <div class="text-muted" style="font-size: 12px;">Status tercatat <strong>Terlambat</strong></div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="p-3 rounded" style="background: #fef2f2; border: 1px solid #fecaca;">
                                <div class="font-weight-bold small" style="color: #dc2626;">Anti-Screenshot</div>
                                <div class="text-muted" style="font-size: 12px;">Kedaluwarsa setelah <strong>10 detik</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Live Feed Scan Siswa --}}
        <div class="col-lg-5 col-md-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #e2e8f0;">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-history text-primary mr-2"></i> Aktivitas Scan Terbaru
                    </h6>
                    <span class="badge badge-light text-muted">Live Feed</span>
                </div>
                <div class="card-body p-0">
                    <div id="live-scans-list" class="list-group list-group-flush">
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-qrcode fa-2x mb-2 text-light d-block"></i>
                            Menunggu siswa memindai QR Code...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const qrContainer = document.getElementById('qrcode');
    const countdownText = document.getElementById('countdown-text');
    const countdownBar = document.getElementById('countdown-bar');
    const liveClock = document.getElementById('live-clock');
    const liveScansList = document.getElementById('live-scans-list');
    const btnRefresh = document.getElementById('btn-refresh-qr');

    let currentInterval = 10;
    let remainingSeconds = 10;
    let qrInstance = null;

    function updateClock() {
        const now = new Date();
        const pad = n => String(n).padStart(2, '0');
        liveClock.textContent = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
    }
    updateClock();
    setInterval(updateClock, 1000);

    function fetchQrToken() {
        fetch("{{ route('pembimbing_lapangan.qr.token') }}", {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                currentInterval = data.interval || 10;
                remainingSeconds = currentInterval;
                qrContainer.innerHTML = '';
                qrInstance = new QRCode(qrContainer, {
                    text: data.qr_payload,
                    width: 260,
                    height: 260,
                    colorDark: '#0f172a',
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.M
                });
                updateCountdownUI();
            }
        })
        .catch(() => {});
    }

    function updateCountdownUI() {
        countdownText.textContent = `${remainingSeconds} detik`;
        const pct = Math.max(0, (remainingSeconds / currentInterval) * 100);
        countdownBar.style.width = `${pct}%`;
    }

    function fetchRecentScans() {
        fetch("{{ route('pembimbing_lapangan.qr.recent') }}", {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && Array.isArray(data.scans) && data.scans.length > 0) {
                liveScansList.innerHTML = data.scans.map(item => `
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="font-weight-bold text-dark">${item.nama || 'Siswa'}</div>
                            <small class="text-muted">${item.waktu || ''}</small>
                        </div>
                        <span class="badge badge-info px-2 py-1" style="border-radius: 50px;">${item.tipe || 'Hadir'} • ${(item.jam || '').substring(0,5)}</span>
                    </div>
                `).join('');
            }
        })
        .catch(() => {});
    }

    setInterval(() => {
        remainingSeconds--;
        if (remainingSeconds <= 0) {
            fetchQrToken();
        } else {
            updateCountdownUI();
        }
    }, 1000);

    setInterval(fetchRecentScans, 4000);
    btnRefresh.addEventListener('click', fetchQrToken);

    fetchQrToken();
    fetchRecentScans();
});
</script>
@endsection
