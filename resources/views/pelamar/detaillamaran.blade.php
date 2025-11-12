@extends('template.master')
@section('contents')
<div class="blog-page area-padding">
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center"><h2>Detail Lamaran</h2></div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Profile</h6>
                        <img src="<?= asset('')?>gambar/<?= $data['detail_pendaftaran']->gambar?>" alt="" width ="100%">
                        <br>
                        <br>
                        <h6>Detail Berkas</h6>
                        <a href="{{ url('berkas/'.$data['detail_pendaftaran']->ktp)}}" download class="btn btn-primary mt-1">Download KTP</a>
                        <a href="{{ url('berkas/'.$data['detail_pendaftaran']->cv)}}" download class="btn btn-warning mt-1">Download CV</a>
                        <a href="{{ url('berkas/'.$data['detail_pendaftaran']->surat_rekomendasi)}}" download class="btn btn-info mt-1">Download Surat Rekomendasi</a>
                        <a href="{{ url('berkas/'.$data['detail_pendaftaran']->proposal)}}" download class="btn btn-info mt-1">Download Proposal</a>
                        <div class="form-group">
                            <label>Universitas </label>
                            <input type="text" name = "agama" class="form-control" required value = "{{$data['detail_pendaftaran']->universitas}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" name = "agama" class="form-control" required value = "{{$data['detail_pendaftaran']->jurusan}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <input type="text" name = "agama" class="form-control" required value = "{{$data['detail_pendaftaran']->prodi}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="frist_name">Nama Lengkap</label>
                            <input id="frist_name" type="text" class="form-control" name="nama_lengkap" autofocus required value = "{{$data['detail_pendaftaran']->nama_lengkap}}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name = "email" class="form-control" value = "{{$data['detail_pendaftaran']->email}}" required readonly>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No Telepon</label>
                                    <input type="number" name = "no_telp" value = "{{$data['detail_pendaftaran']->no_telp}}" class="form-control" required readonly>
                                </div> 
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="form-group col-6">
                                <label>NIM</label>
                                <input type="text" name = "nim" class="form-control" required value = "{{$data['detail_pendaftaran']->nim}}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>NIK</label>
                                <input type="text" name = "nik" class="form-control" required value = "{{$data['detail_pendaftaran']->nik}}" readonly>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Tempat Lahir</label>
                                <input type="text" name = "tempat_lahir" class="form-control" required value = "{{$data['detail_pendaftaran']->tempat_lahir}}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" name = "tanggal_lahir" class="form-control" required value = "{{$data['detail_pendaftaran']->tanggal_lahir}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" name = "jenis_kelamin" class="form-control" required value = "{{$data['detail_pendaftaran']->jenis_kelamin}}" readonly>
                        </div>
    
          
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" name = "agama" class="form-control" required value = "{{$data['detail_pendaftaran']->agama}}" readonly>
                        </div>
                    
                        <div class="form-group">
                          <label>Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="" required value = "{{$data['detail_pendaftaran']->alamat_lengkap}}" readonly class="form-control" cols="30" rows="10">{{$data['detail_pendaftaran']->alamat_lengkap}}</textarea>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection