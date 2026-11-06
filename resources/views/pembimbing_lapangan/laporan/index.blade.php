@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Data Laporan Harian Siswa Magang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Data Laporan</div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Filter Panel --}}
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body p-3">
            <form action="{{ route('pembimbing_lapangan.laporan.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                        <label class="small font-weight-bold mb-1">Status Laporan</label>
                        <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Menunggu ACC ({{ $countPending }})</option>
                            <option value="approved" {{ $statusFilter === 'approved' ? 'selected' : '' }}>Disetujui / ACC ({{ $countApproved }})</option>
                            <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>Ditolak / Revisi ({{ $countRejected }})</option>
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-6 mb-2 mb-md-0">
                        <label class="small font-weight-bold mb-1">Filter Siswa Bimbingan</label>
                        <select name="siswa_id" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="">Semua Siswa</option>
                            @foreach($siswaList as $s)
                                <option value="{{ $s->id }}" {{ $siswaFilter == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }} ({{ $s->pendaftaran->jurusan ?? 'SMK' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5 col-sm-12 mb-2 mb-md-0">
                        <label class="small font-weight-bold mb-1">Pencarian Kegiatan</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control" placeholder="Kata kunci kegiatan..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                                @if(request('status') || request('siswa_id') || request('search'))
                                    <a href="{{ route('pembimbing_lapangan.laporan.index') }}" class="btn btn-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table Laporan --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-book-reader text-primary mr-1"></i> Log Kegiatan Harian Siswa Magang
            </h6>
            @if($siswaFilter)
                <a href="{{ route('pembimbing_lapangan.laporan.pdf', $siswaFilter) }}" target="_blank" class="btn btn-sm btn-outline-danger font-weight-bold">
                    <i class="fas fa-file-pdf mr-1"></i> Cetak Rekap PDF Siswa Ini
                </a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Siswa & Sekolah</th>
                            <th>Tanggal</th>
                            <th>Kegiatan Harian</th>
                            <th>Foto Kegiatan</th>
                            <th>Catatan Pembimbing</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 16%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanList as $idx => $lap)
                            <tr>
                                <td>{{ $laporanList->firstItem() + $idx }}</td>
                                <td>
                                    <div class="font-weight-600 text-dark">{{ $lap->user->name ?? 'Siswa' }}</div>
                                    <small class="text-muted">{{ $lap->user->pendaftaran->universitas ?? $lap->user->pendaftaran->asal_sekolah ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="font-weight-600 text-dark">
                                        {{ \Carbon\Carbon::parse($lap->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <div style="max-width: 250px; line-height: 1.4;">
                                        {{ $lap->kegiatan }}
                                    </div>
                                </td>
                                <td>
                                    @if($lap->foto)
                                        <a href="{{ asset($lap->foto) }}" target="_blank">
                                            <img src="{{ asset($lap->foto) }}" alt="Foto Kegiatan" class="rounded shadow-sm" style="width: 55px; height: 55px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted small font-italic">Tanpa foto</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lap->catatan)
                                        <small class="text-dark bg-light p-1 rounded d-inline-block" style="max-width: 180px;">
                                            <i class="fas fa-comment-dots mr-1 text-info"></i> {{ $lap->catatan }}
                                        </small>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lap->status === 'approved')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Disetujui (ACC)</span>
                                    @elseif($lap->status === 'rejected')
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times mr-1"></i> Ditolak</span>
                                    @else
                                        <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock mr-1"></i> Menunggu ACC</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        {{-- Tombol ACC Modal --}}
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalApproveLap{{ $lap->id }}" title="ACC Laporan">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        {{-- Tombol Tolak Modal --}}
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalRejectLap{{ $lap->id }}" title="Tolak Laporan">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        {{-- Tombol Detail Siswa --}}
                                        <a href="{{ route('pembimbing_lapangan.laporan.siswa', $lap->user_id) }}" class="btn btn-sm btn-info" title="Lihat Semua Laporan Siswa Ini">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal ACC Laporan --}}
                            <div class="modal fade" id="modalApproveLap{{ $lap->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title font-weight-bold">
                                                <i class="fas fa-check-circle mr-1"></i> Setujui (ACC) Laporan Kegiatan
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.laporan.approve', $lap->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Siswa: <strong>{{ $lap->user->name ?? 'Siswa' }}</strong></p>
                                                <p>Tanggal: <strong>{{ \Carbon\Carbon::parse($lap->tanggal)->translatedFormat('d F Y') }}</strong></p>
                                                <p class="mb-3 text-muted border-left pl-2"><em>"{{ $lap->kegiatan }}"</em></p>
                                                
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Catatan / Apresiasi Mentor <small class="text-muted">(Opsional)</small></label>
                                                    <input type="text" name="catatan" class="form-control" placeholder="Contoh: Pekerjaan rapi, lanjutkan progres..." value="{{ $lap->catatan }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success font-weight-bold">
                                                    <i class="fas fa-check mr-1"></i> ACC Laporan Ini
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Tolak Laporan --}}
                            <div class="modal fade" id="modalRejectLap{{ $lap->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title font-weight-bold">
                                                <i class="fas fa-times-circle mr-1"></i> Tolak / Minta Revisi Laporan
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.laporan.reject', $lap->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Siswa: <strong>{{ $lap->user->name ?? 'Siswa' }}</strong></p>
                                                <p>Tanggal: <strong>{{ \Carbon\Carbon::parse($lap->tanggal)->translatedFormat('d F Y') }}</strong></p>
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-danger">Catatan Revisi / Alasan Penolakan <span class="text-danger">*</span></label>
                                                    <textarea name="catatan" class="form-control" rows="3" placeholder="Jelaskan bagian apa yang harus diperbaiki oleh siswa..." required>{{ $lap->catatan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger font-weight-bold">
                                                    <i class="fas fa-times mr-1"></i> Tolak Laporan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-book-open fa-3x mb-2 text-light d-block"></i>
                                    Belum ada data laporan yang sesuai kriteria filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($laporanList->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $laporanList->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
