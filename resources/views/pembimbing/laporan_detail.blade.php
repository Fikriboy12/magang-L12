@extends('template_admin.master_pembimbing')

@section('title', 'Detail Laporan Mahasiswa')

@section('contents')

<div class="content-wrapper">
    
    <!-- Main Content -->
    <section class="content pt-4">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-graduate mr-1"></i>
                            Mahasiswa: <strong>{{ $mahasiswa->name ?? 'Mahasiswa' }}</strong>
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
                                        {{-- Judul Kolom diganti jadi Tanggal saja --}}
                                        <th style="width: 15%">Tanggal</th>
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
                                                {{-- PERUBAHAN DI SINI: Jam sudah dihapus --}}
                                                <strong>{{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d M Y') }}</strong>
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
                                                @if($laporan->foto)
                                                    @php
                                                        $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                                    @endphp
                                                    
                                                    {{-- TAMPILAN FOTO KECIL DI TABEL --}}
                                                    <a href="#" data-toggle="modal" data-target="#modalFoto{{ $laporan->id }}" title="Klik untuk memperbesar">
                                                        <img src="{{ $fotoUrl }}" alt="Foto Laporan" class="img-fluid rounded shadow-sm" style="max-height: 100px; cursor: pointer;">
                                                    </a>

                                                    {{-- MODAL POP-UP --}}
                                                    <div class="modal fade" id="modalFoto{{ $laporan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content" style="border-radius: 10px; border: none;">
                                                                
                                                                <div class="modal-header border-0 pb-0">
                                                                    <h5 class="modal-title font-weight-bold text-primary" style="font-size: 1.2rem;">
                                                                        Dokumentasi Kegiatan
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body text-center pt-3 pb-4">
                                                                    <img src="{{ $fotoUrl }}" class="img-fluid rounded shadow-lg" style="max-height: 75vh; width: auto;">
                                                                    
                                                                    <p class="mt-4 mb-0 text-muted font-italic font-weight-light" style="font-size: 1.1rem;">
                                                                        {{ $laporan->kegiatan }}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- End Modal --}}

                                                @else
                                                    <span class="badge badge-secondary">Tidak ada foto</span>
                                                @endif
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