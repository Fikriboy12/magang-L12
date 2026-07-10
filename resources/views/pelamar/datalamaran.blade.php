@extends('template.master') 

@section('title', 'Hasil Lamaran & Sertifikat')

@section('contents')

{{-- CSS MODERN --}}
<style>
    /* --- CSS WARNA KUSTOM LOGO --- */
    .text-logo { color: #3CB9E0 !important; }
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

    /* Header Biru Modern Disesuaikan Logo */
    .hd-header {
        background: linear-gradient(135deg, #4AC1E0 0%, #3CB9E0 100%) !important;
        color: white !important;
        padding: 25px 30px;
        border-radius: 15px 15px 0 0;
        box-shadow: 0 4px 15px rgba(60, 185, 224, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-modern {
        border: none !important;
        border-radius: 15px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08) !important;
        background: #fff;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .table-hd thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 15px 10px !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }

    .table-hd tbody td {
        padding: 15px 10px !important;
        vertical-align: middle !important;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .date-box {
        display: flex; flex-direction: column; gap: 4px; font-size: 0.85rem;
    }
    
    .date-item {
        display: flex; align-items: center; gap: 6px; white-space: nowrap;
    }

    .badge-status {
        padding: 6px 12px; border-radius: 50px; font-weight: 600;
        font-size: 0.75rem; display: inline-flex; align-items: center; white-space: nowrap;
    }
    
    .bg-success-soft { background-color: #d1fae5; color: #065f46; }
    .bg-danger-soft { background-color: #fee2e2; color: #991b1b; }
    .bg-warning-soft { background-color: #fef3c7; color: #92400e; }

    /* Action Buttons */
    .btn-action {
        width: 32px; height: 32px; display: inline-flex;
        align-items: center; justify-content: center;
        border-radius: 8px; transition: 0.3s; border: none; margin: 0 2px; font-size: 0.85rem;
        text-decoration: none !important;
    }
    
    .btn-view { background: #e8f8fc; color: #3CB9E0; }
    .btn-view:hover { background: #3CB9E0; color: white; }

    .btn-print { background: #fffbeb; color: #d97706; }
    .btn-print:hover { background: #d97706; color: white; }

    /* Tombol Ajukan Sertifikat */
    .btn-ajukan { background: #ecfdf5; color: #059669; cursor: pointer; }
    .btn-ajukan:hover { background: #059669; color: white; }

</style>

<div class="content-wrapper" style="background-color: #f8fafc; min-height: 90vh;">
    
    <section class="content pt-5 pb-5">
      <div class="container">
        
        {{-- BAGIAN 1: HASIL LAMARAN --}}
        <div class="row justify-content-center">
            <div class="col-12">
                
                <div class="card card-modern">
                    <div class="hd-header">
                        <div>
                            <h4 class="m-0 font-weight-bold">
                                <i class="fas fa-file-contract mr-2"></i> Hasil Lamaran
                            </h4>
                            <small style="opacity: 0.9;">Status pendaftaran magang Anda saat ini.</small>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="example1" class="table table-hd table-hover w-100" style="min-width: 900px;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%" class="text-center">No</th>
                                        <th style="width: 20%">Nama Lengkap</th>
                                        <th style="width: 20%">Kontak</th>
                                        <th style="width: 15%">Periode Magang</th>
                                        <th>Keterangan</th>
                                        <th class="text-center" style="width: 10%">Status</th>
                                        <th class="text-center" style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_lamaran as $item) 
                                    <tr>
                                        <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                        
                                        <td>
                                            <span class="font-weight-bold text-logo" style="font-size: 0.95rem;">
                                                {{ $item->user->name ?? Auth::user()->name }}
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 3px;">
                                                <span style="font-size: 0.85rem; color: #555;">
                                                    <i class="far fa-envelope mr-1 text-muted"></i> 
                                                    {{ Str::limit($item->user->email ?? Auth::user()->email, 20) }}
                                                </span>
                                                <span style="font-size: 0.85rem; color: #555;">
                                                    <i class="fas fa-phone-alt mr-1 text-muted"></i> 
                                                    {{ $item->user->no_telp ?? '-' }}
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="date-box">
                                                <div class="date-item text-success">
                                                    <i class="fas fa-calendar-check"></i> 
                                                    <span>{{ \Carbon\Carbon::parse($item->dari_tanggal)->format('d M Y') }}</span>
                                                </div>
                                                <div class="date-item text-danger">
                                                    <i class="fas fa-calendar-times"></i> 
                                                    <span>{{ \Carbon\Carbon::parse($item->sampai_tanggal)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="text-muted" style="font-size: 0.85rem; font-style: italic;">
                                                {{ $item->keterangan ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if($item->status_pendaftaran == 'diterima')
                                                <span class="badge-status bg-success-soft">
                                                    <i class="fas fa-check-circle mr-1"></i> Diterima
                                                </span>
                                            @elseif($item->status_pendaftaran == 'ditolak')
                                                <span class="badge-status bg-danger-soft">
                                                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                                                </span>
                                            @else
                                                <span class="badge-status bg-warning-soft">
                                                    <i class="fas fa-clock mr-1"></i> Proses
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                {{-- DETAIL --}}
                                                <a href="{{ url('detail-lamaran/'.$item->id_pendaftaran) }}" class="btn-action btn-view" title="Detail" data-toggle="tooltip">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                {{-- CETAK --}}
                                                <a href="{{ url('cetak-lamaran/'.$item->id_pendaftaran) }}" class="btn-action btn-print" target="_blank" title="Cetak Bukti" data-toggle="tooltip">
                                                    <i class="fas fa-print"></i>
                                                </a>

                                                {{-- TOMBOL AJUKAN SERTIFIKAT --}}
                                                @if($item->status_pendaftaran == 'diterima')
                                                    <button type="button" class="btn-action btn-ajukan" data-toggle="modal" data-target="#modalAjukan{{ $item->id_pendaftaran }}" title="Ajukan Sertifikat">
                                                        <i class="fas fa-file-signature"></i>
                                                    </button>
                                                @else
                                                    <button class="btn-action btn-secondary" disabled style="cursor: not-allowed; opacity: 0.5;" title="Menunggu Diterima">
                                                        <i class="fas fa-lock"></i>
                                                    </button>
                                                @endif
                                            </div>

                                            {{-- MODAL AJUKAN SERTIFIKAT --}}
                                            <div class="modal fade" id="modalAjukan{{ $item->id_pendaftaran }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                                        <div class="modal-header bg-logo text-white" style="border-radius: 15px 15px 0 0;">
                                                            <h5 class="modal-title font-weight-bold">Ajukan Sertifikat</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="fas fa-certificate fa-3x text-warning mb-3"></i>
                                                            <p class="mb-0 font-weight-bold text-dark">Apakah Anda yakin ingin mengajukan sertifikat?</p>
                                                            <p class="small text-muted">Pastikan Anda telah menyelesaikan periode magang.</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center border-0 pb-4">
                                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Batal</button>
                                                            
                                                            <form action="{{ url('insert-sertifikat') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id_pendaftaran" value="{{ $item->id_pendaftaran }}">
                                                                <button type="submit" class="btn btn-logo rounded-pill px-4">Ya, Ajukan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3" style="opacity: 0.3;"></i>
                                                <h5>Belum ada data lamaran.</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- BAGIAN 2: HASIL SERTIFIKAT --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-modern">
                    <div class="hd-header">
                        <div>
                            <h4 class="m-0 font-weight-bold">
                                <i class="fas fa-certificate mr-2"></i> Hasil Sertifikat
                            </h4>
                            <small style="opacity: 0.9;">Sertifikat kelulusan program magang.</small>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hd table-hover w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%" class="text-center">No</th>
                                        <th>Nama Sertifikat</th>
                                        <th>Tanggal Terbit</th>
                                        <th>File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_sertifikat as $sertifikat)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $sertifikat->nama_sertifikat ?? 'Sertifikat Magang' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sertifikat->created_at)->format('d M Y') }}</td>
                                            <td><span class="badge bg-logo text-white">PDF / Image</span></td>
                                            <td class="text-center">
                                                
                                                {{-- PERBAIKAN LINK DOWNLOAD DI SINI --}}
                                                {{-- 1. Menggunakan 'sertifikat/' bukan 'storage/' --}}
                                                {{-- 2. Menggunakan 'file_path' bukan 'file' (sesuai database) --}}
                                                
                                                @if(!empty($sertifikat->file_path))
                                                    <a href="{{ asset('sertifikat/'.$sertifikat->file_path) }}" target="_blank" class="btn btn-sm btn-logo shadow-sm px-3" style="border-radius: 20px;">
                                                        <i class="fas fa-download mr-1"></i> Download
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-secondary shadow-sm px-3" disabled style="border-radius: 20px; opacity: 0.6;">
                                                        <i class="fas fa-spinner mr-1"></i> Proses
                                                    </button>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <span class="text-muted font-italic">Belum ada sertifikat yang diterbitkan.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>
</div>
@endsection