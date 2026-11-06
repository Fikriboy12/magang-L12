@extends('template_admin.master')

@section('title', 'Layar QR Presensi Dinamis - PT. MEDIA BALAI NUSA')

@section('contents')
<div class="content-wrapper">
    <section class="content-header pb-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <h1 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-qrcode text-info mr-2"></i>Layar QR Presensi Dinamis
                </h1>
                <p class="text-muted mb-0">
                    Sistem Presensi Siswa Magang Terintegrasi Aplikasi Mobile &mdash; <strong>PT. MEDIA BALAI NUSA</strong>
                </p>
            </div>
            <div class="d-flex align-items-center">
                <button type="button" id="btn-sound-toggle" class="btn btn-outline-info btn-sm mr-2 shadow-sm font-weight-bold" style="border-radius: 8px;">
                    <i class="fas fa-volume-up mr-1" id="sound-icon"></i> <span id="sound-text">Suara: Aktif</span>
                </button>
                <button type="button" id="btn-fullscreen" class="btn btn-info btn-sm mr-2 shadow-sm font-weight-bold" style="background: linear-gradient(135deg, #0284c7, #3CB9E0); border: none; border-radius: 8px;">
                    <i class="fas fa-expand mr-1"></i> Mode Layar Penuh (Kiosk)
                </button>
                <a href="{{ route('admin.absensi.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm font-weight-bold" style="border-radius: 8px;">
                    <i class="fas fa-arrow-left mr-1"></i> Data Absensi
                </a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                {{-- KOLOM UTAMA: QR CODE DISPLAY --}}
                <div class="col-lg-7 col-md-12 mb-4">
                    <div class="card shadow-sm border-0" id="kiosk-card" style="border-radius: 16px; overflow: hidden; background: #ffffff;">
                        {{-- CARD HEADER DENGAN STATUS LIVE --}}
                        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-success p-2 mr-2 d-flex align-items-center shadow-sm" style="border-radius: 30px; font-size: 12px; font-weight: 700;">
                                    <span class="live-indicator-dot mr-1"></span> LIVE MONITOR
                                </span>
                                <span class="text-muted font-weight-bold" id="live-date">Memuat tanggal...</span>
                            </div>
                            <div class="digital-clock font-weight-bold text-primary" id="live-clock" style="font-size: 1.3rem; letter-spacing: 1px;">
                                --:--:-- WIB
                            </div>
                        </div>

                        <div class="card-body text-center py-4 px-3">
                            <h5 class="text-dark font-weight-bold mb-1">Pindai QR Menggunakan Aplikasi Mobile</h5>
                            <p class="text-muted small mb-3">Arahkan kamera scanner aplikasi magang ke QR Code di bawah ini</p>

                            {{-- QR CODE WRAPPER --}}
                            <div class="d-flex justify-content-center my-2">
                                <div class="qr-box-container p-3 position-relative shadow-sm" style="background: #ffffff; border: 3px solid #e0f2fe; border-radius: 20px;">
                                    <div id="qrcode-display" style="width: 260px; height: 260px; display: flex; align-items: center; justify-content: center;">
                                        <div class="spinner-border text-info" role="status">
                                            <span class="sr-only">Membuat QR...</span>
                                        </div>
                                    </div>
                                    <div class="qr-glow-effect"></div>
                                </div>
                            </div>

                            {{-- COUNTDOWN & TIMER PROGRESS --}}
                            <div class="mt-3 px-md-4">
                                <div class="d-flex justify-content-between align-items-center mb-1 font-weight-bold" style="font-size: 13px;">
                                    <span class="text-muted"><i class="fas fa-sync-alt fa-spin mr-1 text-info"></i> Otomatis berganti dalam:</span>
                                    <span class="badge badge-pill badge-primary px-3 py-1 font-weight-bold shadow-sm" id="countdown-badge" style="font-size: 13px; background: #0284c7;">
                                        <span id="countdown-number">20</span> Detik
                                    </span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 10px; background-color: #f1f5f9;">
                                    <div id="countdown-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%; background: linear-gradient(90deg, #3CB9E0, #0284c7); border-radius: 10px;"></div>
                                </div>
                            </div>

                            {{-- BADGE KEAMANAN ANTI-SCREENSHOT --}}
                            <div class="alert alert-light border mt-4 mb-0 mx-md-3 py-2 px-3 text-left d-flex align-items-center" style="border-radius: 12px; background: #f8fafc;">
                                <div class="mr-3 text-primary" style="font-size: 24px;">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div style="font-size: 12px; line-height: 1.4;">
                                    <strong class="text-dark">Keamanan Anti-Screenshot & Anti-Joki:</strong><br>
                                    <span class="text-muted">Kode QR ini diperbarui otomatis setiap 20 detik. Foto layar atau screenshot tidak akan bisa dipakai untuk menitip absen.</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light py-2 text-center text-muted small">
                            Token Aktif: <code id="active-token-text" class="text-info font-weight-bold">Memuat token...</code>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: LIVE RECENT SCANS & PANDUAN SISWA --}}
                <div class="col-lg-5 col-md-12 mb-4">
                    {{-- CARD LIVE LOG SCANS --}}
                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; background: #ffffff;">
                        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-history text-info mr-2"></i>Log Pemindaian Hari Ini
                            </h6>
                            <span class="badge badge-light border text-muted" id="scan-count-badge">0 aktivitas</span>
                        </div>
                        <div class="card-body p-0" style="max-height: 330px; overflow-y: auto;" id="recent-scans-container">
                            <div class="text-center py-5 text-muted" id="scans-empty-state">
                                <i class="fas fa-mobile-alt fa-3x text-light mb-2"></i>
                                <p class="small mb-0">Belum ada siswa yang melakukan scan hari ini.</p>
                                <span class="badge badge-light border mt-1">Menunggu pemindaian...</span>
                            </div>
                            <ul class="list-group list-group-flush" id="scans-list" style="display: none;">
                                {{-- Diisi dinamis via AJAX --}}
                            </ul>
                        </div>
                    </div>

                    {{-- CARD PANDUAN SINGKAT PENGGUNAAN --}}
                    <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #0284c7, #1e3c72); color: white;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold mb-3 d-flex align-items-center">
                                <i class="fas fa-info-circle mr-2" style="color: #7dd3fc;"></i> Petunjuk Siswa Magang
                            </h6>
                            <div class="d-flex align-items-start mb-2">
                                <div class="step-badge mr-3">1</div>
                                <div class="small">Buka <strong>Aplikasi Mobile Magang</strong> di ponsel pintar Anda.</div>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <div class="step-badge mr-3">2</div>
                                <div class="small">Pilih menu <strong>Absensi</strong> lalu klik tombol <strong>Scan QR</strong>.</div>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <div class="step-badge mr-3">3</div>
                                <div class="small">Arahkan kamera ke layar ini sebelum hitung mundur 20 detik habis.</div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="step-badge mr-3">4</div>
                                <div class="small">Sistem langsung mencatat <strong>Jam Masuk / Jam Pulang</strong> Anda secara otomatis.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- MODAL FULLSCREEN KIOSK OVERLAY (Jika Admin Memilih Fullscreen) --}}
