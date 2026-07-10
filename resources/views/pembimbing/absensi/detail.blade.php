@extends('template_admin.master_pembimbing')

@section('title', 'Riwayat Absensi')

@section('contents')

<section class="section">
    <div class="section-header">
        <h1>Riwayat Absensi: {{ $user->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing.absensi.index') }}">Monitoring</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>

    <div class="section-body">
        
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('pembimbing.absensi.index') }}" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Log Kehadiran</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Jam Masuk</th>
                                        <th class="text-center">Jam Pulang</th>
                                        <th class="text-center">Bukti Foto</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayat as $row)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        
                                        {{-- Tanggal Format Indonesia --}}
                                        <td class="font-weight-bold text-dark">
                                            {{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('d F Y') }}
                                        </td>
                                        
                                        <td class="text-center">
                                            <span class="badge badge-success">{{ $row->jam_masuk }} WIB</span>
                                        </td>
                                        
                                        <td class="text-center">
                                            @if($row->jam_keluar)
                                                <span class="badge badge-warning">{{ $row->jam_keluar }} WIB</span>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td class="text-center">
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
                                        </td>

                                        <td>
                                            <small>{{ Str::limit($row->keterangan ?? '-', 50) }}</small>
                                        </td>

                                        <td class="text-center">
                                            <div class="badge badge-success">Hadir</div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Belum ada data absensi.
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
@endsection