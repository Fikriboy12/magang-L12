@extends('template_admin.master')
@section('contents')

<style>
    /* ========================================================
       DESIGN MODERN HALAMAN DATA PENDAFTARAN BARU (ATS QUEUE THEME)
       (Distinct Layout: Pipeline Dashboard & Review Queue)
       ======================================================== */

    /* 1. APPLICANT INTAKE CONTROL HEADER */
    .ats-header-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 55%, #312e81 100%);
        border-radius: 20px;
        padding: 26px 30px;
        color: #ffffff;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.25);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .ats-header-card::after {
        content: '';
        position: absolute;
        bottom: -50px; right: -50px;
        width: 180px; height: 180px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .badge-queue-active {
        background: rgba(245, 158, 11, 0.18);
        border: 1px solid rgba(245, 158, 11, 0.4);
        color: #fbbf24;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 0.8px;
        padding: 4px 12px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        text-transform: uppercase;
    }
    .pulse-amber-dot {
        width: 8px; height: 8px;
        background-color: #f59e0b;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
        box-shadow: 0 0 0 rgba(245, 158, 11, 0.7);
        animation: pulseAmber 1.8s infinite;
    }
    @keyframes pulseAmber {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(245, 158, 11, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
    }

    /* 2. ATS WORKFLOW PIPELINE RIBBON */
    .pipeline-ribbon {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .pipeline-step {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        transition: all 0.25s ease;
        text-decoration: none !important;
        color: #ffffff;
    }
    .pipeline-step:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        color: #ffffff;
    }
    .pipeline-step.active {
        background: rgba(245, 158, 11, 0.22);
        border-color: #f59e0b;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
    }
    .pipeline-step-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        margin-right: 12px;
        flex-shrink: 0;
    }
    .icon-pending { background: rgba(245, 158, 11, 0.25); color: #fbbf24; }
    .icon-accepted { background: rgba(34, 197, 94, 0.2); color: #4ade80; }
    .icon-rejected { background: rgba(239, 68, 68, 0.2); color: #f87171; }
    
    .pipeline-title {
        font-size: 10.5px;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.6px;
        color: #cbd5e1;
        display: block;
    }
    .pipeline-value {
        font-size: 17px;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.1;
    }

    /* 3. QUICK CONTROLS TOOLBAR */
    .toolbar-container {
        background: #ffffff;
        border-radius: 16px;
        padding: 14px 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(0,0,0,0.03);
    }
    .search-input-ats-wrapper {
        position: relative;
        width: 100%;
        max-width: 380px;
    }
    .search-input-ats-wrapper .search-icon {
        position: absolute;
        top: 50%; left: 14px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
    }
    .ats-search-input {
        padding-left: 38px !important;
        border-radius: 12px !important;
        border: 1.5px solid #cbd5e1 !important;
        background: #f8fafc !important;
        font-size: 13px !important;
        height: 42px !important;
        transition: all 0.2s ease;
    }
    .ats-search-input:focus {
        background: #ffffff !important;
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
    }
    .info-hint-pill {
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        color: #4338ca;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
    }

    /* 4. MODERN ATS TABLE */
    .ats-table-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .ats-table {
        margin-bottom: 0 !important;
    }
    .ats-table thead th {
        background: #f8fafc !important;
        color: #1e293b !important;
        font-size: 11.5px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.7px !important;
        padding: 16px 18px !important;
        border-top: none !important;
        border-bottom: 2px solid #e2e8f0 !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }
    .ats-table tbody td {
        padding: 16px 18px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        color: #334155;
        font-size: 13px;
    }
    .ats-table tbody tr {
        transition: background-color 0.2s ease;
    }
    .ats-table tbody tr:hover {
        background-color: #faf5ff !important;
    }

    /* 5. ROW ELEMENTS */
    .row-index-pill {
        width: 30px; height: 30px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .applicant-avatar-wrap {
        position: relative;
        display: inline-block;
    }
    .applicant-avatar-img {
        width: 44px; height: 44px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
        border: 2px solid #ffffff;
    }
    .applicant-avatar-fallback {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: #ffffff;
        font-weight: 800;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 16px;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
    }
    .avatar-pending-dot {
        position: absolute;
        bottom: -2px; right: -2px;
        width: 12px; height: 12px;
        background: #f59e0b;
        border: 2px solid #ffffff;
        border-radius: 50%;
    }
    .badge-nisn-pill {
        background: #f1f5f9;
        color: #64748b;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 6px;
        display: inline-block;
    }
    .school-name-text {
        font-weight: 700;
        color: #1e293b;
        font-size: 13px;
        display: flex;
        align-items: center;
    }
    .badge-jurusan-smk {
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
        font-weight: 700;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 11px;
        letter-spacing: 0.4px;
        display: inline-block;
        text-transform: uppercase;
    }
    .period-range-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 11.5px;
        font-weight: 600;
        color: #334155;
        white-space: nowrap;
        display: inline-flex; align-items: center;
    }
    .badge-status-review {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
        border-radius: 20px;
        font-weight: 700;
        padding: 5px 12px;
        font-size: 11.5px;
        display: inline-flex; align-items: center;
    }
    .btn-review-applicant {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 10px !important;
        font-weight: 700 !important;
        font-size: 12.5px !important;
        padding: 8px 16px !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.28) !important;
        transition: all 0.2s ease !important;
        display: inline-flex; align-items: center;
        text-decoration: none !important;
        white-space: nowrap;
    }
    .btn-review-applicant:hover {
        background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4) !important;
        color: #ffffff !important;
    }
</style>

<section class="section">
    {{-- 1. APPLICANT INTAKE CONTROL HEADER --}}
    <div class="ats-header-card mb-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <div class="badge-queue-active mb-2">
                    <span class="pulse-amber-dot"></span> Antrean Verifikasi Aktif
                </div>
                <h3 class="font-weight-bold text-white mb-1" style="letter-spacing: -0.5px;">
                    Pendaftaran Baru Siswa SMK
                </h3>
                <p class="mb-0 text-white-50" style="font-size: 13.5px; max-width: 500px;">
                    Kelola dan periksa berkas pendaftaran calon peserta magang SMK. Setujui atau tolak berkas melalui tombol verifikasi.
                </p>
            </div>
            
            {{-- ATS PIPELINE TRACKER --}}
            <div class="col-lg-6">
                <div class="pipeline-ribbon justify-content-lg-end">
                    {{-- 1. Pengajuan (Active) --}}
                    <div class="pipeline-step active">
                        <div class="pipeline-step-icon icon-pending">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div>
                            <span class="pipeline-title">Menunggu Review</span>
                            <span class="pipeline-value">{{ $data['pengajuan'] ?? $data['data_pendaftaran']->count() }} Berkas</span>
                        </div>
                    </div>

                    {{-- 2. Diterima --}}
                    <a href="{{ route('admin.diterima.index') }}" class="pipeline-step" title="Lihat Siswa Diterima">
                        <div class="pipeline-step-icon icon-accepted">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <span class="pipeline-title">Telah Diterima</span>
                            <span class="pipeline-value">{{ $data['diterima'] ?? 0 }} Siswa</span>
                        </div>
                    </a>

                    {{-- 3. Ditolak --}}
                    <a href="{{ route('admin.tidak_diterima.index') }}" class="pipeline-step" title="Lihat Pendaftaran Ditolak">
                        <div class="pipeline-step-icon icon-rejected">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div>
                            <span class="pipeline-title">Tidak Diterima</span>
                            <span class="pipeline-value">{{ $data['tidak_diterima'] ?? 0 }} Siswa</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. NOTIFIKASI SUKSES / ERROR --}}
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible show fade shadow-sm" role="alert" style="border-radius: 12px;">
                        <div class="alert-body d-flex align-items-center justify-content-between">
                            <div><i class="fas fa-exclamation-circle mr-2"></i> <strong>Error!</strong> {{ session()->get('err_message') }}</div>
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible show fade shadow-sm" role="alert" style="border-radius: 12px; background: #dcfce7; border: 1px solid #86efac; color: #15803d;">
                        <div class="alert-body d-flex align-items-center justify-content-between">
                            <div><i class="fas fa-check-circle mr-2"></i> <strong>Sukses!</strong> {{ session()->get('suc_message') }}</div>
                            <button class="close text-success" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- 3. QUICK CONTROLS TOOLBAR --}}
        <div class="toolbar-container d-flex flex-wrap align-items-center justify-content-between mb-3">
            <div class="search-input-ats-wrapper mb-2 mb-md-0">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="customSearchInput" class="form-control ats-search-input" placeholder="Cari nama siswa, NISN, asal SMK, jurusan...">
            </div>
            <div class="d-flex align-items-center">
                <span class="info-hint-pill mr-2">
                    <i class="fas fa-info-circle mr-1"></i> Klik <strong>Review Berkas</strong> untuk verifikasi siswa
                </span>
                <span class="badge badge-light border font-weight-bold px-3 py-2" style="font-size: 12px; border-radius: 8px;">
                    Total: {{ $data['data_pendaftaran']->count() }} Siswa
                </span>
            </div>
        </div>

        {{-- 4. TABEL ANTREAN PENDAFTARAN BARU --}}
        <div class="card ats-table-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="table" class="table ats-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="4%" class="text-center">No.</th>
                                <th>Kandidat Siswa SMK</th>
                                <th>Asal Sekolah SMK</th>
                                <th>Jurusan</th>
                                <th class="text-center">Foto</th>
                                <th>Kontak Siswa</th>
                                <th>Periode Diajukan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="12%">Aksi Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($data['data_pendaftaran'] as $item)
                                <tr>
                                    {{-- No Urut --}}
                                    <td class="text-center">
                                        <span class="row-index-pill">{{ $no++ }}</span>
                                    </td>

                                    {{-- Identitas Siswa --}}
                                    <td>
                                        <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                                            {{ $item->nama_lengkap ?? $item->user->name ?? '-' }}
                                        </div>
                                        @if($item->nim || $item->nisn)
                                            <div class="mt-1">
                                                <span class="badge-nisn-pill">
                                                    <i class="fas fa-id-card-alt mr-1"></i> {{ $item->nisn ?? $item->nim }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Asal SMK --}}
                                    <td>
                                        <div class="school-name-text">
                                            <i class="fas fa-school text-primary mr-2" style="font-size: 13px;"></i>
                                            <span>{{ $item->universitas }}</span>
                                        </div>
                                    </td>

                                    {{-- Jurusan --}}
                                    <td>
                                        <span class="badge-jurusan-smk">
                                            {{ strtoupper($item->jurusan) }}
                                        </span>
                                    </td>

                                    {{-- Foto dengan status dot --}}
                                    <td class="text-center">
                                        <div class="applicant-avatar-wrap">
                                            @if($item->gambar && file_exists(public_path('gambar/' . $item->gambar)))
                                                <img src="{{ asset('gambar/' . $item->gambar) }}" alt="{{ $item->nama_lengkap }}" class="applicant-avatar-img" title="{{ $item->nama_lengkap }}">
                                            @else
                                                <div class="applicant-avatar-fallback" title="{{ $item->nama_lengkap }}">
                                                    {{ strtoupper(substr($item->nama_lengkap ?? $item->user->name ?? 'S', 0, 1)) }}
                                                </div>
                                            @endif
                                            <span class="avatar-pending-dot" title="Menunggu Verifikasi"></span>
                                        </div>
                                    </td>

                                    {{-- Kontak --}}
                                    <td>
                                        <div class="text-nowrap" style="font-size: 12.5px;">
                                            <i class="fas fa-envelope text-muted mr-1"></i>
                                            <a href="mailto:{{ $item->email ?? $item->user->email }}" class="text-secondary font-weight-500">
                                                {{ $item->email ?? $item->user->email ?? '-' }}
                                            </a>
                                        </div>
                                        @if($item->no_telp || ($item->user && $item->user->no_telp))
                                            <div class="text-nowrap mt-1" style="font-size: 12px;">
                                                <i class="fab fa-whatsapp text-success mr-1"></i>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_telp ?? $item->user->no_telp) }}" target="_blank" class="text-dark font-weight-500">
                                                    {{ $item->no_telp ?? $item->user->no_telp }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Periode --}}
                                    <td>
                                        <div class="period-range-box">
                                            <i class="far fa-calendar-alt text-primary mr-1"></i>
                                            <span>{{ $item->dari_tanggal }}</span>
                                            <span class="mx-1 text-muted font-weight-normal">s/d</span>
                                            <span>{{ $item->sampai_tanggal }}</span>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="text-center">
                                        <span class="badge-status-review">
                                            <i class="fas fa-hourglass-half mr-1"></i> Menunggu Review
                                        </span>
                                    </td>

                                    {{-- Tombol Aksi Verifikasi --}}
                                    <td class="text-center">
                                        <a href="{{ url('detail-pendaftaran/' . $item->id_pendaftaran) }}" class="btn-review-applicant" title="Periksa berkas & tentukan kelulusan">
                                            <i class="fas fa-clipboard-check mr-1"></i> Review Berkas
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div style="font-size: 42px; color: #a5b4fc; margin-bottom: 14px;">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark mb-1">Tidak Ada Antrean Pendaftaran Baru</h6>
                                        <p class="text-muted mb-0" style="font-size: 13px;">
                                            Semua pendaftaran siswa SMK telah selesai ditinjau. Pengajuan baru akan tampil di sini secara otomatis.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Fitur Live Search Cepat & Responsif
        $("#customSearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table tbody tr").filter(function() {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(value) > -1);
            });
        });
    });
</script>
@endsection
