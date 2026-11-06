@extends('template_admin.master_orangtua')

@section('title', 'Laporan Kegiatan Siswa')

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
                            <i class="fas fa-file-alt text-primary mr-2"></i>
                            Daftar Seluruh Laporan Kegiatan: <span class="text-primary">{{ $anak->name }}</span>
                        </h5>
                        <span class="badge badge-info px-3 py-2" style="border-radius: 20px;">
                            Total: {{ $laporan->count() }} Kegiatan
                        </span>
                    </div>

                    <div class="card-body p-4">
                        @if ($laporan->isEmpty())
                            <div class="alert alert-warning text-center p-4">
                                <i class="fas fa-info-circle fa-2x mb-2 text-warning d-block"></i>
                                Siswa belum pernah mengirimkan laporan kegiatan harian.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover datatable" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%" class="text-center">No</th>
                                            <th style="width: 15%">Tanggal</th>
                                            <th>Uraian Kegiatan</th>
                                            <th style="width: 20%">Catatan</th>
                                            <th style="width: 15%" class="text-center">Foto Bukti</th>
                                            <th style="width: 15%" class="text-center">Status ACC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporan as $item)
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                                <td class="align-middle">
                                                    <strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</strong>
                                                </td>
                                                <td class="align-middle" style="line-height: 1.5;">
                                                    {{ $item->kegiatan }}
                                                </td>
                                                <td class="align-middle">
                                                    @if($item->catatan)
                                                        <span class="text-dark">{{ $item->catatan }}</span>
                                                    @else
                                                        <span class="text-muted font-italic">- Tidak ada catatan -</span>
                                                    @endif
                                                </td>
                                                
                                                {{-- FOTO BUKTI DOKUMENTASI --}}
                                                <td class="align-middle text-center">
                                                    @if(!empty($item->foto))
                                                        @php
                                                            $pathFoto = $item->foto;
                                                            if (!str_contains($pathFoto, 'laporan_harian')) {
                                                                $pathFoto = 'laporan_harian/' . $pathFoto;
                                                            }
                                                            $fotoUrl = asset($pathFoto);
                                                        @endphp
                                                        
                                                        <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}">
                                                            <img src="{{ $fotoUrl }}" alt="Foto Kegiatan" class="img-fluid rounded shadow-sm" style="max-height: 70px; cursor: pointer; border: 1px solid #e5e7eb;">
                                                        </a>

                                                        {{-- MODAL PREVIEW FOTO --}}
                                                        <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-bold">
                                                                            <i class="fas fa-camera text-primary mr-2"></i> Dokumentasi Kegiatan ({{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }})
                                                                        </h6>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            <span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center p-3">
                                                                        <img src="{{ $fotoUrl }}" class="img-fluid rounded" style="max-height: 75vh;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted font-italic">- Tidak ada foto -</span>
                                                    @endif
                                                </td>

                                                {{-- STATUS APPROVAL --}}
                                                <td class="align-middle text-center">
                                                    @if($item->status == 'approved')
                                                        <span class="badge badge-success px-3 py-2" style="border-radius: 20px;">
                                                            <i class="fas fa-check-circle mr-1"></i> Disetujui
                                                        </span>
                                                    @elseif($item->status == 'rejected')
                                                        <span class="badge badge-danger px-3 py-2" style="border-radius: 20px;">
                                                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning text-white px-3 py-2" style="border-radius: 20px;">
                                                            <i class="fas fa-clock mr-1"></i> Menunggu ACC
                                                        </span>
                                                    @endif
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
