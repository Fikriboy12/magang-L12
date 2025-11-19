<header id="header" class="fixed-top">
<div class="container d-flex">

    <div class="logo mr-auto">
    <h1 class="text-light"><a href="{{ url('/')}}"><span>E</span>-Magang</a></h1>
    </div>

    <nav class="nav-menu d-none d-lg-block">
    <ul>
        <li class="active"><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/#services') }}">Instruction</a></li>
        <li><a href="{{ url('/#blog') }}">Information</a></li>
        <li><a href="{{ url('/#contact') }}">Contact</a></li>
        <li><a href="{{ url('/#portfolio') }}">Gallery</a></li>
        <li><a href="{{ url('pendaftaran')}}">Pendaftaran</a></li>
        <li><a href="{{ url('data-lamaran')}}">Lamaran</a></li>

        {{-- ========================================================== --}}
        {{-- == INI ADALAH KODE MENU (LINK) YANG BENAR == --}}
        {{-- ========================================================== --}}
        @auth  {{-- Cek dulu apakah user sudah login --}}
            {{-- Cek apakah rolenya 'pelamar' DAN statusnya 'diterima' --}}
            @if(Auth::user()->role == 'pelamar' && Auth::user()->status == 'diterima')
                <li class="nav-item">
                    {{-- Ini mengarah ke Rute yg kita buat di Langkah 4 --}}
                    <a href="{{ route('mahasiswa.laporan.index') }}" 
                       class="nav-link {{ request()->routeIs('mahasiswa.laporan*') ? 'active' : '' }}">
                        Laporan Harian
                    </a>
                </li>
            @endif
        @endauth
        {{-- ========================================================== --}}
        {{-- == AKHIR DARI KODE MENU == --}}
        {{-- ========================================================== --}}


        @guest
            {{-- Tampilkan ini jika user BELUM login --}}
            <li><a href="{{ url('login') }}">Login</a></li>
        @else
            {{-- Tampilkan ini jika user SUDAH login --}}
            <li class="drop-down"><a href="#">{{ Auth::user()->name }}</a>
                <ul>
                    <li><a href="{{ url('profile') }}">Profile</a></li>
                    <li>
                        {{-- Logout di Laravel HARUS menggunakan method="POST" --}}
                        <a href="{{ url('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
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
    </nav></div>
</header>