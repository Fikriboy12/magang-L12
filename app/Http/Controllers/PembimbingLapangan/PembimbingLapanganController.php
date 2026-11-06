<?php

namespace App\Http\Controllers\PembimbingLapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Absensi;
use App\Models\LaporanHarian;
use App\Models\Sertifikat;
use App\Models\Pendaftaran;
use App\Models\Chat;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PembimbingLapanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'pembimbing_lapangan']);
    }

    /**
     * Ambil ID siswa bimbingan (dengan fallback jika belum diatur)
     */
    protected function getSiswaIds()
    {
        $mentorId = Auth::id();
        $siswaIds = User::where('role', 'pelamar')
                        ->where('pembimbing_lapangan_id', $mentorId)
                        ->pluck('id')
                        ->toArray();

        if (empty($siswaIds)) {
            $siswaIds = Pendaftaran::where('status_pendaftaran', 'diterima')
                                    ->pluck('id_users')
                                    ->toArray();
        }

        return $siswaIds;
    }

    /**
     * Ambil list model siswa bimbingan
     */
    protected function getSiswaList()
    {
        $siswaIds = $this->getSiswaIds();
        return User::whereIn('id', $siswaIds)
                    ->with('pendaftaran')
                    ->orderBy('name', 'asc')
                    ->get();
    }

    // ==========================================
    // 1. DASHBOARD
    // ==========================================
    public function dashboard()
    {
        $mentor = Auth::user();
        $siswaIds = $this->getSiswaIds();
        $today = Carbon::today()->toDateString();

        // Stats Cards
        $totalSiswa = count($siswaIds);
        
        $pendingLaporan = LaporanHarian::whereIn('user_id', $siswaIds)
                                        ->where('status', 'pending')
                                        ->count();

        $pendingIzin = Absensi::whereIn('id_users', $siswaIds)
                                ->whereIn('status', ['Izin', 'Sakit'])
                                ->where(function($q) {
                                    $q->whereNull('status_validasi')
                                      ->orWhere('status_validasi', 'pending');
                                })
                                ->count();

        $pengajuanSertifikat = Sertifikat::whereIn('created_by', $siswaIds)
                                         ->whereIn('status_pengajuan', ['pending', 'menunggu_verifikasi'])
                                         ->count();

        $unreadChats = Chat::where('receiver_id', $mentor->id)
                           ->where('is_read', false)
                           ->count();

        // Kehadiran hari ini
        $hadirToday = Absensi::whereIn('id_users', $siswaIds)
                             ->whereDate('tgl_absen', $today)
                             ->where('status', 'Hadir')
                             ->count();

        $izinToday = Absensi::whereIn('id_users', $siswaIds)
                            ->whereDate('tgl_absen', $today)
                            ->whereIn('status', ['Izin', 'Sakit'])
                            ->count();

        // Absensi terbaru hari ini
        $absensiTerbaru = Absensi::whereIn('id_users', $siswaIds)
                                 ->whereDate('tgl_absen', $today)
                                 ->with('user')
                                 ->latest()
                                 ->take(6)
                                 ->get();

        // Laporan menunggu ACC terbaru
        $laporanTerbaru = LaporanHarian::whereIn('user_id', $siswaIds)
                                        ->where('status', 'pending')
                                        ->with('user')
                                        ->latest()
                                        ->take(5)
                                        ->get();

        // Siswa Bimbingan
        $siswaList = $this->getSiswaList()->take(6);

        return view('pembimbing_lapangan.dashboard', compact(
            'mentor',
            'totalSiswa',
            'pendingLaporan',
            'pendingIzin',
            'pengajuanSertifikat',
            'unreadChats',
            'hadirToday',
            'izinToday',
            'absensiTerbaru',
            'laporanTerbaru',
            'siswaList'
        ));
    }

    // ==========================================
    // 2. ACC IZIN & SAKIT
    // ==========================================
    public function accIzin(Request $request)
    {
        $siswaIds = $this->getSiswaIds();
        $statusFilter = $request->get('status', 'all');
        $search = $request->get('search');

        $query = Absensi::whereIn('id_users', $siswaIds)
                        ->whereIn('status', ['Izin', 'Sakit'])
                        ->with(['user', 'user.pendaftaran']);

        if ($statusFilter === 'pending') {
            $query->where(function($q) {
                $q->whereNull('status_validasi')
                  ->orWhere('status_validasi', 'pending');
            });
        } elseif ($statusFilter === 'valid') {
            $query->where('status_validasi', 'valid');
        } elseif ($statusFilter === 'rejected') {
            $query->where('status_validasi', 'rejected');
        }

        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $izinList = $query->latest('tgl_absen')->paginate(15)->withQueryString();

        $countPending = Absensi::whereIn('id_users', $siswaIds)
                               ->whereIn('status', ['Izin', 'Sakit'])
                               ->where(function($q) {
                                   $q->whereNull('status_validasi')
                                     ->orWhere('status_validasi', 'pending');
                               })->count();

        $countValid = Absensi::whereIn('id_users', $siswaIds)
                             ->whereIn('status', ['Izin', 'Sakit'])
                             ->where('status_validasi', 'valid')
                             ->count();

        $countRejected = Absensi::whereIn('id_users', $siswaIds)
                                ->whereIn('status', ['Izin', 'Sakit'])
                                ->where('status_validasi', 'rejected')
                                ->count();

        return view('pembimbing_lapangan.izin.index', compact(
            'izinList',
            'statusFilter',
            'countPending',
            'countValid',
            'countRejected'
        ));
    }

    public function approveIzin($id)
    {
        $siswaIds = $this->getSiswaIds();
        $absensi = Absensi::whereIn('id_users', $siswaIds)->findOrFail($id);

        $absensi->update([
            'status_validasi' => 'valid'
        ]);

        return redirect()->back()->with('success', 'Pengajuan izin siswa berhasil di-ACC / Disetujui!');
    }

    public function rejectIzin(Request $request, $id)
    {
        $siswaIds = $this->getSiswaIds();
        $absensi = Absensi::whereIn('id_users', $siswaIds)->findOrFail($id);

        $alasan = $request->keterangan_penolakan ? ' [Ditolak: ' . $request->keterangan_penolakan . ']' : '';

        $absensi->update([
            'status_validasi' => 'rejected',
            'keterangan' => ($absensi->keterangan ?? '') . $alasan
        ]);

        return redirect()->back()->with('error', 'Pengajuan izin siswa telah ditolak.');
    }

    // ==========================================
    // 3. DATA LAPORAN HARIAN
    // ==========================================
    public function dataLaporan(Request $request)
    {
        $siswaIds = $this->getSiswaIds();
        $siswaList = $this->getSiswaList();

        $statusFilter = $request->get('status', 'all');
        $siswaFilter = $request->get('siswa_id');
        $search = $request->get('search');

        $query = LaporanHarian::whereIn('user_id', $siswaIds)
                              ->with(['user', 'user.pendaftaran']);

        if ($statusFilter !== 'all' && in_array($statusFilter, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $statusFilter);
        }

        if ($siswaFilter) {
            $query->where('user_id', $siswaFilter);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kegiatan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($qu) use ($search) {
                      $qu->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $laporanList = $query->latest('tanggal')->paginate(15)->withQueryString();

        $countPending = LaporanHarian::whereIn('user_id', $siswaIds)->where('status', 'pending')->count();
        $countApproved = LaporanHarian::whereIn('user_id', $siswaIds)->where('status', 'approved')->count();
        $countRejected = LaporanHarian::whereIn('user_id', $siswaIds)->where('status', 'rejected')->count();

        return view('pembimbing_lapangan.laporan.index', compact(
            'laporanList',
            'siswaList',
            'statusFilter',
            'siswaFilter',
            'countPending',
            'countApproved',
            'countRejected'
        ));
    }

    public function detailLaporanSiswa($siswa_id)
    {
        $siswaIds = $this->getSiswaIds();
        if (!in_array($siswa_id, $siswaIds)) {
            abort(403, 'Anda tidak memiliki hak akses ke siswa ini.');
        }

        $siswa = User::with('pendaftaran')->findOrFail($siswa_id);
        $laporan = LaporanHarian::where('user_id', $siswa_id)
                                ->orderBy('tanggal', 'desc')
                                ->paginate(20);

        return view('pembimbing_lapangan.laporan.detail', compact('siswa', 'laporan'));
    }

    public function approveLaporan(Request $request, $id)
    {
        $siswaIds = $this->getSiswaIds();
        $laporan = LaporanHarian::whereIn('user_id', $siswaIds)->findOrFail($id);

        $laporan->update([
            'status' => 'approved',
            'catatan' => $request->catatan ?? $laporan->catatan
        ]);

        return redirect()->back()->with('success', 'Laporan harian siswa berhasil disetujui (ACC)!');
    }

    public function rejectLaporan(Request $request, $id)
    {
        $siswaIds = $this->getSiswaIds();
        $laporan = LaporanHarian::whereIn('user_id', $siswaIds)->findOrFail($id);

        $laporan->update([
            'status' => 'rejected',
            'catatan' => $request->catatan ?? 'Laporan perlu direvisi.'
        ]);

        return redirect()->back()->with('error', 'Laporan harian siswa telah ditolak dan perlu revisi.');
    }

    public function downloadPdfLaporan($siswa_id)
    {
        $siswaIds = $this->getSiswaIds();
        if (!in_array($siswa_id, $siswaIds)) {
            abort(403);
        }

        $user = User::findOrFail($siswa_id);
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        $laporan = LaporanHarian::where('user_id', $user->id)
                                ->orderBy('tanggal', 'asc')
                                ->get();

        $pdf = Pdf::loadView('mahasiswa.laporan_harian.cetak_pdf', compact('user', 'pendaftaran', 'laporan'));
        $namaFile = 'Laporan_Magang_' . str_replace(' ', '_', $user->name) . '.pdf';

        return $pdf->stream($namaFile);
    }

    // ==========================================
    // 4. DATA ABSENSI SISWA
    // ==========================================
    public function dataAbsensi(Request $request)
    {
        $siswaIds = $this->getSiswaIds();
        $siswaList = $this->getSiswaList();

        $selectedDate = $request->get('tanggal', Carbon::today()->toDateString());
        $siswaFilter = $request->get('siswa_id');

        $query = Absensi::whereIn('id_users', $siswaIds)
                        ->with(['user', 'user.pendaftaran']);

        if ($selectedDate) {
            $query->whereDate('tgl_absen', $selectedDate);
        }

        if ($siswaFilter) {
            $query->where('id_users', $siswaFilter);
        }

        $absensiList = $query->latest('jam_masuk')->paginate(20)->withQueryString();

        // Ringkasan untuk tanggal terpilih
        $totalHadir = Absensi::whereIn('id_users', $siswaIds)
                             ->whereDate('tgl_absen', $selectedDate)
                             ->where('status', 'Hadir')
                             ->count();

        $totalIzin = Absensi::whereIn('id_users', $siswaIds)
                            ->whereDate('tgl_absen', $selectedDate)
                            ->where('status', 'Izin')
                            ->count();

        $totalSakit = Absensi::whereIn('id_users', $siswaIds)
                             ->whereDate('tgl_absen', $selectedDate)
                             ->where('status', 'Sakit')
                             ->count();

        $totalAlfa = Absensi::whereIn('id_users', $siswaIds)
                            ->whereDate('tgl_absen', $selectedDate)
                            ->where('status', 'Alfa')
                            ->count();

        return view('pembimbing_lapangan.absensi.index', compact(
            'absensiList',
            'siswaList',
            'selectedDate',
            'siswaFilter',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlfa'
        ));
    }

    public function detailAbsensiSiswa($siswa_id)
    {
        $siswaIds = $this->getSiswaIds();
        if (!in_array($siswa_id, $siswaIds)) {
            abort(403);
        }

        $siswa = User::with('pendaftaran')->findOrFail($siswa_id);
        $absensiList = Absensi::where('id_users', $siswa_id)
                              ->orderBy('tgl_absen', 'desc')
                              ->paginate(25);

        $countHadir = Absensi::where('id_users', $siswa_id)->where('status', 'Hadir')->count();
        $countIzin  = Absensi::where('id_users', $siswa_id)->where('status', 'Izin')->count();
        $countSakit = Absensi::where('id_users', $siswa_id)->where('status', 'Sakit')->count();
        $countAlfa  = Absensi::where('id_users', $siswa_id)->where('status', 'Alfa')->count();

        return view('pembimbing_lapangan.absensi.detail', compact(
            'siswa',
            'absensiList',
            'countHadir',
            'countIzin',
            'countSakit',
            'countAlfa'
        ));
    }

    public function downloadPdfAbsensi($siswa_id)
    {
        $siswaIds = $this->getSiswaIds();
        if (!in_array($siswa_id, $siswaIds)) {
            abort(403);
        }

        $user = User::findOrFail($siswa_id);
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        $absensi = Absensi::where('id_users', $user->id)
                          ->orderBy('tgl_absen', 'asc')
                          ->get();

        $pdf = Pdf::loadView('mahasiswa.absensi.cetak_pdf', compact('user', 'pendaftaran', 'absensi'));
        $namaFile = 'Presensi_Magang_' . str_replace(' ', '_', $user->name) . '.pdf';

        return $pdf->stream($namaFile);
    }

    // ==========================================
    // 5. PENGAJUAN SERTIFIKAT
    // ==========================================
    public function pengajuanSertifikat(Request $request)
    {
        $siswaIds = $this->getSiswaIds();
        $statusFilter = $request->get('status', 'all');

        $query = Sertifikat::whereIn('created_by', $siswaIds)
                           ->with(['user', 'user.pendaftaran']);

        if ($statusFilter !== 'all') {
            $query->where('status_pengajuan', $statusFilter);
        }

        $sertifikatList = $query->latest('created_at')->paginate(15)->withQueryString();

        $countPending = Sertifikat::whereIn('created_by', $siswaIds)
                                  ->whereIn('status_pengajuan', ['pending', 'menunggu_verifikasi'])
                                  ->count();

        $countDisetujui = Sertifikat::whereIn('created_by', $siswaIds)
                                    ->where('status_pengajuan', 'disetujui')
                                    ->count();

        $countDitolak = Sertifikat::whereIn('created_by', $siswaIds)
                                  ->where('status_pengajuan', 'ditolak')
                                  ->count();

        return view('pembimbing_lapangan.sertifikat.index', compact(
            'sertifikatList',
            'statusFilter',
            'countPending',
            'countDisetujui',
            'countDitolak'
        ));
    }

    public function approveSertifikat(Request $request, $id)
    {
        $siswaIds = $this->getSiswaIds();
        $sertifikat = Sertifikat::whereIn('created_by', $siswaIds)->findOrFail($id);

        $updateData = [
            'status_pengajuan' => 'disetujui',
            'updated_at' => Carbon::now()
        ];

        // Jika mentor mengunggah file sertifikat final PDF
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('sertifikat'), $filename);
            $updateData['file_path'] = $filename;
        }

        $sertifikat->update($updateData);

        return redirect()->back()->with('success', 'Pengajuan e-sertifikat magang berhasil disetujui (ACC)!');
    }

    public function rejectSertifikat(Request $request, $id)
    {
        $siswaIds = $this->getSiswaIds();
        $sertifikat = Sertifikat::whereIn('created_by', $siswaIds)->findOrFail($id);

        $sertifikat->update([
            'status_pengajuan' => 'ditolak',
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back()->with('error', 'Pengajuan e-sertifikat telah ditolak.');
    }

    // ==========================================
    // 6. FITUR CHAT DENGAN SISWA
    // ==========================================
    public function chatRoom($siswa_id = null)
    {
        $mentor = Auth::user();
        $siswaIds = $this->getSiswaIds();
        $siswaList = $this->getSiswaList();

        // Cari siswa aktif untuk chat
        $activeSiswa = null;
        if ($siswa_id) {
            $activeSiswa = User::whereIn('id', $siswaIds)->findOrFail($siswa_id);
        } elseif ($siswaList->isNotEmpty()) {
            $activeSiswa = $siswaList->first();
        }

        // Ambil riwayat chat jika siswa aktif ditemukan
        $messages = collect();
        if ($activeSiswa) {
            // Tandai pesan dari siswa sebagai sudah dibaca
            Chat::where('sender_id', $activeSiswa->id)
                ->where('receiver_id', $mentor->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            $messages = Chat::where(function($q) use ($mentor, $activeSiswa) {
                $q->where('sender_id', $mentor->id)->where('receiver_id', $activeSiswa->id);
            })->orWhere(function($q) use ($mentor, $activeSiswa) {
                $q->where('sender_id', $activeSiswa->id)->where('receiver_id', $mentor->id);
            })->orderBy('created_at', 'asc')->get();
        }

        // Hitung unread per siswa
        $unreadPerSiswa = Chat::where('receiver_id', $mentor->id)
                              ->where('is_read', false)
                              ->select('sender_id', DB::raw('count(*) as total'))
                              ->groupBy('sender_id')
                              ->pluck('total', 'sender_id')
                              ->toArray();

        // Pesan terakhir per siswa
        $lastMessages = [];
        foreach ($siswaList as $s) {
            $lastChat = Chat::where(function($q) use ($mentor, $s) {
                $q->where('sender_id', $mentor->id)->where('receiver_id', $s->id);
            })->orWhere(function($q) use ($mentor, $s) {
                $q->where('sender_id', $s->id)->where('receiver_id', $mentor->id);
            })->latest('created_at')->first();

            $lastMessages[$s->id] = $lastChat;
        }

        return view('pembimbing_lapangan.chat.index', compact(
            'mentor',
            'siswaList',
            'activeSiswa',
            'messages',
            'unreadPerSiswa',
            'lastMessages'
        ));
    }

    public function getMessagesAjax($siswa_id)
    {
        $mentor = Auth::user();
        $siswaIds = $this->getSiswaIds();

        if (!in_array($siswa_id, $siswaIds)) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        // Tandai sebagai read
        Chat::where('sender_id', $siswa_id)
            ->where('receiver_id', $mentor->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Chat::where(function($q) use ($mentor, $siswa_id) {
            $q->where('sender_id', $mentor->id)->where('receiver_id', $siswa_id);
        })->orWhere(function($q) use ($mentor, $siswa_id) {
            $q->where('sender_id', $siswa_id)->where('receiver_id', $mentor->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'mentor_id' => $mentor->id,
            'messages' => $messages->map(function($msg) use ($mentor) {
                return [
                    'id' => $msg->id,
                    'is_mine' => $msg->sender_id === $mentor->id,
                    'message' => e($msg->message),
                    'attachment' => $msg->attachment ? asset('uploads/chat/' . $msg->attachment) : null,
                    'time' => Carbon::parse($msg->created_at)->format('H:i'),
                    'date' => Carbon::parse($msg->created_at)->translatedFormat('d M Y'),
                ];
            })
        ]);
    }

    public function sendMessageAjax(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required_without:attachment|nullable|string',
            'attachment' => 'nullable|file|max:5120',
        ]);

        $mentor = Auth::user();
        $receiverId = $request->receiver_id;

        $attachmentName = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/chat');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $attachmentName);
        }

        $chat = Chat::create([
            'sender_id' => $mentor->id,
            'receiver_id' => $receiverId,
            'message' => $request->message ?? '',
            'attachment' => $attachmentName,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'chat' => [
                'id' => $chat->id,
                'is_mine' => true,
                'message' => e($chat->message),
                'attachment' => $chat->attachment ? asset('uploads/chat/' . $chat->attachment) : null,
                'time' => Carbon::parse($chat->created_at)->format('H:i'),
                'date' => Carbon::parse($chat->created_at)->translatedFormat('d M Y'),
            ]
        ]);
    }
}
