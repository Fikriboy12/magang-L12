{{-- 
  File ini adalah DAFTAR laporan yg pernah di-submit mahasiswa.
  (Ini adalah kode TABEL, bukan TIMELINE)
--}}

@extends('template.master') 

@section('title', 'Daftar Laporan Harian')

{{-- 
  PERBAIKAN 1: 
  Menggunakan 'contents' (dengan 's') agar cocok dengan template.master
--}}
@section('contents')

{{-- 
  PERBAIKAN 2: 
  Memperbaiki 'class.' menjadi 'class="' (Sudah ada di kode ini)
--}}
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
                        {{-- Ini akan mengarah ke File 6 --}}
                        <a href="{{ route('mahasiswa.laporan.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Laporan Baru
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- Pesan Sukses setelah berhasil menyimpan --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- INI ADALAH KODE TABEL (YANG BENAR) --}}
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
                                        <td>{{ Str::limit($laporan->kegiatan, 70) }}</td> {{-- Batasi 70 karakter --}}
                                        <td>
                                            @php
                                                // Ubah path 'public/...' menjadi 'storage/...'
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
                        {{-- AKHIR DARI KODE TABEL --}}

                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
@endsection