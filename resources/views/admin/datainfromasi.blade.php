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
                <!-- TAMBAHAN: Wrapper Responsive Table -->
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Informasi</th>
                                <th width="15%">Gambar</th>
                                <th class="text-center" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                              foreach ($data['data_informasi'] as $value) {?>
                              <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->judul?></td>
                                
                                {{-- Deskripsi dipotong agar tabel tidak terlalu panjang --}}
                                <td> <?=(str_word_count("$value->deskripsi") > 10 ? substr("$value->deskripsi",0,140)." ...." : "$value->deskripsi")?></td>
                                
                                <td><?= $value->tgl_informasi?></td>
                                
                                <td class="text-center">
                                    <!-- Gambar Responsif -->
                                    <img src="<?= asset('')?>assets_admin/img/informasi/<?= $value->gambar_informasi?>" alt="" class="img-fluid" style="max-width: 100px;">
                                </td>
                            
                                <td class="text-center"> 
                                    <!-- Tombol Aksi Responsif -->
                                    <div style="display: flex; gap: 5px; justify-content: center; flex-wrap: wrap;">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatedata<?= $value->id_informasi ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= url('delete-informasi/' . $value->id_informasi) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            
                              </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- End table-responsive -->

            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Data -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Modal Centered -->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('insert-informasi')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" name="judul" id="" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Penulis</label>
                        <input type="text" name="penulis" id="" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Informasi</label>
                        <input type="date" name="tgl_informasi" id="" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Deskripsi</label>
                        <!-- ID Summernote dihapus sementara jika tidak dipakai, ganti rows="5" -->
                        <textarea name="deskripsi" id="summernote" cols="30" rows="5" class="form-control" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" name="gambar" id="" class="form-control" required>
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

<!-- Modal Update Data -->
@foreach ($data['data_informasi'] as $value)
<div class="modal fade" id="updatedata{{$value->id_informasi}}">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Modal Centered -->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-informasi')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id_informasi" id="" class="form-control" value="<?= $value->id_informasi ?>">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" name="judul" id="" class="form-control" required value="<?= $value->judul?>">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control" required value="<?= $value->deskripsi?>"><?= $value->deskripsi?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Penulis</label>
                        <input type="text" name="penulis" id="" class="form-control" required value="<?= $value->penulis?>">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Informasi</label>
                        <input type="date" name="tgl_informasi" id="" class="form-control" required value="<?= $value->tgl_informasi?>">
                    </div>
                    <div class="form-group">
                      <label for="">Gambar (Biarkan kosong jika tidak diganti)</label>
                      <br>
                      <!-- Preview Gambar Responsif -->
                      <img src="<?= asset('')?>assets_admin/img/informasi/<?= $value->gambar_informasi?>" alt="" class="img-fluid mb-2" style="max-width: 150px;">
                      <input type="file" name="gambar" id="" class="form-control">
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