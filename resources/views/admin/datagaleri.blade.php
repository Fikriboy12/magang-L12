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
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
                <div class="row">
                
                    <?php foreach ($data['galeri'] as $value) {?>
                            
                    <div class="col-md-4">
                        <div class="card img-fluid" style="width:500px">
                        <img class="card-img-top" src="<?= asset('assets_admin/img/galeri/'.$value->galeri_gambar)?>" alt="Card image" style="width:100%" height ="280px">
                        <div class="card-img-overlay">
                            <!-- <h4 class="card-title">John Doe</h4>
                            <p class="card-text">Some example text some example text. Some example text some example text. Some example text some example text. Some example text some example text.</p> -->
                            <button data-toggle="modal" data-target="#edit<?=$value->id_galeri?>" class = "btn btn-light btn-sm"><i class ="fas fa-edit"></i></button>
                            <a href="<?= url('delete-galeri/'.$value->id_galeri)?>" class="btn btn-sm btn-primary"><i class = "fas fa-trash"></i></a>
                        </div>
                        </div>
                    </div>
                    <?php }?>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('insert-galeri')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" class = "form-control" name = "gambar" id="gambar" required>
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

@foreach ($data['galeri'] as $item)


<div class="modal fade" id="Update{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-galeri')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="hidden" name = "id_galeri" value = "<?= $item->id_galeri?>">
                        <input type="file" class = "form-control" name = "gambar" id="lihat_gambar">
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

@endforeach


@endsection
