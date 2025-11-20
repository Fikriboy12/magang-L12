@extends('template_admin.master_pembimbing')

@section('title', 'Detail Laporan Mahasiswa')

@section('contents')

<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
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

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-graduate mr-1"></i>
                            Mahasiswa: <strong>{{ $mahasiswa->name }}</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($laporanList->isEmpty())
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-info-circle"></i> Mahasiswa ini belum meng-upload laporan harian.
                            </div>
                        @else
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 15%">Tanggal & Waktu</th>
                                        <th style="width: 35%">Kegiatan</th>
                                        <th style="width: 20%">Catatan</th>
                                        <th style="width: 25%">Foto Dokumentasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanList as $laporan)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">
                                                <strong>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</strong>
                                                <br>
                                                <small class="text-muted"><i class="far fa-clock"></i> {{ $laporan->created_at->format('H:i') }} WIB</small>
                                            </td>
                                            <td class="align-middle">
                                                {{ $laporan->kegiatan }}
                                            </td>
                                            <td class="align-middle">
                                                @if($laporan->catatan)
                                                    {{ $laporan->catatan }}
                                                @else
                                                    <span class="text-muted text-sm font-italic">- Tidak ada catatan -</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    // Logic path foto (Storage Link)
                                                    $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                                @endphp
                                                
                                                {{-- Menampilkan Foto Langsung --}}
                                                <a href="{{ $fotoUrl }}" target="_blank" title="Klik untuk memperbesar">
                                                    <img src="{{ $fotoUrl }}" alt="Foto Laporan" class="img-fluid rounded shadow-sm" style="max-height: 150px; max-width: 100%;">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
@endsection