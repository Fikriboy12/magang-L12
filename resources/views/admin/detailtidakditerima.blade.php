@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
        <h1>{{$data['title']}}</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- KOLOM KIRI: FOTO & BERKAS -->
                    <div class="col-md-6">
                        <h6>Profile</h6>
                        <img src="<?= asset('')?>gambar/<?= $data['detail_tidak_diterima']->gambar?>" alt="" width ="100%">
                        <br><br>
                        <h6>Detail Berkas</h6>
                        <a href="{{ url('berkas/'.$data['detail_tidak_diterima']->ktp)}}" download class="btn btn-primary mt-1">Download KTP</a>
                        <a href="{{ url('berkas/'.$data['detail_tidak_diterima']->cv)}}" download class="btn btn-warning mt-1">Download CV</a>
                        <a href="{{ url('berkas/'.$data['detail_tidak_diterima']->surat_rekomendasi)}}" download class="btn btn-info mt-1">Download Surat Rekomendasi</a>
                        <a href="{{ url('berkas/'.$data['detail_tidak_diterima']->proposal)}}" download class="btn btn-info mt-1">Download Proposal</a>
                        
                        <div class="form-group mt-3">
                            <label>Universitas</label>
                            <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->universitas}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->jurusan}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->prodi}}" readonly>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: BIODATA -->
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->nama_lengkap}}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{$data['detail_tidak_diterima']->email}}" readonly>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->no_telp}}" readonly>
                                </div> 
                            </div>
                        </div>
                      
                        <!-- NIK DIHAPUS -->
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->nim}}" readonly>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->tempat_lahir}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" value="{{$data['detail_tidak_diterima']->tanggal_lahir}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{$data['detail_tidak_diterima']->jenis_kelamin}}" readonly>
                        </div>
    
                        <!-- AGAMA DIHAPUS -->

                        <!-- ALAMAT LENGKAP -->
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea class="form-control" readonly rows="4">{{$data['detail_tidak_diterima']->alamat_lengkap}}</textarea>
                        </div>
                        
                        <!-- ALASAN PENOLAKAN -->
                        <div class="form-group">
                            <label>Alasan Tidak Diterima</label>
                            <textarea class="form-control" readonly rows="3" style="border: 1px solid #fc544b;">{{$data['detail_tidak_diterima']->keterangan}}</textarea>
                        </div>

                        <div class="text-right mt-4">
                            <a href="{{ url('data-tidak-diterima') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection