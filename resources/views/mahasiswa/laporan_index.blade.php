{{-- 
  File ini adalah DAFTAR laporan (TABEL) untuk Mahasiswa.
--}}
@extends('template.master') 
@section('title', 'Daftar Laporan Harian')
@section('contents')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Harian Saya</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Laporan yang Sudah Di-submit</h3>
                        <a href="{{ route('mahasiswa.laporan.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Laporan Baru
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- KODE TABEL (YANG BENAR) --}}
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporanList as $laporan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</td>
                                        <td>{{ Str::limit($laporan->kegiatan, 70) }}</td>
                                        <td>
                                            @php
                                                $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                            @endphp
                                            <a href="{{ $fotoUrl }}" target="_blank" class="btn btn-info btn-sm">
                                                Lihat Foto
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Anda belum membuat laporan harian.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- AKHIR KODE TABEL --}}

                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
@endsection