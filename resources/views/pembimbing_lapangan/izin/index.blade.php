@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi & ACC Izin Siswa Magang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">ACC Izin</div>
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

    {{-- Filter Status Tabs --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-3 d-flex flex-wrap align-items-center justify-content-between">
                    <div class="btn-group mb-2 mb-md-0" role="group">
                        <a href="{{ route('pembimbing_lapangan.izin.index', ['status' => 'all']) }}" 
                           class="btn {{ $statusFilter === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                            Semua Pengajuan
                        </a>
                        <a href="{{ route('pembimbing_lapangan.izin.index', ['status' => 'pending']) }}" 
                           class="btn {{ $statusFilter === 'pending' ? 'btn-warning text-dark font-weight-bold' : 'btn-outline-warning' }}">
                            <i class="fas fa-clock mr-1"></i> Menunggu ACC ({{ $countPending }})
                        </a>
                        <a href="{{ route('pembimbing_lapangan.izin.index', ['status' => 'valid']) }}" 
                           class="btn {{ $statusFilter === 'valid' ? 'btn-success' : 'btn-outline-success' }}">
                            <i class="fas fa-check-circle mr-1"></i> Disetujui ({{ $countValid }})
                        </a>
                        <a href="{{ route('pembimbing_lapangan.izin.index', ['status' => 'rejected']) }}" 
                           class="btn {{ $statusFilter === 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
                            <i class="fas fa-times-circle mr-1"></i> Ditolak ({{ $countRejected }})
                        </a>
                    </div>

                    <form action="{{ route('pembimbing_lapangan.izin.index') }}" method="GET" class="form-inline">
                        <input type="hidden" name="status" value="{{ $statusFilter }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama siswa..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-clipboard-list text-primary mr-1"></i> Daftar Pengajuan Izin & Sakit Siswa
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Izin</th>
                            <th>Jenis</th>
                            <th>Alasan / Keterangan</th>
                            <th>Bukti Foto / Surat</th>
                            <th>Status Validasi</th>
                            <th class="text-center" style="width: 18%">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($izinList as $index => $item)
                            <tr>
                                <td>{{ $izinList->firstItem() + $index }}</td>
                                <td>
                                    <div class="font-weight-600 text-dark">{{ $item->user->name ?? 'Siswa' }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-graduation-cap mr-1"></i> {{ $item->user->pendaftaran->universitas ?? $item->user->pendaftaran->asal_sekolah ?? '-' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="font-weight-600 text-dark">
                                        {{ \Carbon\Carbon::parse($item->tgl_absen)->translatedFormat('l, d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status === 'Izin')
                                        <span class="badge badge-warning px-2 py-1"><i class="fas fa-envelope mr-1"></i> Izin</span>
                                    @elseif($item->status === 'Sakit')
                                        <span class="badge badge-info px-2 py-1"><i class="fas fa-hospital mr-1"></i> Sakit</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="max-width: 260px;">
                                        {{ $item->keterangan ?: 'Tidak ada keterangan tertulis.' }}
                                    </div>
                                </td>
                                <td>
                                    @if($item->foto_bukti)
                                        <a href="{{ asset('uploads/absensi/' . $item->foto_bukti) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Lihat Foto Bukti">
                                            <i class="fas fa-image mr-1"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-muted small font-italic">Tanpa lampiran</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($item->status_validasi) || $item->status_validasi === 'pending')
                                        <span class="badge badge-warning px-2 py-1">
                                            <i class="fas fa-hourglass-half mr-1"></i> Menunggu ACC
                                        </span>
                                    @elseif($item->status_validasi === 'valid')
                                        <span class="badge badge-success px-2 py-1">
                                            <i class="fas fa-check-circle mr-1"></i> Disetujui (ACC)
                                        </span>
                                    @elseif($item->status_validasi === 'rejected')
                                        <span class="badge badge-danger px-2 py-1">
                                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(empty($item->status_validasi) || $item->status_validasi === 'pending')
                                        <div class="btn-group" role="group">
                                            {{-- Tombol ACC / Approve --}}
                                            <form action="{{ route('pembimbing_lapangan.izin.approve', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm font-weight-bold" onclick="return confirm('Apakah Anda yakin ingin menyetujui (ACC) permohonan izin ini?')">
                                                    <i class="fas fa-check mr-1"></i> ACC Izin
                                                </button>
                                            </form>

                                            {{-- Tombol Tolak / Reject --}}
                                            <button type="button" class="btn btn-danger btn-sm font-weight-bold" data-toggle="modal" data-target="#modalReject{{ $item->id }}">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted small">
                                            <i class="fas fa-lock mr-1"></i> Sudah diproses
                                        </span>
                                        {{-- Berikan opsi ubah jika perlu --}}
                                        <div class="mt-1">
                                            @if($item->status_validasi === 'valid')
                                                <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2" style="font-size: 11px;" data-toggle="modal" data-target="#modalReject{{ $item->id }}">
                                                    Batalkan ACC
                                                </button>
                                            @else
                                                <form action="{{ route('pembimbing_lapangan.izin.approve', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success btn-sm py-0 px-2" style="font-size: 11px;">
                                                        Ubah jadi ACC
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>

                            {{-- Modal Tolak Izin --}}
                            <div class="modal fade" id="modalReject{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title font-weight-bold">
                                                <i class="fas fa-times-circle mr-1"></i> Tolak Permohonan Izin Siswa
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.izin.reject', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Siswa: <strong>{{ $item->user->name ?? 'Siswa' }}</strong></p>
                                                <p>Tanggal: <strong>{{ \Carbon\Carbon::parse($item->tgl_absen)->translatedFormat('d F Y') }}</strong> ({{ $item->status }})</p>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Alasan Penolakan <small class="text-muted">(Akan dilihat oleh siswa)</small></label>
                                                    <textarea name="keterangan_penolakan" class="form-control" rows="3" placeholder="Contoh: Bukti surat sakit tidak dilampirkan atau alasan tidak jelas..." required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger font-weight-bold">
                                                    <i class="fas fa-times mr-1"></i> Konfirmasi Tolak Izin
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-calendar-check fa-3x mb-2 text-light d-block"></i>
                                    Tidak ada data pengajuan izin atau sakit yang sesuai dengan filter ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($izinList->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $izinList->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
