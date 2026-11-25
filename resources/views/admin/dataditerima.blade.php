@extends('template_admin.master')
@section('contents')

<style>
    /* ========================================================
       DESIGN MODERN HALAMAN DATA DITERIMA (AMBIENT TECH THEME)
       ======================================================== */
    
    /* 1. HERO BANNER */
    .welcome-card-modern {
        background: linear-gradient(135deg, #1e3c72 0%, #0077b6 50%, #3CB9E0 100%);
        border-radius: 18px;
        padding: 24px 28px;
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 119, 182, 0.22);
        position: relative;
        overflow: hidden;
    }
    .welcome-card-modern::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 150px; height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }
    .welcome-icon-box {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    .badge-date-pill {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-weight: 700;
        font-size: 12.5px;
        padding: 8px 18px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        display: inline-flex; align-items: center;
    }

    /* 2. STATISTIC METRIC CARDS */
    .stat-metric-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px 22px;
        border: 1px solid #e0f2fe;
        box-shadow: 0 6px 20px rgba(2, 132, 199, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    .stat-metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(2, 132, 199, 0.12);
        border-color: #3CB9E0;
    }
    .stat-label {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: #64748b;
        text-transform: uppercase;
        display: block;
        margin-bottom: 4px;
    }
    .stat-value {
        font-size: 26px;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }
    .stat-icon-wrapper {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .bg-soft-primary { background: #e0f2fe; color: #0284c7; }
    .bg-soft-info { background: #e0f7fa; color: #00acc1; }
    .bg-soft-success { background: #dcfce7; color: #16a34a; }
    .bg-soft-cyan { background: #ecfeff; color: #0891b2; }

    /* 3. MODERN TABLE CARD */
    .modern-table-card {
        border-radius: 18px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
        overflow: hidden;
        background: #ffffff;
    }
    .table-header-indicator {
        width: 4px; height: 20px;
        background: linear-gradient(180deg, #3CB9E0 0%, #1e3c72 100%);
        border-radius: 4px;
    }
    .badge-soft-primary {
        background: #e0f2fe;
        color: #0284c7;
        font-size: 11.5px;
        border-radius: 20px;
    }
    .search-input-wrapper {
        position: relative;
        min-width: 280px;
    }
    .search-input-wrapper .search-icon {
        position: absolute;
        top: 50%; left: 14px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
    }
    .modern-search-input {
        padding-left: 36px !important;
        border-radius: 20px !important;
        border: 1.5px solid #e2e8f0 !important;
        background: #f8fafc !important;
        font-size: 12.5px !important;
        height: 38px !important;
        transition: all 0.2s ease;
    }
    .modern-search-input:focus {
        background: #ffffff !important;
        border-color: #3CB9E0 !important;
        box-shadow: 0 0 0 3px rgba(60, 185, 224, 0.15) !important;
    }

    /* 4. TABLE STYLING */
    .modern-table {
        margin-bottom: 0 !important;
    }
    .modern-table thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px !important;
        padding: 15px 16px !important;
        border-top: none !important;
        border-bottom: 2px solid #e2e8f0 !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }
    .modern-table tbody td {
        padding: 16px 16px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        color: #334155;
        font-size: 13px;
    }
    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }
    .modern-table tbody tr:hover {
        background-color: #f0f9ff !important;
    }

    /* 5. ITEM ELEMENTS */
    .number-badge {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .student-avatar-img {
        width: 44px; height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }
    .student-avatar-fallback {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);
        color: #ffffff;
        font-weight: 800;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 15px;
        box-shadow: 0 3px 8px rgba(2, 132, 199, 0.25);
    }
    .badge-jurusan-pill {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .period-badge {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 11.5px;
        font-weight: 600;
        color: #475569;
        white-space: nowrap;
        display: inline-flex; align-items: center;
    }
    .mentor-select-group {
        min-width: 200px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    .mentor-select {
        border-radius: 8px 0 0 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        font-size: 12px !important;
        font-weight: 500;
        color: #1e293b;
        background-color: #ffffff;
        height: 35px !important;
    }
    .mentor-select:focus {
        border-color: #3CB9E0 !important;
        box-shadow: none !important;
    }
    .btn-save-mentor {
        border-radius: 0 8px 8px 0 !important;
        height: 35px;
        padding: 0 14px;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all 0.2s ease;
    }
    .btn-save-primary {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
        border: none !important;
        color: #ffffff !important;
    }
    .btn-save-primary:hover {
        background: linear-gradient(135deg, #2a5298 0%, #0077b6 100%) !important;
        transform: translateY(-1px);
    }
    .btn-save-info {
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%) !important;
        border: none !important;
        color: #ffffff !important;
    }
    .btn-save-info:hover {
        background: linear-gradient(135deg, #0369a1 0%, #0284c7 100%) !important;
        transform: translateY(-1px);
    }
    .badge-status-diterima {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
        border-radius: 50px;
        font-weight: 700;
        padding: 5px 12px;
        font-size: 11.5px;
        display: inline-flex; align-items: center;
    }
    .btn-detail-action {
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 7px 15px !important;
        box-shadow: 0 3px 8px rgba(2, 132, 199, 0.25) !important;
        transition: all 0.2s ease !important;
        display: inline-flex; align-items: center;
        text-decoration: none !important;
    }
    .btn-detail-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(2, 132, 199, 0.35) !important;
        color: #ffffff !important;
    }
</style>

<section class="section">
    {{-- 1. HERO BANNER MODERN --}}
    <div class="welcome-card-modern d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="welcome-icon-box mr-3">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h3 class="font-weight-bold mb-1 text-white" style="letter-spacing: -0.5px;">Data Siswa Diterima Magang</h3>
                <p class="mb-0 text-white-50" style="font-size: 13px;">
                    Rekapitulasi siswa magang aktif, plotting guru pembimbing sekolah, dan mentor lapangan PT. Media Balai Nusa.
                </p>
            </div>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center">
            <span class="badge-date-pill">
                <i class="fas fa-calendar-alt mr-2 text-info"></i> {{ date('d F Y') }}
            </span>
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

        {{-- 3. KARTU STATISTIK METRIC --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                <div class="stat-metric-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="stat-label">TOTAL SISWA DITERIMA</span>
                            <h3 class="stat-value text-primary mb-0">{{ $data['data_pendaftaran']->count() }}</h3>
                            <small class="text-muted"><i class="fas fa-check-circle text-success mr-1"></i>Siswa Aktif</small>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-primary">
                            <i class="fas fa-user-check text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                <div class="stat-metric-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="stat-label">ASAL SEKOLAH / MITRA</span>
                            <h3 class="stat-value text-info mb-0">{{ $data['data_pendaftaran']->pluck('universitas')->unique()->count() }}</h3>
                            <small class="text-muted"><i class="fas fa-school text-info mr-1"></i>Institusi SMK/Kampus</small>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-info">
                            <i class="fas fa-building text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                <div class="stat-metric-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="stat-label">GURU PEMBIMBING</span>
                            <h3 class="stat-value text-success mb-0">
                                {{ $data['data_pendaftaran']->whereNotNull('pembimbing_id')->count() }}
                                <span style="font-size: 14px; color: #94a3b8; font-weight: 500;">/ {{ $data['data_pendaftaran']->count() }}</span>
                            </h3>
                            <small class="text-muted"><i class="fas fa-chalkboard-teacher text-success mr-1"></i>Siswa Terplotting</small>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-success">
                            <i class="fas fa-user-tie text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                <div class="stat-metric-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="stat-label">MENTOR LAPANGAN</span>
                            <h3 class="stat-value text-cyan mb-0">
                                {{ $data['data_pendaftaran']->whereNotNull('pembimbing_lapangan_id')->count() }}
                                <span style="font-size: 14px; color: #94a3b8; font-weight: 500;">/ {{ $data['data_pendaftaran']->count() }}</span>
                            </h3>
                            <small class="text-muted"><i class="fas fa-briefcase text-cyan mr-1"></i>Mentor Terplotting</small>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-cyan">
                            <i class="fas fa-hard-hat text-cyan"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. TABEL REKAPITULASI DITERIMA --}}
        <div class="card modern-table-card">
            <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between border-bottom">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="table-header-indicator mr-2"></div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15px;">
                        Tabel Rekapitulasi Siswa Diterima
                    </h5>
                    <span class="badge badge-soft-primary ml-2 px-2 py-1 font-weight-bold">{{ $data['data_pendaftaran']->count() }} Siswa</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="customSearchInput" class="form-control form-control-sm modern-search-input" placeholder="Cari siswa, sekolah, jurusan, email...">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="table" class="table modern-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="4%" class="text-center">No.</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan</th>
                                <th class="text-center">Foto</th>
                                <th>Kontak Siswa</th>
                                <th>Periode Magang</th>
                                <th>Guru Pembimbing</th>
                                <th>Pembimbing Lapangan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($data['data_pendaftaran'] as $item)
                                <tr>
                                    <td class="text-center">
                                        <span class="number-badge">{{ $no++ }}</span>
                                    </td>
                                    
                                    <td>
                                        <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                                            {{ $item->nama_lengkap ?? $item->user->name ?? '-' }}
                                        </div>
                                        @if($item->nim || $item->nisn)
                                            <div class="text-muted" style="font-size: 11px;">
                                                <i class="fas fa-id-card-alt mr-1"></i> {{ $item->nim ?? $item->nisn }}
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <div class="font-weight-600 text-dark" style="font-size: 13px;">
                                            <i class="fas fa-school text-primary mr-1"></i> {{ $item->universitas }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge-jurusan-pill">
                                            {{ strtoupper($item->jurusan) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        @if($item->gambar && file_exists(public_path('gambar/' . $item->gambar)))
                                            <img src="{{ asset('gambar/' . $item->gambar) }}" alt="{{ $item->nama_lengkap }}" class="student-avatar-img" title="{{ $item->nama_lengkap }}">
                                        @else
                                            <div class="student-avatar-fallback" title="{{ $item->nama_lengkap }}">
                                                {{ strtoupper(substr($item->nama_lengkap ?? $item->user->name ?? 'S', 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    
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
                                    
                                    <td>
                                        <div class="period-badge">
                                            <i class="far fa-calendar-alt text-primary mr-1"></i>
                                            <span>{{ $item->dari_tanggal }}</span>
                                            <span class="mx-1 text-muted font-weight-normal">s/d</span>
                                            <span>{{ $item->sampai_tanggal }}</span>
                                        </div>
                                    </td>
                                    
                                    <!-- KOLOM DROPWDOWN GURU PEMBIMBING -->
                                    <td>
                                        <form action="{{ route('admin.diterima.atur_pembimbing', $item->id_user_asli) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="input-group input-group-sm mentor-select-group">
                                                <select name="pembimbing_id" class="form-control form-control-sm mentor-select">
                                                    <option value="">-- Pilih Guru --</option>
                                                    @foreach($data['pembimbings'] as $pembimbing)
                                                        <option value="{{ $pembimbing->id }}" 
                                                            {{ $item->pembimbing_id == $pembimbing->id ? 'selected' : '' }}>
                                                            {{ $pembimbing->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-save-mentor btn-save-primary" title="Simpan Guru Pembimbing">
                                                        <i class="fas fa-save mr-1"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>

                                    <!-- KOLOM DROPWDOWN PEMBIMBING LAPANGAN -->
                                    <td>
                                        <form action="{{ route('admin.diterima.atur_pembimbing', $item->id_user_asli) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="input-group input-group-sm mentor-select-group">
                                                <select name="pembimbing_lapangan_id" class="form-control form-control-sm mentor-select">
                                                    <option value="">-- Pilih Mentor Lapangan --</option>
                                                    @foreach($data['pembimbing_lapangans'] as $pl)
                                                        <option value="{{ $pl->id }}" 
                                                            {{ $item->pembimbing_lapangan_id == $pl->id ? 'selected' : '' }}>
                                                            {{ $pl->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-save-mentor btn-save-info" title="Simpan Pembimbing Lapangan">
                                                        <i class="fas fa-save mr-1"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="text-center">
                                        <span class="badge-status-diterima">
                                            <i class="fas fa-check-circle mr-1"></i> Diterima
                                        </span>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-center">
                                        <a href="{{ url('detail-diterima/'.$item->id_pendaftaran) }}" class="btn btn-detail-action" title="Lihat Detail Profil Siswa">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
                                        <div style="font-size: 40px; color: #cbd5e1; margin-bottom: 12px;">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark mb-1">Belum Ada Data Siswa Diterima</h6>
                                        <p class="text-muted mb-0" style="font-size: 13px;">Data siswa yang telah disetujui akan ditampilkan otomatis di sini.</p>
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
