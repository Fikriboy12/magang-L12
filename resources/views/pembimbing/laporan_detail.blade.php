{{-- 
  File ini adalah KONTEN untuk melihat detail laporan per mahasiswa.
  Lokasi: resources/views/pembimbing/laporan_detail.blade.php
--}}

@extends('template_admin.master_pembimbing')

@section('title', 'Detail Laporan Mahasiswa')

@section('contents')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Laporan Harian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('pembimbing.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Detail Laporan</li>
            </ol>
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
                    <div class="card-header">
                        <h3 class="card-title">Mahasiswa: <strong>{{ $mahasiswa->name }}</strong></h3>
                    </div>
                    <div class="card-body">
                        @if ($laporanList->isEmpty())
                            <div class="alert alert-warning text-center">
                                Mahasiswa ini belum meng-upload laporan harian.
                            </div>
                        @else
                            {{-- Kita akan gunakan Timeline --}}
                            <div class="timeline">
                                @foreach ($laporanList as $laporan)
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-primary">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d F Y') }}</span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-check bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> {{ $laporan->created_at->format('H:i') }}</span>
                                            <h3 class="timeline-header"><strong>Kegiatan:</strong></h3>

                                            <div class="timeline-body">
                                                {{ $laporan->kegiatan }}

                                                @if ($laporan->catatan)
                                                    <hr>
                                                    <p><strong>Catatan:</strong> {{ $laporan->catatan }}</p>
                                                @endif
                                            </div>
                                            
                                            <div class="timeline-footer">
                                                @php
                                                    // PERBAIKAN DI SINI: Menggunakan satu titik (.) bukan tiga titik (...)
                                                    $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                                @endphp
                                                <a href="{{ $fotoUrl }}" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="fas fa-image"></i> Lihat Foto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                @endforeach
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection