@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Rekap Laporan Harian: {{ $siswa->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.laporan.index') }}">Data Laporan</a></div>
            <div class="breadcrumb-item active">Detail Siswa</div>
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

    {{-- Student Profile Card --}}
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
                        <i class="fas fa-comment-alt mr-1"></i> Kirim Pesan
                    </a>
                    <a href="{{ route('pembimbing_lapangan.laporan.pdf', $siswa->id) }}" target="_blank" class="btn btn-danger font-weight-bold">
                        <i class="fas fa-file-pdf mr-1"></i> Unduh Rekap PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Timeline / List Laporan --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-history text-primary mr-1"></i> Riwayat Semua Laporan Kegiatan
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Tanggal</th>
                            <th>Uraian Kegiatan</th>
                            <th>Dokumentasi Foto</th>
                            <th>Catatan Pembimbing</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $i => $item)
                            <tr>
                                <td>{{ $laporan->firstItem() + $i }}</td>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') }}</small>
                                </td>
                                <td>
                                    <div style="max-width: 320px; line-height: 1.5;">
                                        {{ $item->kegiatan }}
                                    </div>
                                </td>
                                <td>
                                    @if($item->foto)
                                        <a href="{{ asset($item->foto) }}" target="_blank">
                                            <img src="{{ asset($item->foto) }}" alt="Foto" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->catatan)
                                        <span class="text-dark small bg-light p-1 rounded">{{ $item->catatan }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status === 'approved')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Disetujui (ACC)</span>
                                    @elseif($item->status === 'rejected')
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times mr-1"></i> Ditolak</span>
                                    @else
                                        <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock mr-1"></i> Menunggu ACC</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalApprove{{ $item->id }}" title="ACC">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalReject{{ $item->id }}" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal ACC --}}
                            <div class="modal fade" id="modalApprove{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title font-weight-bold">ACC Laporan {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.laporan.approve', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Catatan Apresiasi / Masukan</label>
                                                    <input type="text" name="catatan" class="form-control" value="{{ $item->catatan }}" placeholder="Bagus, pertahankan ritme kerja...">
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success font-weight-bold">ACC Laporan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Tolak --}}
                            <div class="modal fade" id="modalReject{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title font-weight-bold">Tolak / Revisi Laporan</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="{{ route('pembimbing_lapangan.laporan.reject', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-danger">Catatan Revisi <span class="text-danger">*</span></label>
                                                    <textarea name="catatan" class="form-control" rows="3" required placeholder="Tuliskan catatan revisi kegiatan...">{{ $item->catatan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger font-weight-bold">Tolak Laporan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    Siswa ini belum mengirim laporan kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($laporan->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $laporan->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
