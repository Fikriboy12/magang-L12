@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi & Pengajuan E-Sertifikat Magang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Pengajuan Sertifikat</div>
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

    {{-- Status Filter Tabs --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-3 d-flex flex-wrap align-items-center justify-content-between">
                    <div class="btn-group" role="group">
                        <a href="{{ route('pembimbing_lapangan.sertifikat.index', ['status' => 'all']) }}" 
                           class="btn {{ $statusFilter === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                            Semua Pengajuan
                        </a>
                        <a href="{{ route('pembimbing_lapangan.sertifikat.index', ['status' => 'pending']) }}" 
                           class="btn {{ $statusFilter === 'pending' ? 'btn-warning text-dark font-weight-bold' : 'btn-outline-warning' }}">
                            <i class="fas fa-clock mr-1"></i> Butuh ACC ({{ $countPending }})
                        </a>
                        <a href="{{ route('pembimbing_lapangan.sertifikat.index', ['status' => 'disetujui']) }}" 
                           class="btn {{ $statusFilter === 'disetujui' ? 'btn-success' : 'btn-outline-success' }}">
                            <i class="fas fa-check-circle mr-1"></i> Disetujui ({{ $countDisetujui }})
                        </a>
                        <a href="{{ route('pembimbing_lapangan.sertifikat.index', ['status' => 'ditolak']) }}" 
                           class="btn {{ $statusFilter === 'ditolak' ? 'btn-danger' : 'btn-outline-danger' }}">
                            <i class="fas fa-times-circle mr-1"></i> Ditolak ({{ $countDitolak }})
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-certificate text-warning mr-1"></i> Daftar Pengajuan E-Sertifikat Siswa
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Siswa</th>
                            <th>Asal Sekolah / Kampus</th>
                            <th>Jurusan</th>
                            <th>Nama / Judul Sertifikat</th>
                            <th>File Sertifikat</th>
                            <th>Status Pengajuan</th>
                            <th class="text-center" style="width: 18%">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sertifikatList as $idx => $sertif)
                            <tr>
                                <td>{{ $sertifikatList->firstItem() + $idx }}</td>
                                <td>
                                    <div class="font-weight-600 text-dark">{{ $sertif->user->name ?? 'Siswa' }}</div>
                                    <small class="text-muted"><i class="fas fa-id-card mr-1"></i> {{ $sertif->user->nim ?? '-' }}</small>
                                </td>
                                <td>{{ $sertif->user->pendaftaran->universitas ?? $sertif->user->pendaftaran->asal_sekolah ?? '-' }}</td>
                                <td>{{ $sertif->user->pendaftaran->jurusan ?? '-' }}</td>
                                <td>
                                    <span class="font-weight-600 text-dark">{{ $sertif->nama_sertifikat }}</span>
                                    <br>
                                    <small class="text-muted">Diajukan: {{ \Carbon\Carbon::parse($sertif->created_at)->translatedFormat('d M Y') }}</small>
                                </td>
                                <td>
                                    @if($sertif->file_path && file_exists(public_path('sertifikat/' . $sertif->file_path)))
                                        <a href="{{ asset('sertifikat/' . $sertif->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-pdf mr-1"></i> Unduh File
                                        </a>
                                    @else
                                        <span class="text-muted small font-italic">Belum ada file final</span>
                                    @endif
                                </td>
                                <td>
                                    @if(in_array($sertif->status_pengajuan, ['pending', 'menunggu_verifikasi']))
                                        <span class="badge badge-warning px-2 py-1">
                                            <i class="fas fa-hourglass-half mr-1"></i> Menunggu Verifikasi
                                        </span>
                                    @elseif($sertif->status_pengajuan === 'disetujui')
                                        <span class="badge badge-success px-2 py-1">
                                            <i class="fas fa-check-circle mr-1"></i> Disetujui (ACC)
                                        </span>
                                    @elseif($sertif->status_pengajuan === 'ditolak')
                                        <span class="badge badge-danger px-2 py-1">
                                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        {{-- Tombol ACC Modal --}}
                                        <button type="button" class="btn btn-sm btn-success font-weight-bold" data-toggle="modal" data-target="#modalApproveSertif{{ $sertif->id }}">
                                            <i class="fas fa-check mr-1"></i> ACC
                                        </button>

                                        {{-- Tombol Tolak Modal --}}
                                        <button type="button" class="btn btn-sm btn-danger font-weight-bold" data-toggle="modal" data-target="#modalRejectSertif{{ $sertif->id }}">
                                            <i class="fas fa-times mr-1"></i> Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal ACC Sertifikat --}}
                            <div class="modal fade" id="modalApproveSertif{{ $sertif->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title font-weight-bold">
                                                <i class="fas fa-award mr-1"></i> ACC Pengajuan Sertifikat Siswa
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.sertifikat.approve', $sertif->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Siswa: <strong>{{ $sertif->user->name ?? 'Siswa' }}</strong></p>
                                                <p>Judul: <strong>{{ $sertif->nama_sertifikat }}</strong></p>
                                                <hr>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Unggah File Sertifikat PDF <small class="text-muted">(Opsional / Jika sudah dicetak)</small></label>
                                                    <input type="file" name="file_sertifikat" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                                    <small class="text-muted">Format: PDF atau Gambar. Maksimal 5MB.</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success font-weight-bold">
                                                    <i class="fas fa-check mr-1"></i> Setujui (ACC) Sertifikat
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Tolak Sertifikat --}}
                            <div class="modal fade" id="modalRejectSertif{{ $sertif->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title font-weight-bold">
                                                <i class="fas fa-times-circle mr-1"></i> Tolak Pengajuan Sertifikat
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.sertifikat.reject', $sertif->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body text-center py-4">
                                                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                                <p>Apakah Anda yakin ingin menolak pengajuan sertifikat untuk:</p>
                                                <h6 class="font-weight-bold text-dark">{{ $sertif->user->name ?? 'Siswa' }}</h6>
                                                <p class="text-muted small">Status pengajuan akan diubah menjadi "Ditolak".</p>
                                            </div>
                                            <div class="modal-footer bg-light justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger font-weight-bold">
                                                    <i class="fas fa-times mr-1"></i> Ya, Tolak Pengajuan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-award fa-3x mb-2 text-light d-block"></i>
                                    Belum ada berkas pengajuan sertifikat yang sesuai filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($sertifikatList->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $sertifikatList->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
