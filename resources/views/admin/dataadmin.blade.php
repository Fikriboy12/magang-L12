@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>

    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Data
    </button>

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
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center" width = "20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['users'] as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td>{{$item->alamat}}</td>
                                <td width = "10%" class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id}}">
                                        <i class="fa fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id}}">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                    {{-- <a href="{{url('delete-admin/'.$item->id)}}" class="btn btn-danger btn-sm"><i class = "fa fa-trash"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('insert-admin')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name = "name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name = "email" class="form-control" required>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="number" name = "no_telp" class="form-control" required>
                            </div> 
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat"  class="form-control" required cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name = "password" class="form-control" required>
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

@foreach ($data['users'] as $item)


<div class="modal fade" id="Update{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-admin')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="hidden" name = "id" value = "{{$item->id}}">
                        <input type="text" name = "name" class="form-control" value = "{{$item->name}}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name = "email" class="form-control" value = "{{$item->email}}" required>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="number" name = "no_telp" value = "{{$item->no_telp}}" class="form-control" required>
                            </div> 
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat"  class="form-control" required cols="30" rows="10" value = "{{$item->alamat}}">{{$item->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name = "password" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Delete{{$item->id}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Apakah Anda Yakin untuk Mennghapus</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-admin/'.$item->id)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach


@endsection
