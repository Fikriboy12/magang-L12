@extends('template_admin.master')

@section('title', 'Detail Absensi')

@section('contents')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Riwayat Absensi: {{ $user->name }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th> {{-- GANTI LOKASI JADI KETERANGAN --}}
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($row->tgl_absen)) }}</td>
                                    <td><span class="badge badge-success">{{ $row->jam_masuk }}</span></td>
                                    <td>
                                        @if($row->jam_keluar)
                                            <span class="badge badge-warning">{{ $row->jam_keluar }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->foto_bukti)
                                            <a href="{{ asset($row->foto_bukti) }}" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-camera"></i> Masuk</a>
                                        @endif
                                        @if($row->foto_keluar)
                                            <a href="{{ asset($row->foto_keluar) }}" target="_blank" class="btn btn-xs btn-warning"><i class="fas fa-camera"></i> Pulang</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Tampilkan Keterangan Manual --}}
                                        {{ $row->keterangan ?? '-' }}
                                    </td>
                                    <td>{{ $row->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection