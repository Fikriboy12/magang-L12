@extends('template_admin.master')

@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{ $data['title'] }}</h1>
    </div>

    <button type="button" class="btn btn-primary mb-3 shadow-sm" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus mr-1"></i> Tambah Pembimbing Lapangan
    </button>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-tie mr-1"></i> Daftar Pembimbing Lapangan (Industri)
                </h6>
            </div>
            <div class="card-body table-responsive p-0">
                <table id="table" class="table table-striped table-hover text-nowrap mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th>Nama Mentor</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Siswa Bimbingan</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['pembimbing_lapangans'] as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle mr-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-weight-600 text-dark">{{ $item->name }}</span>
                                            <br>
                                            <small class="text-muted"><i class="fas fa-building mr-1"></i> PT. Media Balai Nusa</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telp ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-info px-2 py-1">
                                        <i class="fas fa-users mr-1"></i> {{ $item->siswa_lapangan_count ?? 0 }} Siswa
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id}}" title="Edit">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id}}" title="Hapus">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-info-circle fa-2x mb-2 d-block text-light"></i>
                                    Belum ada data Pembimbing Lapangan. Klik tombol "Tambah Pembimbing Lapangan" di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH DATA --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-circle mr-1"></i> Tambah Pembimbing Lapangan Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.pembimbing_lapangan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap Mentor <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Contoh: Budi Santoso, S.Kom">
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Email Login <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required placeholder="pembimbing.lapangan@mediabalainusa.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Password Login <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">No. WhatsApp / HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp" class="form-control" required placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Alamat / Divisi</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Divisi IT / Software Engineering">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Simpan Pembimbing Lapangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT & DELETE --}}
@foreach ($data['pembimbing_lapangans'] as $item)
    {{-- Modal Edit --}}
    <div class="modal fade" id="Update{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-1"></i> Edit Pembimbing Lapangan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pembimbing_lapangan.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Lengkap Mentor <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Email Login <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $item->email }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Password Baru <small class="text-muted font-italic">(Kosongkan jika tidak diganti)</small></label>
                                <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tetap">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">No. WhatsApp / HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_telp" class="form-control" value="{{ $item->no_telp }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Alamat / Divisi</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $item->alamat_lengkap }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning font-weight-bold text-dark">
                            <i class="fas fa-sync-alt mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="Delete{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="mb-2">Apakah Anda yakin ingin menghapus akun Pembimbing Lapangan berikut?</p>
                    <h5 class="text-danger font-weight-bold">{{ $item->name }}</h5>
                    <p class="text-muted small mb-0">{{ $item->email }}</p>
                </div>
                <div class="modal-footer bg-light justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ route('admin.pembimbing_lapangan.delete', $item->id) }}" class="btn btn-danger font-weight-bold">
                        <i class="fas fa-trash mr-1"></i> Ya, Hapus Data
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
