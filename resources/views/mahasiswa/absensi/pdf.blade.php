<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Rekapitulasi Absensi Magang' }}</title>
    <style>
        @page {
            margin: 25px 35px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #1a202c;
            line-height: 1.4;
        }

        /* KOP SURAT */
        .kop-table {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        .kop-table td {
            vertical-align: middle;
        }
        .kop-title {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kop-subtitle {
            font-size: 10px;
            color: #475569;
            margin: 2px 0 0 0;
        }

        /* JUDUL DOKUMEN */
        .doc-title-box {
            text-align: center;
            margin: 15px 0 12px 0;
        }
        .doc-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
            margin: 0;
            text-decoration: underline;
        }

        /* DATA IDENTITAS SISWA */
        .biodata-table {
            width: 100%;
            margin-bottom: 12px;
            border-collapse: collapse;
            font-size: 10.5px;
        }
        .biodata-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .biodata-label {
            width: 18%;
            color: #475569;
            font-weight: bold;
        }
        .biodata-colon {
            width: 2%;
        }
        .biodata-val {
            width: 30%;
            color: #0f172a;
            font-weight: 500;
        }

        /* RINGKASAN KEHADIRAN BOX */
        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            padding: 6px 12px;
            margin-bottom: 12px;
            font-size: 10px;
        }
        .summary-box td {
            padding: 2px 5px;
        }

        /* TABEL LOG ABSENSI */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 10px;
        }
        .table-data th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: bold;
            text-transform: uppercase;
            padding: 7px 6px;
            border: 1px solid #cbd5e1;
            text-align: center;
        }
        .table-data td {
            padding: 6px 6px;
            border: 1px solid #cbd5e1;
            vertical-align: middle;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }

        .badge-hadir {
            display: inline-block;
            background-color: #d1fae5;
            color: #065f46;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* TANDA TANGAN */
        .ttd-table {
            width: 100%;
            margin-top: 25px;
            page-break-inside: avoid;
        }
        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        .ttd-space {
            height: 60px;
        }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <table class="kop-table">
        <tr>
            <td style="text-align: center;">
                <h1 class="kop-title">PT. MEDIA BALAI NUSA (ASTRONET.ID)</h1>
                <p class="kop-subtitle">
                    Penyedia Layanan Internet (ISP) Berbasis Fiber Optik Resmi & Terpercaya<br>
                    Jl. Letjend. Suprapto (Titi Gantung), Beting Kuala Kapias, Teluk Nibung, Kota Tanjung Balai, Sumatera Utara 21335<br>
                    Email: support@astronet.id &bull; Telp/WhatsApp: +62 851-5712-7721
                </p>
            </td>
        </tr>
    </table>

    <!-- JUDUL DOKUMEN -->
    <div class="doc-title-box">
        <h2 class="doc-title">REKAPITULASI LOG ABSENSI & KEHADIRAN SISWA MAGANG</h2>
    </div>

    <!-- IDENTITAS SISWA PESERTA MAGANG -->
    @php
        $namaSiswa = $user->name ?? $pendaftaran->nama_lengkap ?? '-';
        $nisn = $pendaftaran->nisn ?? $user->nim ?? '-';
        $sekolah = $pendaftaran->nama_sekolah ?? $pendaftaran->universitas ?? '-';
        $jurusan = $pendaftaran->jurusan ?? '-';
        $kelas = $pendaftaran->kelas ?? '-';
        $pembimbing = $pendaftaran->nama_guru_pembimbing ?? '-';
        $periode = '-';
        if ($pendaftaran && $pendaftaran->dari_tanggal && $pendaftaran->sampai_tanggal) {
            $periode = date('d/m/Y', strtotime($pendaftaran->dari_tanggal)) . ' s/d ' . date('d/m/Y', strtotime($pendaftaran->sampai_tanggal));
        }
    @endphp

    <table class="biodata-table">
        <tr>
            <td class="biodata-label">Nama Siswa</td>
            <td class="biodata-colon">:</td>
            <td class="biodata-val">{{ $namaSiswa }}</td>
            <td class="biodata-label">Asal Sekolah</td>
            <td class="biodata-colon">:</td>
            <td class="biodata-val">{{ $sekolah }}</td>
        </tr>
        <tr>
            <td class="biodata-label">NIS / NISN</td>
            <td class="biodata-colon">:</td>
            <td class="biodata-val">{{ $nisn }}</td>
            <td class="biodata-label">Jurusan / Kelas</td>
            <td class="biodata-colon">:</td>
            <td class="biodata-val">{{ $jurusan }} {{ $kelas != '-' ? '('.$kelas.')' : '' }}</td>
        </tr>
        <tr>
            <td class="biodata-label">Guru Pembimbing</td>
            <td class="biodata-colon">:</td>
            <td class="biodata-val">{{ $pembimbing }}</td>
            <td class="biodata-label">Periode Magang</td>
            <td class="biodata-colon">:</td>
            <td class="biodata-val">{{ $periode }}</td>
        </tr>
    </table>

    <!-- RINGKASAN REKAPITULASI -->
    <table class="summary-box" width="100%">
        <tr>
            <td width="30%"><strong>Total Hari Tercatat:</strong> {{ $total_hari ?? count($riwayat) }} Hari</td>
            <td width="35%"><strong>Total Kehadiran (Hadir):</strong> {{ $total_hadir ?? 0 }} Hari</td>
            <td width="35%"><strong>Status Sinkronisasi:</strong> Terverifikasi Aplikasi Mobile APK</td>
        </tr>
    </table>

    <!-- TABEL DATA ABSENSI -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 25px;">No</th>
                <th style="width: 90px;">Hari / Tanggal</th>
                <th style="width: 80px;">Jam Masuk</th>
                <th style="width: 80px;">Jam Pulang</th>
                <th>Keterangan Aktivitas</th>
                <th style="width: 70px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center font-bold">
                        {{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('l') }}<br>
                        <span style="font-weight: normal; color: #475569;">
                            {{ \Carbon\Carbon::parse($row->tgl_absen)->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="text-center font-bold" style="color: #15803d;">
                        {{ $row->jam_masuk ? $row->jam_masuk . ' WIB' : '-' }}
                    </td>
                    <td class="text-center font-bold" style="color: #b91c1c;">
                        {{ $row->jam_keluar ? $row->jam_keluar . ' WIB' : '-' }}
                    </td>
                    <td>
                        {{ $row->keterangan ?? 'Hadir tepat waktu' }}
                    </td>
                    <td class="text-center">
                        <span class="badge-hadir">{{ $row->status ?? 'Hadir' }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px; color: #64748b;">
                        Belum ada data riwayat absensi yang tersimpan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- LEMBAR PENGESAHAN / TANDA TANGAN -->
    <table class="ttd-table">
        <tr>
            <td>
                Mengetahui,<br>
                <strong>Guru Pembimbing Sekolah</strong>
                <div class="ttd-space"></div>
                <strong><u>{{ $pembimbing != '-' ? $pembimbing : '( ............................................... )' }}</u></strong><br>
                <span>NIP / NUPTK: -</span>
            </td>
            <td>
                Tanjung Balai, {{ $tanggal_cetak ?? date('d F Y') }}<br>
                <strong>Peserta Magang</strong>
                <div class="ttd-space"></div>
                <strong><u>{{ $namaSiswa }}</u></strong><br>
                <span>NISN: {{ $nisn }}</span>
            </td>
        </tr>
    </table>

</body>
</html>
