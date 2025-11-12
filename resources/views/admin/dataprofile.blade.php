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
                <form action="<?= url('update-profile')?>" method = "POST"  enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center"><h3>Gambar Perusahaan</h3></div>
                            <img src="<?= asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan)?>" alt="" width = "100%">
                            <div class="form-group text-center">
                                <label for="">Upload Gambar</label>
                                <input type="file" class = "form-control" name = "gambar">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input type="hidden" name = "id_perusahaan" value = "1">
                                <input type="text" name ="nama_perusahaan" class = "form-control" value = "<?= $data['profile']->nama_perusahaan?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Visi</label>
                                <input type="text" name = "visi" class = "form-control" value = "<?= $data['profile']->visi?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Misi</label>
                                <input type="text" name = "misi" class = "form-control" value = "<?= $data['profile']->misi?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name = "email" class = "form-control" value = "<?= $data['profile']->email?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="text" name = "no_hp" class = "form-control" value = "<?= $data['profile']->no_hp?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Facebook</label>
                                <input type="text" name = "facebook" class = "form-control" value = "<?= $data['profile']->facebook?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Instagram</label>
                                <input type="text" name = "instagram" class = "form-control" value = "<?= $data['profile']->instagram?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name = "alamat" class = "form-control" value = "<?= $data['profile']->alamat?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" id="" class = "form-control" value = "<?= $data['profile']->deskripsi?>" cols="30" rows="10" required><?= $data['profile']->deskripsi?></textarea>
                            </div>
                            <div class="text-right">
                                <button type = "submit" class = "btn btn-primary">Update Data</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
