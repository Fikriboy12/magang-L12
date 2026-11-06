@extends('template_admin.master_pembimbing')

@section('title', 'Detail Laporan Siswa')

@section('contents')

<div class="content-wrapper">
    
    <section class="content pt-4">
      <div class="container-fluid">
        
        {{-- Alert Notifikasi --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-times-circle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-graduate mr-1"></i>
                            Siswa: <strong>{{ $mahasiswa->name ?? 'Siswa' }}</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($laporan->isEmpty())
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-info-circle"></i> Siswa ini belum meng-upload laporan harian.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 15%">Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th style="width: 20%">Catatan</th>
                                            <th style="width: 15%">Foto</th>
                                            <th style="width: 10%" class="text-center">Status</th>
                                            <th style="width: 15%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporan as $item)
                                            <tr>
                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">
                                                    <strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</strong>
                                                </td>
                                                <td class="align-middle">{{ $item->kegiatan }}</td>
                                                <td class="align-middle">
                                                    @if($item->catatan)
                                                        {{ $item->catatan }}
                                                    @else
                                                        <span class="text-muted text-sm font-italic">- Tidak ada catatan -</span>
                                                    @endif
                                                </td>
                                                
                                                {{-- BAGIAN FOTO DENGAN MODAL POPUP --}}
                                                <td class="align-middle text-center">
                                                    @if(!empty($item->foto))
                                                        @php
                                                            // Logika Path Foto agar tidak broken
                                                            $pathFoto = $item->foto;
                                                            if (!str_contains($pathFoto, 'laporan_harian')) {
                                                                $pathFoto = 'laporan_harian/' . $pathFoto;
                                                            }
                                                            $fotoUrl = asset($pathFoto);
                                                        @endphp
                                                        
                                                        {{-- Thumbnail (Klik untuk membuka Modal) --}}
                                                        <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}">
                                                            <img src="{{ $fotoUrl }}" alt="Foto" class="img-fluid rounded shadow-sm" style="max-height: 80px; cursor: pointer; border: 1px solid #ddd;">
                                                        </a>

                                                        {{-- MODAL PREVIEW FOTO --}}
                                                        <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0 pb-0">
                                                                        <h6 class="modal-title">Dokumentasi: {{ $item->kegiatan }}</h6>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <img src="{{ $fotoUrl }}" class="img-fluid rounded" style="max-height: 80vh;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- End Modal --}}

                                                    @else
                                                        <span class="badge badge-secondary">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                
                                                <td class="align-middle text-center">
                                                    @if($item->status == 'approved')
                                                        <span class="badge badge-success">Disetujui</span>
                                                    @elseif($item->status == 'rejected')
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu</span>
                                                    @endif
                                                </td>

                                                <td class="align-middle text-center">
                                                    @if($item->status == 'pending')
                                                        <div class="btn-group">
                                                            <form action="{{ route('pembimbing.laporan.approve', $item->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui laporan ini?')" title="Acc">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('pembimbing.laporan.reject', $item->id) }}" method="POST" class="ml-1">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak laporan ini?')" title="Tolak">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-lock"></i> Selesai</button>
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