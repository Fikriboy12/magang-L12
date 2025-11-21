@extends('template.master')
@section('contents')
<div class="blog-page area-padding">
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center"><h2>Update Profile</h2></div>
                
                <form method="POST" action="{{url('update-profile-users')}}" class="needs-validation" novalidate="">
                    @csrf
                    @method('POST') 

                    {{-- NOTIFIKASI SUKSES (DIPERBAIKI) --}}
                    {{-- Kuncinya disamakan dengan Controller yaitu 'success' --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil! </strong>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- NOTIFIKASI ERROR --}}
                    @if (session('err_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error! </strong>{{ session('err_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- ERROR VALIDASI FORM --}}
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="frist_name">Nama Lengkap</label>
                                <input id="frist_name" type="text" class="form-control" name="nama_lengkap" autofocus required 
                                    value="{{ old('nama_lengkap', $data['profile']->name) }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" 
                                            value="{{ old('email', $data['profile']->email) }}" readonly>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Telepon</label>
                                        <input type="text" name="no_telp" 
                                            value="{{ old('no_telp', $data['profile']->no_telp) }}" class="form-control" required>
                                    </div> 
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>NIM</label>
                                    <input type="text" name="nim" class="form-control" required 
                                        value="{{ old('nim', $data['profile']->nim) }}">
                                </div>
                                <div class="form-group col-6">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control" required 
                                        value="{{ old('nik', $data['profile']->nik) }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required 
                                        value="{{ old('tempat_lahir', $data['profile']->tempat_lahir) }}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required 
                                        value="{{ old('tanggal_lahir', $data['profile']->tanggal_lahir) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin" class="form-control" required 
                                    value="{{ old('jenis_kelamin', $data['profile']->jenis_kelamin) }}">
                            </div>
                
                            <div class="form-group">
                                <label>Agama</label>
                                <input type="text" name="agama" class="form-control" required 
                                    value="{{ old('agama', $data['profile']->agama) }}">
                            </div>
                        
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" id="" required class="form-control" cols="30" rows="5">{{ old('alamat', $data['profile']->alamat) }}</textarea>
                            </div>
                            
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection