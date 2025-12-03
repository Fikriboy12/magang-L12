<header id="header" class="fixed-top">
    {{-- PERBAIKAN UTAMA: Menggunakan 'container-fluid' + 'px-5' agar navbar lebih lebar & muat --}}
    <div class="container-fluid d-flex align-items-center px-5">

        <div class="logo mr-auto">
            {{-- Pastikan text-decoration none agar link tidak bergaris bawah --}}
            <h1 class="text-light"><a href="{{ url('/')}}" style="text-decoration: none;"><span>E</span>-Magang</a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                {{-- Menu Standar --}}
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/#services') }}">Instruction</a></li>
                <li><a href="{{ url('/#blog') }}">Information</a></li>
                <li><a href="{{ url('/#contact') }}">Contact</a></li>
                <li><a href="{{ url('/#portfolio') }}">Gallery</a></li>
                
                {{-- LOGIKA BARU UNTUK PENDAFTARAN --}}
                @php
                    $showPendaftaran = true; // Default tampil (untuk guest/belum login)

                    if(Auth::check()){
                        // Cek status di database jika user sudah login
                        // Sesuaikan 'App\Models\Pendaftaran' dengan nama Model Anda
                        $dataPendaftaran = \App\Models\Pendaftaran::where('user_id', Auth::id())->first();
                        
                        // Jika ada data DAN statusnya 'Diterima', maka sembunyikan pendaftaran
                        if($dataPendaftaran && $dataPendaftaran->status == 'Diterima'){
                            $showPendaftaran = false;
                        }
                    }
                @endphp

                {{-- TAMPILKAN MENU PENDAFTARAN SESUAI KONDISI DI ATAS --}}
                @if($showPendaftaran)
                    <li class="{{ request()->is('pendaftaran') ? 'active' : '' }}">
                        <a href="{{ url('pendaftaran')}}">Pendaftaran</a>
                    </li>
                @endif

                {{-- Menu Lamaran (Selalu muncul atau sesuaikan kebutuhan) --}}
                <li class="{{ request()->is('data-lamaran') ? 'active' : '' }}"><a href="{{ url('data-lamaran')}}">Lamaran</a></li>


                {{-- Menu Khusus Pelamar Diterima (Laporan) --}}
                @auth
                    {{-- Kita pakai pengecekan $showPendaftaran == false artinya dia sudah Diterima --}}
                    @if(!$showPendaftaran || (Auth::user()->role == 'pelamar' && Auth::user()->status == 'diterima')) 
                        <li class="{{ request()->routeIs('mahasiswa.laporan*') ? 'active' : '' }}">
                            <a href="{{ route('mahasiswa.laporan.index') }}">Laporan Harian</a>
                        </li>
                    @endif
                @endauth

                {{-- Bagian Login / User Dropdown --}}
                @guest
                    <li><a href="{{ url('login') }}">Login</a></li>
                @else
                    <li class="drop-down">
                        <a href="#">{{ Auth::user()->name }}</a>
                        <ul>
                            <li><a href="{{ url('profile') }}">Profile</a></li>
                            <li>
                                <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>

    </div>
</header>