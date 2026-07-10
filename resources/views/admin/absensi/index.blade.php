@extends('template_admin.master')

@section('title', 'Data Mahasiswa Magang')

@section('contents')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Monitoring Absensi</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Daftar Mahasiswa Aktif</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Email</th>
                                    <th>Asal Sekolah/Kampus</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- Nama Mahasiswa --}}
                                    <td><strong>{{ $row->user->name ?? '-' }}</strong></td>
                                    
                                    {{-- Email --}}
                                    <td>{{ $row->user->email ?? '-' }}</td>
                                    
                                    {{-- Asal Sekolah (Cek 'universitas' juga) --}}
                                    <td>
                                        {{ 
                                            $row->universitas ?? 
                                            $row->asal_sekolah ?? 
                                            $row->asal_kampus ?? 
                                            $row->instansi ?? 
                                            $row->sekolah ?? 
                                            '-' 
                                        }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.absensi.detail', $row->id_users) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Riwayat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection