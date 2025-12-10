@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>

    <!-- Tombol Tambah Data dihapus karena ini data pelamar (biasanya hanya view) -->
    
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- TAMBAHAN: Wrapper Responsive Table -->
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th class="text-center" width="10%">Action</th> <!-- Lebar action dikecilkan dikit -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($data['data_pelamar'] as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->no_telp}}</td>
                                    
                                    {{-- Batasi panjang alamat di tabel agar tidak terlalu lebar --}}
                                    <td>{{ Str::limit($item->alamat, 50) }}</td>
                                    
                                    <td>
                                        @if ($item->status == 1)
                                            <div class="badge badge-primary">Lengkap</div>
                                        @else
                                            <div class="badge badge-warning">Tidak Lengkap</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Update{{$item->id}}">
                                            <i class="fa fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- End table-responsive -->

            </div>
        </div>
    </div>
</section>

@foreach ($data['data_pelamar'] as $item)

<!-- Modal Detail Data -->
<div class="modal fade" id="Update{{$item->id}}">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Modal Centered -->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Detail Data Pelamar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
       
            <div class="modal-body">
                {{-- Form dibuat readonly semua karena hanya detail view --}}
                
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{$item->name}}" readonly>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-12"> <!-- Responsif: col-12 di HP, col-md-6 di Laptop -->
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" value="{{$item->email}}" readonly>
                        </div>   
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input type="text" value="{{$item->no_telp}}" class="form-control" readonly>
                        </div> 
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" value="{{$item->nim}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" value="{{$item->nik}}" readonly>
                        </div>
                    </div>
                </div>
                
                <!-- Nama Lengkap (Redundant dari atas, bisa dihapus salah satu jika mau, tapi saya biarkan sesuai request) -->
                <div class="form-group">
                    <label>Nama Lengkap (Sesuai KTP/KTM)</label>
                    <input type="text" class="form-control" value="{{$item->nama_lengkap}}" readonly>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" value="{{$item->tempat_lahir}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{$item->tanggal_lahir}}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{$item->jenis_kelamin}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" class="form-control" value="{{$item->agama}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea class="form-control" style="height: 100px;" readonly>{{$item->alamat_lengkap}}</textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
         
        </div>
    </div>
</div>

@endforeach

@endsection