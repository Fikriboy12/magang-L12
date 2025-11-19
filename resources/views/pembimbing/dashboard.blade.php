
@extends('template_admin.master_pembimbing')

@section('title', 'Dashboard Pembimbing')

@section('contents')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          {{-- ====================================================== --}}
          {{-- == PERBAIKAN: Judul H1 "Dashboard" DIHAPUS == --}}
          {{-- ====================================================== --}}
          <div class="col-sm-6">
            {{-- (Judul H1 "Dashboard" sudah dihapus dari sini) --}}
          </div>

          {{-- ====================================================== --}}
          {{-- == PERBAIKAN: Breadcrumb "Home/Dashboard" DIHAPUS == --}}
          {{-- ====================================================== --}}
          <div class="col-sm-6">
            {{-- (Breadcrumb sudah dihapus dari sini) --}}
          </div>
        
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="margin-top: -20px;"> {{-- (Kita naikkan sedikit kontennya) --}}
      <div class="container-fluid">
        
   
        <div class="row">
            <div class="col-12">
                {{-- (Warna gradient diubah menjadi ungu-biru) --}}
                <div class="card text-white" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
                    <div class="card-body">
                        <h4 class="card-title text-white">Selamat Datang, {{ Auth::user()->name }}!</h4>
                        <p class="card-text">
                            Di sini Anda dapat memantau laporan harian dari mahasiswa bimbingan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Info -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Mahasiswa Bimbingan</span>
                <span class="info-box-number">
                  {{ $mahasiswaList->count() }} <small>Orang</small>
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->


        <!-- Tabel Mahasiswa -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Mahasiswa Bimbingan Anda</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswaList as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->name }}</td>
                                    <td>{{ $mahasiswa->email }}</td>
                                    <td>
                                        <a href="{{ route('pembimbing.laporan.mahasiswa', $mahasiswa->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Laporan Harian
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada mahasiswa bimbingan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
{{-- AKHIR DARI content-wrapper --}}

@endsection