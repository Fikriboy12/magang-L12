@extends('template_admin.master_orangtua')

@section('title', 'Monitoring Absensi Siswa')

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f3f4f6;
    }
</style>

<div class="content-wrapper">
    <section class="content pt-4 pb-5">
      <div class="container-fluid">
        
        {{-- Tombol Navigasi Kembali --}}
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('orangtua.dashboard') }}" class="btn btn-secondary px-3 py-2" style="border-radius: 8px;">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0 font-weight-bold text-dark">
                            <i class="fas fa-user-clock text-primary mr-2"></i>
                            Riwayat Absensi Kehadiran: <span class="text-primary">{{ $anak->name }}</span>
                        </h5>
                        <span class="badge badge-success px-3 py-2" style="border-radius: 20px;">
                            Total Kehadiran: {{ $riwayat->count() }} Hari
                        </span>
                    </div>

                    <div class="card-body p-4">
                        @if ($riwayat->isEmpty())
                            <div class="alert alert-warning text-center p-4">
                                <i class="fas fa-info-circle fa-2x mb-2 text-warning d-block"></i>
                                Belum ada riwayat absensi untuk siswa ini.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover datatable" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%" class="text-center">No</th>
                                            <th style="width: 15%">Tanggal</th>
                                            <th style="width: 12%" class="text-center">Jam Masuk</th>
                                            <th style="width: 12%" class="text-center">Jam Pulang</th>
                                            <th style="width: 20%" class="text-center">Bukti Foto</th>
                                            <th>Keterangan</th>
                                            <th style="width: 12%" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat as $row)
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                                <td class="align-middle">
                                                    <strong>{{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('d F Y') }}</strong>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($row->jam_masuk)
                                                        <span class="badge badge-success px-2 py-1">{{ $row->jam_masuk }} WIB</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($row->jam_keluar)
                                                        <span class="badge badge-warning px-2 py-1">{{ $row->jam_keluar }} WIB</span>
                                                    @else
                                                        <span class="badge badge-secondary px-2 py-1">Belum Pulang</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                                                        @if($row->foto_bukti)
                                                            <a href="{{ asset($row->foto_bukti) }}" target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-camera"></i> Masuk
                                                            </a>
                                                        @endif
                                                        
                                                        @if($row->foto_keluar)
                                                            <a href="{{ asset($row->foto_keluar) }}" target="_blank" class="btn btn-sm btn-warning text-white">
                                                                <i class="fas fa-camera"></i> Pulang
                                                            </a>
                                                        @endif

                                                        @if(!$row->foto_bukti && !$row->foto_keluar)
                                                            <span class="text-muted font-italic">-</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <small class="text-muted">{{ $row->keterangan ?? '-' }}</small>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-success px-3 py-1" style="border-radius: 20px;">
                                                        <i class="fas fa-check mr-1"></i> Hadir
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>
</div>

@endsection
