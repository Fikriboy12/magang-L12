@extends('template_admin.master')

@section('contents')

<section class="section">
    <div class="section-header">
        {{-- Mengambil title dari Controller --}}
        <h1>{{ $data['title'] }}</h1>
    </div>

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Pembimbing
    </button>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                {{-- Menampilkan Pesan Error/Success --}}
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
                    <ul>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        {{-- Looping data pembimbings dari Controller --}}
                        @foreach ($data['pembimbings'] as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                {{-- Menggunakan null coalescing operator (??) untuk mencegah error jika data kosong --}}
                                <td>{{$item->no_telp ?? '-'}}</td>
                                
                                <td style="white-space: normal; max-width: 250px;">
                                    {{$item->alamat ?? '-'}}
                                </td>

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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH DATA --}}
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Pembimbing</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            {{-- PENTING: Action form mengarah ke route store pembimbing --}}
            <form action="{{ route('admin.pembimbing.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" required placeholder="Nama Lengkap">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="email@contoh.com">
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="number" name="no_telp" class="form-control" required placeholder="08xxxx">
                            </div> 
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" required cols="30" rows="4" placeholder="Alamat Lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="8" placeholder="Minimal 8 karakter">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL UPDATE & DELETE --}}
@foreach ($data['pembimbings'] as $item)

    {{-- MODAL UPDATE (Hanya Tampilan, Fungsi Edit belum aktif agar tidak error) --}}
    <div class="modal fade" id="Update{{$item->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Pembimbing</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- Form dimatikan sementara agar tidak error route not found --}}
                    <form action="#" method="post"> 
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="{{ $item->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ $item->email }}" readonly>
                        </div>
                        <p class="text-muted">*Fitur Edit dan Hapus bisa diaktifkan setelah route ditambahkan.</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE (Hanya Tampilan) --}}
    <div class="modal fade" id="Delete{{$item->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin untuk Menghapus data <strong>{{ $item->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    {{-- Tombol Hapus dinonaktifkan sementara --}}
                    <button type="button" class="btn btn-danger" disabled>Hapus (Belum Aktif)</button>
                </div>
            </div>
        </div>
    </div>

@endforeach

@endsection