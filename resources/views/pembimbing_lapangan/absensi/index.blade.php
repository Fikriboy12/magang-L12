@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Monitoring Absensi Siswa Magang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Absensi Siswa</div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body p-3">
            <form action="{{ route('pembimbing_lapangan.absensi.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-4 col-sm-6 mb-2 mb-md-0">
                        <label class="small font-weight-bold mb-1"><i class="fas fa-calendar-day mr-1"></i> Pilih Tanggal Presensi</label>
                        <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ $selectedDate }}" onchange="this.form.submit()">
                    </div>

                    <div class="col-md-5 col-sm-6 mb-2 mb-md-0">
                        <label class="small font-weight-bold mb-1"><i class="fas fa-user mr-1"></i> Filter Siswa</label>
                        <select name="siswa_id" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="">Semua Siswa Bimbingan</option>
                            @foreach($siswaList as $s)
                                <option value="{{ $s->id }}" {{ $siswaFilter == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }} ({{ $s->pendaftaran->jurusan ?? 'SMK' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-12 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('pembimbing_lapangan.absensi.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt mr-1"></i> Hari Ini
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Metrik Ringkasan Tanggal Terpilih --}}
    <div class="row mb-3">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #e8f5e9; border-radius: 10px;">
                <h4 class="mb-0 text-success font-weight-bold">{{ $totalHadir }}</h4>
                <small class="text-success font-weight-600"><i class="fas fa-check-circle mr-1"></i> Hadir</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #fff8e1; border-radius: 10px;">
                <h4 class="mb-0 text-warning font-weight-bold">{{ $totalIzin }}</h4>
                <small class="text-warning font-weight-600"><i class="fas fa-envelope mr-1"></i> Izin</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #e1f5fe; border-radius: 10px;">
                <h4 class="mb-0 text-info font-weight-bold">{{ $totalSakit }}</h4>
                <small class="text-info font-weight-600"><i class="fas fa-hospital mr-1"></i> Sakit</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm text-center py-2" style="background: #ffebee; border-radius: 10px;">
                <h4 class="mb-0 text-danger font-weight-bold">{{ $totalAlfa }}</h4>
                <small class="text-danger font-weight-600"><i class="fas fa-times-circle mr-1"></i> Alfa</small>
            </div>
        </div>
    </div>

    {{-- Tabel Absensi --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-user-check text-primary mr-1"></i> Presensi Tanggal: {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Foto Masuk</th>
                            <th>Foto Pulang</th>
                            <th>Keterangan</th>
                            <th class="text-center" style="width: 14%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensiList as $idx => $item)
                            <tr>
                                <td>{{ $absensiList->firstItem() + $idx }}</td>
                                <td>
                                    <div class="font-weight-600 text-dark">{{ $item->user->name ?? 'Siswa' }}</div>
                                    <small class="text-muted">{{ $item->user->pendaftaran->universitas ?? $item->user->pendaftaran->asal_sekolah ?? '-' }}</small>
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
                                <td>
                                    <span class="font-weight-600 text-dark">{{ $item->jam_masuk ? substr($item->jam_masuk, 0, 5) . ' WIB' : '-' }}</span>
                                </td>
                                <td>
                                    <span class="font-weight-600 text-dark">{{ $item->jam_keluar ? substr($item->jam_keluar, 0, 5) . ' WIB' : '-' }}</span>
                                </td>
                                <td>
                                    @if($item->foto_bukti)
                                        <a href="{{ asset('uploads/absensi/' . $item->foto_bukti) }}" target="_blank">
                                            <img src="{{ asset('uploads/absensi/' . $item->foto_bukti) }}" alt="Masuk" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted small font-italic">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->foto_keluar)
                                        <a href="{{ asset('uploads/absensi/' . $item->foto_keluar) }}" target="_blank">
                                            <img src="{{ asset('uploads/absensi/' . $item->foto_keluar) }}" alt="Pulang" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted small font-italic">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="max-width: 180px; font-size: 13px;">
                                        {{ $item->keterangan ?: '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pembimbing_lapangan.absensi.siswa', $item->id_users) }}" class="btn btn-sm btn-primary font-weight-bold" title="Lihat Rekap Absensi">
                                        <i class="fas fa-history mr-1"></i> Riwayat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fas fa-calendar-times fa-3x mb-2 text-light d-block"></i>
                                    Tidak ada catatan absensi siswa pada tanggal {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}.
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
