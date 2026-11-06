@extends('template_admin.master')

@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{ $data['title'] }}</h1>
    </div>

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Orang Tua
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

        <div class="card">
            <div class="card-body table-responsive p-0">
                <table id="table" class="table table-striped table-hover text-nowrap">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th>Nama Orang Tua</th>
                            <th>Siswa / Anak Asuh</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @forelse ($data['orangtuas'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>
                                    @if ($item->anak)
                                        <span class="badge badge-primary py-1 px-2" style="font-size: 12px;">
                                            <i class="fas fa-user-graduate mr-1"></i> {{ $item->anak->name }}
                                        </span>
                                        @if($item->anak->nim)
                                            <small class="text-muted d-block mt-1">NIS/NIM: {{ $item->anak->nim }}</small>
                                        @endif
                                    @else
                                        <span class="badge badge-secondary py-1 px-2">Belum Terhubung</span>
                                    @endif
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telp ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id}}" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-users-slash mb-2" style="font-size: 30px; display: block;"></i>
                                    Belum ada data akun Orang Tua yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH DATA ORANG TUA --}}
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-user-plus text-primary mr-2"></i> Tambah Akun Orang Tua</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <form action="{{ route('admin.orangtua.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Pilih Siswa / Anak yang Diasuh <span class="text-danger">*</span></label>
                        <select name="siswa_id" class="form-control select2" required style="width: 100%;">
                            <option value="">-- Pilih Siswa / Mahasiswa --</option>
                            @foreach ($data['siswas'] as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->name }} {{ $siswa->nim ? '('.$siswa->nim.')' : '' }} - {{ $siswa->email }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Akun Orang Tua ini akan dapat memantau presensi & laporan siswa yang dipilih.</small>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Orang Tua / Wali <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Nama Lengkap Orang Tua" value="{{ old('name') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required placeholder="orangtua@email.com" value="{{ old('email') }}">
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_telp" class="form-control" required placeholder="08xxxxxxxxxx" value="{{ old('no_telp') }}">
                            </div> 
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Kata Sandi (Password) <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="8" placeholder="Minimal 8 karakter">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL UPDATE & DELETE LOOPING --}}
@foreach ($data['orangtuas'] as $item)

    {{-- MODAL UPDATE --}}
    <div class="modal fade" id="Update{{$item->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-user-edit text-warning mr-2"></i> Edit Data Orang Tua</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.orangtua.update') }}" method="post"> 
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">

                        <div class="form-group">
                            <label for="">Siswa / Anak Asuh <span class="text-danger">*</span></label>
                            <select name="siswa_id" class="form-control" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($data['siswas'] as $siswa)
                                    <option value="{{ $siswa->id }}" {{ $item->siswa_id == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->name }} {{ $siswa->nim ? '('.$siswa->nim.')' : '' }} - {{ $siswa->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Nama Orang Tua / Wali <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required value="{{$item->name}}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required value="{{$item->email}}">
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No WhatsApp / Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="no_telp" class="form-control" required value="{{$item->no_telp}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small></label>
                            <input type="password" name="password" class="form-control" minlength="8" placeholder="Biarkan kosong jika tidak diubah">
                        </div>

                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check mr-1"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="Delete{{$item->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun Orang Tua <strong>{{$item->name}}</strong>?</p>
                    <small class="text-muted">Data akun ini akan dihapus dari sistem.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ url('/delete-orang-tua/' . $item->id) }}" class="btn btn-danger">Ya, Hapus Akun</a>
                </div>
            </div>
        </div>
    </div>

@endforeach

@endsection