<div id="kiosk-fullscreen-overlay" class="kiosk-overlay" style="display: none;">
    <div class="kiosk-header">
        <div class="d-flex align-items-center">
            <img src="{{ asset('gambar/AMS-logo.png') }}" alt="Logo" style="height: 48px;" class="mr-3 rounded bg-white p-1">
            <div>
                <h3 class="mb-0 font-weight-bold text-white">PT. MEDIA BALAI NUSA</h3>
                <span class="text-light" style="font-size: 14px; opacity: 0.9;">Kios Presensi Digital &mdash; Scan QR via APK Mobile</span>
            </div>
        </div>
        <div class="text-right d-flex align-items-center">
            <div class="kiosk-clock mr-4 text-white font-weight-bold" id="kiosk-clock-display" style="font-size: 2rem;">
                --:--:-- WIB
            </div>
            <button type="button" class="btn btn-outline-light btn-sm font-weight-bold px-3 py-2" id="btn-exit-fullscreen" style="border-radius: 8px;">
                <i class="fas fa-compress mr-1"></i> Tutup Layar Penuh
            </button>
        </div>
    </div>

    <div class="kiosk-body d-flex flex-column align-items-center justify-content-center">
        <div class="kiosk-qr-card text-center p-4 shadow-lg">
            <div class="badge badge-success px-3 py-2 mb-3" style="font-size: 14px; border-radius: 30px;">
                <span class="live-indicator-dot mr-1"></span> MODE KIOSK AKTIF &mdash; ANTI SCREENSHOT (20 DETIK)
            </div>
            <div class="d-flex justify-content-center mb-3">
                <div class="p-3 bg-white rounded shadow-sm border" style="display: inline-block;">
                    <div id="qrcode-kiosk" style="width: 320px; height: 320px; display: flex; align-items: center; justify-content: center;">
                        <div class="spinner-border text-info" role="status"></div>
                    </div>
                </div>
            </div>
            <div class="kiosk-progress-container px-4">
                <div class="d-flex justify-content-between align-items-center mb-1 text-white font-weight-bold">
                    <span>Otomatis berganti dalam:</span>
                    <span id="kiosk-countdown-number" class="badge badge-warning text-dark font-weight-bold px-2 py-1" style="font-size: 14px;">20 Detik</span>
                </div>
                <div class="progress" style="height: 10px; border-radius: 10px;">
                    <div id="kiosk-countdown-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 100%;"></div>
                </div>
            </div>
            <div class="mt-3 text-light small opacity-80">
                Arahkan kamera scan APK siswa ke layar ini untuk mencatat presensi masuk/pulang.
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Load QRCode.js lokal --}}
<script src="{{ asset('assets_admin/js/qrcode.min.js') }}"></script>

