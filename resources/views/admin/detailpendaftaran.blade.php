@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>{{$data['title']}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('data-pendaftaran') }}">Pendaftaran</a></div>
            <div class="breadcrumb-item active">Detail</div>
        </div>
    </div>
    
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible show fade" role="alert">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible show fade" role="alert">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        @php
            $p = $data['detail_pendaftaran'];
            $nisn = $p->nisn ?? $p->nim ?? '-';
            $namaSekolah = $p->nama_sekolah ?? $p->universitas ?? '-';
            $suratSekolah = $p->surat_pengantar ?? $p->surat_rekomendasi ?? null;
        @endphp

        <div class="row">
            <!-- KOLOM KIRI: PAS FOTO, DOKUMEN PERSYARATAN (D), DATA PELAKSANAAN (C) -->
            <div class="col-lg-4 col-md-12">
                <!-- PAS FOTO SISWA -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><i class="fas fa-image mr-1"></i> Pas Foto Siswa</h4>
                    </div>
                    <div class="card-body text-center">
                        @if($p->gambar)
                            <img src="{{ asset('gambar/'.$p->gambar) }}" alt="Pas Foto Siswa" class="img-fluid rounded shadow-sm" style="max-height: 280px; object-fit: cover;">
                            <div class="mt-2">
                                <a href="{{ asset('gambar/'.$p->gambar) }}" download class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-download mr-1"></i> Download Pas Foto
                                </a>
                            </div>
                        @else
                            <div class="alert alert-light text-muted">Belum ada foto</div>
                        @endif
                    </div>
                </div>

                <!-- D. DOKUMEN PERSYARATAN -->
                <div class="card card-info">
                    <div class="card-header bg-light">
                        <h4 class="text-info"><i class="fas fa-file-alt mr-1"></i> D. Dokumen Persyaratan</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="font-weight-bold text-dark"><i class="fas fa-file-pdf text-danger mr-1"></i> 1. CV Siswa</span>
                                @if($p->cv)
                                    <a href="{{ url('berkas/'.$p->cv) }}" target="_blank" download class="btn btn-sm btn-primary">
                                        <i class="fas fa-download mr-1"></i> Unduh
                                    </a>
                                @else
                                    <span class="badge badge-secondary">Tidak ada</span>
                                @endif
                            </div>
                            <small class="text-muted d-block">Identitas, riwayat pendidikan & keahlian</small>
                        </div>

                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="font-weight-bold text-dark"><i class="fas fa-file-pdf text-danger mr-1"></i> 2. Surat Pengantar Sekolah</span>
                                @if($suratSekolah)
                                    <a href="{{ url('berkas/'.$suratSekolah) }}" target="_blank" download class="btn btn-sm btn-info">
                                        <i class="fas fa-download mr-1"></i> Unduh
                                    </a>
                                @else
                                    <span class="badge badge-secondary">Tidak ada</span>
                                @endif
                            </div>
                            <small class="text-muted d-block">Bukti izin / rekomendasi dari pihak sekolah</small>
                        </div>

                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="font-weight-bold text-dark"><i class="fas fa-file-pdf text-danger mr-1"></i> 3. Surat Izin Orang Tua/Wali</span>
                                @if($p->surat_izin_wali)
                                    <a href="{{ url('berkas/'.$p->surat_izin_wali) }}" target="_blank" download class="btn btn-sm btn-success">
                                        <i class="fas fa-download mr-1"></i> Unduh
                                    </a>
                                @else
                                    <span class="badge badge-secondary">Tidak ada</span>
                                @endif
                            </div>
                            <small class="text-muted d-block">Bukti persetujuan dari orang tua / wali</small>
                        </div>

                        {{-- DOKUMEN TAMBAHAN / ARSIP LAMA --}}
                        @if($p->ktp || $p->proposal)
                            <div class="pt-2">
                                <span class="text-muted font-weight-bold small d-block mb-2">Dokumen Arsip:</span>
                                @if($p->ktp)
                                    <a href="{{ url('berkas/'.$p->ktp) }}" download class="btn btn-sm btn-outline-secondary mr-1 mb-1">Download KTP</a>
                                @endif
                                @if($p->proposal)
                                    <a href="{{ url('berkas/'.$p->proposal) }}" download class="btn btn-sm btn-outline-secondary mb-1">Download Proposal</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- C. DATA PELAKSANAAN MAGANG -->
                <div class="card card-warning">
                    <div class="card-header bg-light">
                        <h4 class="text-warning"><i class="fas fa-calendar-alt mr-1"></i> C. Pelaksanaan Magang</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label class="text-muted small mb-1">Tanggal Mulai Magang</label>
                            <div class="font-weight-bold text-dark">
                                <i class="far fa-calendar-check text-primary mr-1"></i>
                                {{ $p->dari_tanggal ? date('d F Y', strtotime($p->dari_tanggal)) : '-' }}
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="text-muted small mb-1">Tanggal Selesai Magang</label>
                            <div class="font-weight-bold text-dark">
                                <i class="far fa-calendar-times text-danger mr-1"></i>
                                {{ $p->sampai_tanggal ? date('d F Y', strtotime($p->sampai_tanggal)) : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: A. AKADEMIK, B. ORANG TUA/WALI, DATA DIRI SISWA -->
            <div class="col-lg-8 col-md-12">
                <!-- A. DATA AKADEMIK SISWA -->
                <div class="card card-primary">
                    <div class="card-header bg-light">
                        <h4 class="text-primary"><i class="fas fa-graduation-cap mr-1"></i> A. Data Akademik Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">1. NIS / NISN</label>
                                <input type="text" class="form-control" value="{{ $nisn }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">2. Nama Sekolah</label>
                                <input type="text" class="form-control" value="{{ $namaSekolah }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">3. Jurusan / Program Keahlian</label>
                                <input type="text" class="form-control" value="{{ $p->jurusan ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">4. Kelas</label>
                                <input type="text" class="form-control" value="{{ $p->kelas ?? '-' }}" readonly>
                            </div>
                        </div>

                        <hr class="mt-2 mb-3">
                        <h6 class="text-primary mb-3"><i class="fas fa-chalkboard-teacher mr-1"></i> Informasi Guru Pembimbing Sekolah</h6>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="small text-muted mb-1 font-weight-bold">5. Nama Guru Pembimbing</label>
                                <input type="text" class="form-control" value="{{ $p->nama_guru_pembimbing ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="small text-muted mb-1 font-weight-bold">6. Email Guru Pembimbing</label>
                                <input type="text" class="form-control" value="{{ $p->email_guru_pembimbing ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="small text-muted mb-1 font-weight-bold">7. No HP Guru Pembimbing</label>
                                <input type="text" class="form-control" value="{{ $p->no_hp_guru_pembimbing ?? '-' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- B. DATA ORANG TUA / WALI -->
                <div class="card card-success">
                    <div class="card-header bg-light">
                        <h4 class="text-success"><i class="fas fa-user-friends mr-1"></i> B. Data Orang Tua / Wali</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">1. Nama Orang Tua / Wali</label>
                                <input type="text" class="form-control" value="{{ $p->nama_wali ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">2. Hubungan dengan Siswa</label>
                                <input type="text" class="form-control" value="{{ $p->hubungan_wali ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">3. No HP Orang Tua / Wali</label>
                                <input type="text" class="form-control" value="{{ $p->no_hp_wali ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">4. Email Orang Tua / Wali</label>
                                <input type="text" class="form-control" value="{{ $p->email_wali ?? '-' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BIODATA DIRI SISWA -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="text-dark"><i class="fas fa-id-card mr-1"></i> Biodata Lengkap Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $p->nama_lengkap ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Email Siswa</label>
                                <input type="text" class="form-control" value="{{ $p->email ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">No Telepon / WhatsApp Siswa</label>
                                <input type="text" class="form-control" value="{{ $p->no_telp ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="{{ $p->jenis_kelamin ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Tempat Lahir</label>
                                <input type="text" class="form-control" value="{{ $p->tempat_lahir ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold">Tanggal Lahir</label>
                                <input type="text" class="form-control" value="{{ $p->tanggal_lahir ? date('d F Y', strtotime($p->tanggal_lahir)) : '-' }}" readonly>
                            </div>
                            <div class="col-12 form-group mb-0">
                                <label class="font-weight-bold">Alamat Lengkap</label>
                                <textarea class="form-control" rows="3" readonly>{{ $p->alamat_lengkap ?? '-' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI SELEKSI -->
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="{{ url('data-pendaftaran') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                        </a>
                        <div>
                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#TidakDiterima">
                                <i class="fas fa-times-circle mr-1"></i> Tolak / Tidak Diterima
                            </button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Diterima">
                                <i class="fas fa-check-circle mr-1"></i> Terima Pendaftaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TIDAK DITERIMA -->
<div class="modal fade" id="TidakDiterima">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger"><i class="fas fa-times-circle mr-1"></i> Konfirmasi Penolakan Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-tidak-diterima')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id_pendaftaran" value="{{$data['detail_pendaftaran']->id_pendaftaran}}">
                    <div class="form-group">
                        <label class="font-weight-bold">Alasan Penolakan</label>
                        <textarea name="keterangan" class="form-control" rows="5" placeholder="Contoh: Kuota jurusan telah penuh atau dokumen persyaratan belum sesuai." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-paper-plane mr-1"></i> Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DITERIMA -->
<div class="modal fade" id="Diterima">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success"><i class="fas fa-check-circle mr-1"></i> Konfirmasi Penerimaan Magang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-diterima')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id_pendaftaran" value="{{$data['detail_pendaftaran']->id_pendaftaran}}">
                    <div class="form-group">
                        <label class="font-weight-bold">Catatan / Keterangan Penerimaan</label>
                        <textarea name="keterangan" class="form-control" rows="5" placeholder="Contoh: Selamat! Silakan bergabung pada tanggal yang telah ditentukan dan membawa berkas asli."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Simpan & Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection