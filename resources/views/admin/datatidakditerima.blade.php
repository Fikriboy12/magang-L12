@extends('template_admin.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>
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
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead >
                        <tr >
                            <th width = "5%">No.</th>
                            <th>Nama</th>
                            <th>Universitas</th>
                            <th>Jurusan</th>
                            <th>Gambar</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                            <th>Status</th>
                            <th class="text-center" width = "20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['data_pendaftaran'] as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->nama_lengkap}}</td>
                                <td>{{$item->universitas}}</td>
                                <td>{{$item->jurusan}}</td>
                                <td width = "10%" class ="text-center"><img src="<?= asset('')?>gambar/<?= $item->gambar?>" alt="" width ="90%"></td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td>{{$item->dari_tanggal}}</td>
                                <td>{{$item->sampai_tanggal}}</td>
                                <td>{{$item->status_pendaftaran}}</td>
                                <td width = "10%" class="text-center">
                                    <a href="<?= url('detail-diterima/'.$item->id_pendaftaran) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

@endsection
