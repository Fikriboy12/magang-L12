@extends('template.master')

@section('title', 'Buat Laporan Harian')

@section('contents')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Laporan Harian</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
            {{-- BAGIAN 1: FORMULIR INPUT --}}
            <div class="col-12 mb-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Isi Laporan Harian</h3>
                    </div>
                    
                    {{-- PENTING: Tampilkan Error Validasi --}}
                    {{-- Jika form refresh sendiri, pesan error akan muncul di sini --}}
                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <strong>Gagal Upload!</strong> Silakan periksa inputan Anda:<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- PENTING: enctype="multipart/form-data" WAJIB ADA untuk upload foto --}}
                    <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            
                            {{-- Input Tanggal --}}
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            </div>

                            {{-- Input Kegiatan --}}
                            <div class="form-group">
                                <label>Deskripsi Kegiatan </label>
                                <textarea name="kegiatan" class="form-control" rows="3" placeholder="Ceritakan kegiatan hari ini..." required>{{ old('kegiatan') }}</textarea>
                                <small class="text-muted">.</small>
                            </div>

                            {{-- Input Foto --}}
                            <div class="form-group">
                                <label>Foto Dokumentasi (Wajib, Max 2MB)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        {{-- accept="image/*" membatasi agar user hanya bisa pilih gambar --}}
                                        <input type="file" name="foto" class="custom-file-input" id="fotoInput" accept="image/*" required>
                                        <label class="custom-file-label" for="fotoInput">Pilih file foto...</label>
                                    </div>
                                </div>
                                <small class="text-danger">* Pastikan format jpg, jpeg, atau png.</small>
                            </div>

                            {{-- Input Catatan --}}
                            <div class="form-group">
                                <label>Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="2">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Laporan</button>
                            <a href="{{ route('mahasiswa.laporan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- BAGIAN 2: TABEL RIWAYAT (Seperti yang Anda minta) --}}
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Laporan Sebelumnya</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporanList as $laporan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</td>
                                        <td>{{ Str::limit($laporan->kegiatan, 70) }}</td>
                                        <td>
                                            @php
                                                $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                            @endphp
                                            <a href="{{ $fotoUrl }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-image"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada laporan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </section>
</div>
@endsection

@section('scripts')
<!-- Script agar nama file muncul saat dipilih -->
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endsection