<style>
.live-indicator-dot {
    width: 8px;
    height: 8px;
    background-color: #22c55e;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 rgba(34, 197, 94, 0.7);
    animation: pulseDot 1.5s infinite;
}
@keyframes pulseDot {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); }
    100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}

.step-badge {
    width: 26px;
    height: 26px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    flex-shrink: 0;
}

/* Kiosk Fullscreen Overlay */
.kiosk-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0284c7 100%);
    z-index: 99999;
    padding: 30px 40px;
    display: flex;
    flex-direction: column;
}
.kiosk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    padding-bottom: 20px;
}
.kiosk-body {
    flex: 1;
}
.kiosk-qr-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    max-width: 480px;
    width: 100%;
}
.new-scan-pulse {
    animation: flashGreen 2s ease-out;
}
@keyframes flashGreen {
    0% { background-color: #dcfce7; }
    100% { background-color: transparent; }
}
</style>

<script>
$(document).ready(function() {
    let currentInterval = 20; // Berganti setiap 20 detik
    let remainingSeconds = 20;
    let timerInterval = null;
    let soundEnabled = true;
    let qrGeneratorMain = null;
    let qrGeneratorKiosk = null;
    let knownScanKeys = new Set();
    let isFetchingToken = false;

    // Inisialisasi Audio Chime via Web Audio API (Tanpa perlu file audio eksternal)
    function playChimeSound() {
        if (!soundEnabled) return;
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!AudioContext) return;
            const ctx = new AudioContext();
            
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
            osc.frequency.setValueAtTime(880.00, ctx.currentTime + 0.1); // A5
            
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.5);
            
            osc.connect(gain);
            gain.connect(ctx.destination);
            
            osc.start();
            osc.stop(ctx.currentTime + 0.5);
        } catch (e) {
            console.log('Audio not supported or blocked');
        }
    }

    // Toggle Sound Button
    $('#btn-sound-toggle').on('click', function() {
        soundEnabled = !soundEnabled;
        if (soundEnabled) {
            $('#sound-icon').attr('class', 'fas fa-volume-up mr-1');
            $('#sound-text').text('Suara: Aktif');
            $(this).removeClass('btn-outline-secondary').addClass('btn-outline-info');
            playChimeSound();
        } else {
            $('#sound-icon').attr('class', 'fas fa-volume-mute mr-1');
            $('#sound-text').text('Suara: Mute');
            $(this).removeClass('btn-outline-info').addClass('btn-outline-secondary');
        }
    });

    // Jam Digital Live
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds} WIB`;
        
        $('#live-clock').text(timeString);
        $('#kiosk-clock-display').text(timeString);
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Fungsi Render QR Code ke DOM
    function renderQrCode(payloadText) {
        // Main QR Display
        const mainContainer = document.getElementById('qrcode-display');
        mainContainer.innerHTML = '';
        qrGeneratorMain = new QRCode(mainContainer, {
            text: payloadText,
            width: 260,
            height: 260,
            colorDark: "#0f172a",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.M
        });

        // Kiosk QR Display
        const kioskContainer = document.getElementById('qrcode-kiosk');
        if (kioskContainer) {
            kioskContainer.innerHTML = '';
            qrGeneratorKiosk = new QRCode(kioskContainer, {
                text: payloadText,
                width: 320,
                height: 320,
                colorDark: "#0f172a",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.M
            });
        }
    }

    // Fungsi Mengambil Token QR Baru dari Backend
    function fetchNewQrToken() {
        if (isFetchingToken) return;
        isFetchingToken = true;

        $.ajax({
            url: "{{ route('admin.absensi.qr.token') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                isFetchingToken = false;
                if (response.status === 'success') {
                    // Update Text
                    $('#active-token-text').text(response.token);
                    if (response.date_formatted) {
                        $('#live-date').text(response.date_formatted);
                    }

                    // Render QR
                    renderQrCode(response.qr_payload || response.token);

                    // Reset Timer Countdown
                    currentInterval = response.interval || 20;
                    remainingSeconds = currentInterval;
                    updateCountdownDisplay();
                }
            },
            error: function(err) {
                isFetchingToken = false;
                console.error('Gagal mengambil token QR:', err);
                $('#active-token-text').text('Gagal memuat token. Mencoba lagi...');
            }
        });
    }

    // Update Visual Countdown
    function updateCountdownDisplay() {
        $('#countdown-number').text(remainingSeconds);
        $('#kiosk-countdown-number').text(remainingSeconds + ' Detik');

        const percentage = (remainingSeconds / currentInterval) * 100;
        $('#countdown-bar').css('width', percentage + '%');
        $('#kiosk-countdown-bar').css('width', percentage + '%');

        // Ganti warna jika sisa waktu sedikit (<= 5 detik)
        if (remainingSeconds <= 5) {
            $('#countdown-bar').removeClass('bg-info').addClass('bg-danger');
            $('#countdown-badge').removeClass('badge-primary').addClass('badge-danger');
        } else {
            $('#countdown-bar').removeClass('bg-danger').addClass('bg-info');
            $('#countdown-badge').removeClass('badge-danger').addClass('badge-primary');
        }
    }

    // Hitung Mundur Setiap 1 Detik
    timerInterval = setInterval(function() {
        remainingSeconds--;
        if (remainingSeconds <= 0) {
            remainingSeconds = 0;
            updateCountdownDisplay();
            fetchNewQrToken(); // Ambil token baru saat waktu habis!
        } else {
            updateCountdownDisplay();
        }
    }, 1000);

    // Ambil Token Pertama Kali
    fetchNewQrToken();

    // ==========================================
    // 📡 POLLING LOG SCAN REAL-TIME (Tiap 3 Detik)
    // ==========================================
    function checkRecentScans() {
        $.ajax({
            url: "{{ route('admin.absensi.qr.recent') }}",
            type: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status === 'success' && res.scans && res.scans.length > 0) {
                    $('#scans-empty-state').hide();
                    $('#scans-list').show();
                    $('#scan-count-badge').text(res.scans.length + ' aktivitas');

                    let html = '';
                    let hasNewScan = false;

                    res.scans.forEach(function(item, index) {
                        const key = item.nama + '_' + item.jam + '_' + item.tipe;
                        const isNew = !knownScanKeys.has(key);
                        if (isNew) {
                            hasNewScan = true;
                            knownScanKeys.add(key);
                        }

                        const badgeClass = item.tipe.toLowerCase() === 'masuk' ? 'badge-success' : 'badge-info';
                        const iconClass = item.tipe.toLowerCase() === 'masuk' ? 'fa-sign-in-alt' : 'fa-sign-out-alt';
                        const pulseClass = (index === 0 && isNew) ? 'new-scan-pulse' : '';

                        html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3 border-bottom ${pulseClass}">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 34px; height: 34px; font-size: 13px;">
                                        ${item.nama.substring(0, 2).toUpperCase()}
                                    </div>
                                    <div>
                                        <div class="font-weight-bold text-dark" style="font-size: 13px;">${item.nama}</div>
                                        <div class="text-muted" style="font-size: 11px;">${item.waktu || item.jam}</div>
                                    </div>
                                </div>
                                <span class="badge ${badgeClass} px-2 py-1" style="border-radius: 6px; font-size: 11px;">
                                    <i class="fas ${iconClass} mr-1"></i> ${item.tipe.toUpperCase()}
                                </span>
                            </li>
                        `;
                    });

                    $('#scans-list').html(html);

                    // Bunyikan chime jika ada scan baru
                    if (hasNewScan && knownScanKeys.size > 0) {
                        playChimeSound();
                    }
                }
            }
        });
    }

    // Polling setiap 3.5 detik
    setInterval(checkRecentScans, 3500);
    checkRecentScans();

    // ==========================================
    // 🖥️ FULLSCREEN KIOSK MODE
    // ==========================================
    $('#btn-fullscreen').on('click', function() {
        $('#kiosk-fullscreen-overlay').fadeIn(200);
        const elem = document.documentElement;
        if (elem.requestFullscreen) {
            elem.requestFullscreen().catch(err => {});
        }
    });

    $('#btn-exit-fullscreen').on('click', function() {
        $('#kiosk-fullscreen-overlay').fadeOut(200);
        if (document.exitFullscreen) {
            document.exitFullscreen().catch(err => {});
        }
    });

    $(document).on('keydown', function(e) {
        if (e.key === "Escape") {
            $('#kiosk-fullscreen-overlay').fadeOut(200);
        }
    });
});
</script>
@endsection
