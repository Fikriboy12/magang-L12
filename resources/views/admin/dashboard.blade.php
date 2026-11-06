@extends('template_admin.master')

@section('contents')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f8;
}
.section {
    padding-top: 20px;
}
.hero {
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(60, 185, 224, 0.25);
    text-align: center;
    background: linear-gradient(135deg, #1e3c72 0%, #0077b6 50%, #3CB9E0 100%);
    color: #fff;
    margin-bottom: 30px;
}
.hero h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 8px;
}
.hero p.lead {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.card-statistic-1 {
    border: none;
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    margin-bottom: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    min-height: 120px;
}
.card-statistic-1:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}
.card-statistic-1 .card-icon {
    width: 80px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    color: #fff;
    border-radius: 15px 0 0 15px;
}
.card-icon.bg-primary { background: linear-gradient(135deg, #0284c7, #3CB9E0) !important; }
.card-icon.bg-info { background-color: #3abaf4 !important; }
.card-icon.bg-success { background-color: #63ed7a !important; }
.card-icon.bg-warning { background-color: #ffa426 !important; }
.card-icon.bg-danger { background-color: #fc544b !important; }

.card-statistic-1 .card-wrap {
    padding: 20px 25px;
    flex-grow: 1;
}
.card-statistic-1 .card-header h4 {
    font-size: 0.95rem;
    font-weight: 500;
    color: #6c757d;
    margin-bottom: 5px;
}
.card-statistic-1 .card-body {
    font-size: 2rem;
    font-weight: 700;
    color: #34395e;
    padding: 0;
    line-height: 1.2;
}
</style>

<section class="section">
    <div class="section-header" style="border-radius: 15px; background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 15px 25px;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #34395e; margin-bottom: 0;">
            {{ $data['title'] ?? 'Dashboard' }}
        </h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if (session('err_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('err_message') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
                @if (session('suc_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="hero">
                    <h2>Welcome, {{ Auth::user()->name ?? 'Admin' }}!</h2>
                    <p class="lead">Kelola data web ini dengan baik dan benar!</p>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Kartu Data Pelamar --}}
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>Data Siswa</h4></div>
                        <div class="card-body">{{ $data['pelamar'] ?? $data['jumlah_pelamar_user'] ?? 0 }}</div>
                    </div>
                </div>
            </div>

            {{-- Kartu Data Diterima --}}
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="far fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>Data Diterima</h4></div>
                        <div class="card-body">{{ $data['diterima'] ?? 0 }}</div>
                    </div>
                </div>
            </div>

            {{-- Kartu Data Ditolak --}}
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-times-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header"><h4>Data Ditolak</h4></div>
                        <div class="card-body">{{ $data['tidak_diterima'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
