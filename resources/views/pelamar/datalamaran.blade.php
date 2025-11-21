@extends('template.master') 

@section('title', 'Hasil Lamaran & Sertifikat')

@section('contents')

{{-- CSS MODERN --}}
<style>
    .hd-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        color: white !important;
        padding: 25px 30px;
        border-radius: 15px 15px 0 0;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
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
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 0.85rem;
    }
    
    .date-item {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }
    
    .bg-success-soft { background-color: #d1fae5; color: #065f46; }
    .bg-danger-soft { background-color: #fee2e2; color: #991b1b; }
    .bg-warning-soft { background-color: #fef3c7; color: #92400e; }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: 0.3s;
        border: none;
        margin: 0 2px;
        font-size: 0.85rem;
    }
    
    .btn-view { background: #eff6ff; color: #2563eb; }
    .btn-view:hover { background: #2563eb; color: white; }

    .btn-print { background: #fffbeb; color: #d97706; }
    .btn-print:hover { background: #d97706; color: white; }

    .btn-info-custom { background: #ecfdf5; color: #059669; }
    .btn-info-custom:hover { background: #059669; color: white; }
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
                                        
                                        {{-- Nama User --}}
                                        <td>
                                            <span class="font-weight-bold text-primary" style="font-size: 0.95rem;">
                                                {{ $item->user->name ?? Auth::user()->name }}
                                            </span>
                                        </td>
                                        
                                        {{-- Email & Telepon --}}
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
                                        
                                        {{-- Periode --}}
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

                                        {{-- Keterangan --}}
                                        <td>
                                            <span class="text-muted" style="font-size: 0.85rem; font-style: italic;">
                                                {{ $item->keterangan ?? '-' }}
                                            </span>
                                        </td>

                                        {{-- Status Badge --}}
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

                                        {{-- Tombol Aksi (PERBAIKAN LINK DI SINI) --}}
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                {{-- MENGGUNAKAN id_pendaftaran, BUKAN id --}}
                                                <a href="{{ url('detail-lamaran/'.$item->id_pendaftaran) }}" class="btn-action btn-view" title="Detail" data-toggle="tooltip">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <a href="{{ url('cetak-lamaran/'.$item->id_pendaftaran) }}" class="btn-action btn-print" target="_blank" title="Cetak Bukti" data-toggle="tooltip">
                                                    <i class="fas fa-print"></i>
                                                </a>

                                                {{-- Untuk Info, jika menggunakan id_pendaftaran juga, pakai ini --}}
                                                {{-- Jika error, coba ganti ke $item->id_informasi jika ada kolomnya --}}
                                                <a href="{{ url('detail-informasi/'.$item->id_pendaftaran) }}" class="btn-action btn-info-custom" title="Informasi" data-toggle="tooltip">
                                                    <i class="fas fa-info"></i>
                                                </a>
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
                                            <td><span class="badge badge-primary">PDF</span></td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/'.$sertifikat->file) }}" target="_blank" class="btn btn-sm btn-primary shadow-sm px-3" style="border-radius: 20px;">
                                                    <i class="fas fa-download mr-1"></i> Download
                                                </a>
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