@extends('template_admin.master_pembimbing')

@section('title', 'Monitoring Absensi')

@section('contents')

{{-- LANGSUNG SECTION (JANGAN PAKAI main-content LAGI) --}}
<section class="section">
    <div class="section-header">
        <h1>Monitoring Absensi</h1>
    </div>

    <div class="section-body">
        <div class="row">
            {{-- COL-12 AGAR LEBAR PENUH --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Mahasiswa Bimbingan Anda</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                {{-- HEADER BIRU PERSIS ADMIN --}}
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Email</th>
                                        <th>Instansi/Kampus</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mahasiswa as $row)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold text-dark">{{ $row->user->name }}</td>
                                        <td>{{ $row->user->email }}</td>
                                        <td>
                                            <div class="badge badge-light">
                                                {{ $row->universitas ?? $row->asal_sekolah ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('pembimbing.absensi.detail', $row->id_users) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> Lihat Riwayat
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-user-slash mb-2" style="font-size: 20px;"></i><br>
                                            Belum ada mahasiswa yang dikaitkan ke Anda.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection