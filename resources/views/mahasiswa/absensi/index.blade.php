@extends('template.master') 

@section('contents')

<style>
    /* --- CSS WARNA KUSTOM LOGO --- */
    .bg-logo { background: linear-gradient(135deg, #4AC1E0 0%, #3CB9E0 100%) !important; }
    .btn-logo {
        background: linear-gradient(135deg, #4AC1E0 0%, #3CB9E0 100%) !important;
        color: white !important;
        border: none !important;
        transition: all 0.3s ease;
    }
    .btn-logo:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(60, 185, 224, 0.4) !important;
        color: white !important;
    }
    /* Efek focus untuk input form */
    .form-control:focus {
        border-color: #3CB9E0 !important;
        box-shadow: 0 0 0 3px rgba(60, 185, 224, 0.2) !important;
    }
</style>

<div class="container pt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                {{-- BERUBAH: bg-primary diganti menjadi bg-logo --}}
                <div class="card-header bg-logo text-white">
                    <h5 class="m-0"><i class="fas fa-clock mr-2"></i> Absensi Harian</h5>
                </div>
                <div class="card-body text-center">
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <h4 class="font-weight-bold">{{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y') }}</h4>
                    <div id="jam-digital" class="display-4 text-dark font-weight-bold mb-4">--:--:--</div>

                    {{-- LOGIKA TOMBOL ABSEN --}}
                    @if(!$absenHariIni)
                        {{-- FORM ABSEN MASUK --}}
                        <form action="{{ route('mahasiswa.absensi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group text-left">
                                <label class="font-weight-bold">Upload Selfie Masuk</label>
                                <input type="file" name="foto" class="form-control p-1" required accept="image/*">
                            </div>

                            {{-- INPUT KETERANGAN MANUAL --}}
                            <div class="form-group text-left">
                                <label class="font-weight-bold">Keterangan Kegiatan Hari Ini</label>
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Mengerjakan modul, Memperbaiki jaringan, dll..." required></textarea>
                            </div>

                            {{-- BERUBAH: btn-primary diganti menjadi btn-logo --}}
                            <button type="submit" class="btn btn-logo btn-lg btn-block mt-3">
                                <i class="fas fa-sign-in-alt"></i> ABSEN MASUK (WIB)
                            </button>
                        </form>

                    @elseif($absenHariIni->jam_keluar == null)
                        {{-- FORM ABSEN PULANG --}}
                        <div class="alert alert-info">Anda Masuk jam: <strong>{{ $absenHariIni->jam_masuk }} WIB</strong></div>
                        
                        <form action="{{ route('mahasiswa.absensi.pulang', $absenHariIni->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group text-left">
                                <label class="font-weight-bold">Upload Selfie Pulang</label>
                                <input type="file" name="foto" class="form-control p-1" required accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-warning btn-lg btn-block text-white mt-3">
                                <i class="fas fa-sign-out-alt"></i> ABSEN PULANG (WIB)
                            </button>
                        </form>
                    @else
                        <div class="alert alert-success">
                            <strong><i class="fas fa-check-circle"></i> Absensi Hari Ini Selesai</strong><br>
                            Masuk: {{ $absenHariIni->jam_masuk }} | Pulang: {{ $absenHariIni->jam_keluar }}
                        </div>
                    @endif

                </div>
            </div>

            {{-- TABEL RIWAYAT --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-white font-weight-bold">Riwayat Kehadiran</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat as $row)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($row->tgl_absen)) }}</td>
                                    <td>{{ $row->jam_masuk }}</td>
                                    <td>{{ $row->jam_keluar ?? '-' }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // JAM DIGITAL SESUAI WIB (Hanya Visual)
    function updateJam() {
        const now = new Date();
        // Opsi untuk menampilkan jam Indonesia Barat (WIB)
        const options = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const timeString = now.toLocaleTimeString('id-ID', options);
        document.getElementById('jam-digital').innerText = timeString;
    }
    setInterval(updateJam, 1000);
    updateJam();
</script>
@endsection