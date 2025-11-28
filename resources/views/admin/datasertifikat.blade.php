@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{$data['title']}}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                {{-- Alert Error/Success --}}
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            <strong>Error! </strong>{{ session()->get('err_message') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            <strong>Success! </strong>{{ session()->get('suc_message') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Mahasiswa</th>
                            <th>File Sertifikat</th>
                            <th>Status</th>
                            <th class="text-center" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data_sertifikat'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <b class="text-primary">{{ $item->nama_mahasiswa }}</b><br>
                                <small class="text-muted">{{ $item->universitas }}</small>
                            </td>
                            
                            {{-- STATUS FILE --}}
                            <td>
                                @if($item->file_path)
                                    <a href="{{ asset('sertifikat/' . $item->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm">
                                        <i class="fas fa-file-pdf"></i> Lihat File
                                    </a>
                                @else
                                    <span class="text-muted text-small font-italic">Belum diupload</span>
                                @endif
                            </td>

                            {{-- STATUS PENGAJUAN --}}
                            <td>
                                @if($item->status_pengajuan == 'acc' || $item->status_pengajuan == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($item->status_pengajuan == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>

                            <td class="text-center">
                                {{-- TOMBOL DETAIL --}}
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetail{{ $item->id }}" title="Detail Mahasiswa">
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- TOMBOL EDIT/UPLOAD --}}
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatedata{{ $item->id }}" title="Proses / Upload">
                                    <i class="fas fa-edit"></i>
                                </button>

                                {{-- TOMBOL HAPUS --}}
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{ $item->id }}" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- AREA MODAL --}}
@foreach ($data['data_sertifikat'] as $item)

    {{-- ========================================== --}}
    {{-- 1. MODAL DETAIL MAHASISWA --}}
    {{-- ========================================== --}}
    <div class="modal fade" id="modalDetail{{ $item->id }}">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-user-graduate mr-2"></i> Detail Pengajuan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th class="pl-4 py-3 text-primary" width="35%">Nama Lengkap</th>
                                <td class="py-3 font-weight-bold">{{ $item->nama_mahasiswa }}</td>
                            </tr>
                            <tr>
                                <th class="pl-4 py-3 text-primary">NIM</th>
                                <td class="py-3">{{ $item->nim ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="pl-4 py-3 text-primary">Universitas / Sekolah</th>
                                <td class="py-3">{{ $item->universitas }}</td>
                            </tr>
                            <tr>
                                <th class="pl-4 py-3 text-primary">Jurusan</th>
                                <td class="py-3">{{ $item->jurusan }}</td>
                            </tr>
                            <tr>
                                <th class="pl-4 py-3 text-primary">Program Studi</th>
                                <td class="py-3">{{ $item->program_studi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="pl-4 py-3 text-primary">Periode Magang</th>
                                <td class="py-3">
                                    <span class="text-dark">
                                        {{ \Carbon\Carbon::parse($item->dari_tanggal)->translatedFormat('d F Y') }} 
                                        s/d 
                                        {{ \Carbon\Carbon::parse($item->sampai_tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="pl-4 py-3 text-primary">Email</th>
                                <td class="py-3">{{ $item->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer bg-white border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary px-4" data-dismiss="modal" data-toggle="modal" data-target="#updatedata{{ $item->id }}">
                        <i class="fas fa-check-circle mr-1"></i> Proses / Acc
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 2. MODAL UPDATE / UPLOAD SERTIFIKAT --}}
    {{-- ========================================== --}}
    <div class="modal fade" id="updatedata{{ $item->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Proses Sertifikat</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ url('approve-sertifikat') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <div class="form-group">
                            <label class="font-weight-bold text-primary">Status Pengajuan</label>
                            <select class="form-control" name="status_pengajuan" required>
                                <option value="pending" {{ $item->status_pengajuan == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="acc" {{ $item->status_pengajuan == 'acc' ? 'selected' : '' }}>Acc / Approve</option>
                                <option value="rejected" {{ $item->status_pengajuan == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-primary">Upload File Sertifikat</label>
                            <input type="file" name="file_sertifikat" class="form-control" style="height: auto; padding: 10px;">
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle mr-1"></i> Upload sertifikat (PDF/Gambar) yang sudah ada namanya.<br>
                                File saat ini: <b>{{ $item->file_path ?? 'Kosong' }}</b>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 3. MODAL DELETE --}}
    {{-- ========================================== --}}
    <div class="modal fade" id="Delete{{ $item->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                    </div>
                    <p class="text-center">Apakah Anda yakin ingin menghapus data pengajuan milik <b>{{ $item->nama_mahasiswa }}</b>?</p>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    
                    {{-- Form Delete dengan URL 'admin/delete-sertifikat' agar tidak bentrok --}}
                    <form action="{{ url('admin/delete-sertifikat/'.$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE') 
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

@endforeach
@endsection