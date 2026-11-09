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
                
                <!-- PERBAIKAN: Pembungkus Responsif Ditambahkan di sini -->
                <div class="table-responsive">

                    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead >
                            <tr >
                                <th width = "5%">No.</th>
                                <th>Nama Siswa</th>
                                <th>Asal SMK / Sekolah</th>
                                <th>Jurusan</th>
                                <th class="text-center">Foto</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Status</th>
                                <th class="text-center" width = "12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($data['data_pendaftaran'] as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td class="font-weight-600">{{$item->nama_lengkap}}</td>
                                    <td>{{$item->universitas}}</td>
                                    <td>{{$item->jurusan}}</td>
                                    <td class="text-center">
                                        @if($item->gambar && file_exists(public_path('gambar/' . $item->gambar)))
                                            <img src="{{ asset('gambar/' . $item->gambar) }}" alt="{{ $item->nama_lengkap }}" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                        @else
                                            <div style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #0284c7, #38bdf8); color: #fff; font-weight: bold; display: inline-flex; align-items: center; justify-content: center; font-size: 14px;">
                                                {{ strtoupper(substr($item->nama_lengkap ?? 'S', 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->no_telp}}</td>
                                    <td>{{$item->dari_tanggal}}</td>
                                    <td>{{$item->sampai_tanggal}}</td>
                                    <td>
                                        @if($item->status_pendaftaran == 'diterima')
                                            <span class="badge badge-success">Diterima</span>
                                        @elseif($item->status_pendaftaran == 'tidak diterima')
                                            <span class="badge badge-danger">Tidak Diterima</span>
                                        @else
                                            <span class="badge badge-warning">Pengajuan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('detail-pendaftaran/' . $item->id_pendaftaran) }}" class="btn btn-info btn-sm shadow-sm" title="Lihat Detail & Verifikasi">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                </div>
                <!-- AKHIR Pembungkus Responsif -->

            </div>
        </div>
    </div>
</section>

@endsection