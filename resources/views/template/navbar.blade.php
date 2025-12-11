<header id="header" class="fixed-top">
    {{-- Container fluid + px-5 agar navbar lebar dan rapi --}}
    <div class="container-fluid d-flex align-items-center px-5">

        {{-- LOGO (DIKEMBALIKAN KE E-MAGANG) --}}
        <div class="logo mr-auto">
            <a href="{{ url('/')}}" style="text-decoration: none; display: flex; align-items: center;">
                <div style="width: 40px; height: 40px; background: #2563eb; color: white; font-size: 24px; font-weight: 800; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin-right: 10px;">
                    E
                </div>
                <span style="font-size: 22px; font-weight: 800; color: #0f172a; text-transform: uppercase;">
                    MAGANG
                </span>
            </a>
        </div>

        {{-- MENU NAVIGASI --}}
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a class="page-scroll" href="{{ request()->is('/') ? '#home' : url('/#home') }}">Beranda</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ request()->is('/') ? '#about' : url('/#about') }}">Tentang</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ request()->is('/') ? '#services' : url('/#services') }}">Alur Proses</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ request()->is('/') ? '#portfolio' : url('/#portfolio') }}">Galeri</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ request()->is('/') ? '#blog' : url('/#blog') }}">Berita</a>
                </li>
                
                {{-- LOGIKA: Cek Status Pendaftaran --}}
                @php
                    $showPendaftaran = true; 
                    if(Auth::check()){
                        $dataPendaftaran = \App\Models\Pendaftaran::where('id_users', Auth::id())->first();
                        if($dataPendaftaran && strtolower($dataPendaftaran->status_pendaftaran) == 'diterima'){
                            $showPendaftaran = false;
                        }
                    }
                @endphp

                @if($showPendaftaran)
                    <li class="{{ request()->is('registrasi') ? 'active' : '' }}">
                        <a href="{{ url('registrasi') }}">REGISTRASI</a>
                    </li>
                @endif
                
                {{-- Hanya tampilkan menu Lamaran/Laporan jika sudah login --}}
                @auth
                    @if(Auth::user()->role == 'pelamar')
                     <li class="{{ request()->is('pelamar/lamaran*') ? 'active' : '' }}"> 
                        <a href="{{ route('pelamar.lamaran.index') }}">Lamaran</a>
                     </li>
                    @endif
                
                    @if(!$showPendaftaran || (Auth::user()->role == 'pelamar' && Auth::user()->status == 'diterima')) 
                        <li class="{{ request()->routeIs('mahasiswa.laporan*') ? 'active' : '' }}">
                            <a href="{{ route('mahasiswa.laporan.index') }}">Laporan Harian</a>
                        </li>
                    @endif
                @endauth
                
                @guest
                    <li><a href="{{ url('login') }}">Masuk</a></li>
                @else
                    <li class="drop-down">
                        <a href="#">{{ Auth::user()->name }}</a>
                        <ul>
                            <li><a href="{{ route('profile.view') }}">Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>
        
        {{-- TOMBOL HUBUNGI KAMI UNTUK GUEST --}}
        @guest
             <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}" class="header-right-btn page-scroll" style="background: #0f172a; color: white; padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 700; text-decoration: none; margin-left: 15px;">Hubungi Kami</a>
        @endguest

    </div>
</header>