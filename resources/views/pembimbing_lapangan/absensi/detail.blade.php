@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Riwayat Presensi: {{ $siswa->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.absensi.index') }}">Absensi Siswa</a></div>
            <div class="breadcrumb-item active">Riwayat Siswa</div>
        </div>
    </div>

    {{-- Profil Siswa & Tombol Cetak --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <div class="avatar-initial mr-3" style="width: 50px; height: 50px; font-size: 20px;">
                        {{ strtoupper(substr($siswa->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-1">{{ $siswa->name }}</h5>
                        <p class="text-muted mb-0 small">
                            <span class="mr-3"><i class="fas fa-id-card mr-1"></i> NIS/NIM: {{ $siswa->nim ?? '-' }}</span>
                            <span class="mr-3"><i class="fas fa-school mr-1"></i> {{ $siswa->pendaftaran->universitas ?? $siswa->pendaftaran->asal_sekolah ?? '-' }}</span>
                            <span><i class="fas fa-code-branch mr-1"></i> Jurusan: {{ $siswa->pendaftaran->jurusan ?? '-' }}</span>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="{{ route('pembimbing_lapangan.chat.index', $siswa->id) }}" class="btn btn-outline-primary mr-2 font-weight-bold">
                        <i class="fas fa-comment-alt mr-1"></i> Chat Siswa
                    </a>
                    <a href="{{ route('pembimbing_lapangan.absensi.pdf', $siswa->id) }}" target="_blank" class="btn btn-danger font-weight-bold">
                        <i class="fas fa-file-pdf mr-1"></i> Cetak Lembar Presensi (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekap Counter --}}
    <div class="row mb-3">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #e8f5e9; border-radius: 10px;">
                <h4 class="mb-0 text-success font-weight-bold">{{ $countHadir }}</h4>
                <small class="text-success font-weight-600"><i class="fas fa-check-circle mr-1"></i> Total Hadir</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #fff8e1; border-radius: 10px;">
                <h4 class="mb-0 text-warning font-weight-bold">{{ $countIzin }}</h4>
                <small class="text-warning font-weight-600"><i class="fas fa-envelope mr-1"></i> Total Izin</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #e1f5fe; border-radius: 10px;">
                <h4 class="mb-0 text-info font-weight-bold">{{ $countSakit }}</h4>
                <small class="text-info font-weight-600"><i class="fas fa-hospital mr-1"></i> Total Sakit</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #ffebee; border-radius: 10px;">
                <h4 class="mb-0 text-danger font-weight-bold">{{ $countAlfa }}</h4>
                <small class="text-danger font-weight-600"><i class="fas fa-times-circle mr-1"></i> Total Alfa</small>
            </div>
        </div>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-calendar-alt text-primary mr-1"></i> Semua Riwayat Kehadiran Siswa
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Tanggal Presensi</th>
                            <th>Status</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Foto Masuk</th>
                            <th>Foto Pulang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensiList as $i => $item)
                            <tr>
                                <td>{{ $absensiList->firstItem() + $i }}</td>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($item->tgl_absen)->translatedFormat('d M Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tgl_absen)->translatedFormat('l') }}</small>
                                </td>
                                <td>
                                    @if($item->status === 'Hadir')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Hadir</span>
                                    @elseif($item->status === 'Izin')
                                        <span class="badge badge-warning px-2 py-1"><i class="fas fa-envelope mr-1"></i> Izin</span>
                                    @elseif($item->status === 'Sakit')
                                        <span class="badge badge-info px-2 py-1"><i class="fas fa-hospital mr-1"></i> Sakit</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times mr-1"></i> Alfa</span>
                                    @endif
                                </td>
                                <td>{{ $item->jam_masuk ? substr($item->jam_masuk, 0, 5) . ' WIB' : '-' }}</td>
                                <td>{{ $item->jam_keluar ? substr($item->jam_keluar, 0, 5) . ' WIB' : '-' }}</td>
                                <td>
                                    @if($item->foto_bukti)
                                        <a href="{{ asset('uploads/absensi/' . $item->foto_bukti) }}" target="_blank">
                                            <img src="{{ asset('uploads/absensi/' . $item->foto_bukti) }}" alt="Foto Masuk" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->foto_keluar)
                                        <a href="{{ asset('uploads/absensi/' . $item->foto_keluar) }}" target="_blank">
                                            <img src="{{ asset('uploads/absensi/' . $item->foto_keluar) }}" alt="Foto Pulang" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->keterangan ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    Belum ada catatan presensi untuk siswa ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($absensiList->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $absensiList->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
