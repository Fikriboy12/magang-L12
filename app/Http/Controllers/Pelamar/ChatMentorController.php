<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chat;
use Carbon\Carbon;

class ChatMentorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'pelamar']);
    }

    public function index()
    {
        $siswa = Auth::user();

        // Cari pembimbing lapangan siswa
        $mentor = null;
        if ($siswa->pembimbing_lapangan_id) {
            $mentor = User::find($siswa->pembimbing_lapangan_id);
        }

        // Jika belum diset oleh admin, ambil salah satu akun pembimbing lapangan pertama
        if (!$mentor) {
            $mentor = User::where('role', 'pembimbing_lapangan')->first();
        }

        $messages = collect();
        if ($mentor) {
            // Tandai pesan dari mentor sebagai sudah dibaca
            Chat::where('sender_id', $mentor->id)
                ->where('receiver_id', $siswa->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            $messages = Chat::where(function($q) use ($siswa, $mentor) {
                $q->where('sender_id', $siswa->id)->where('receiver_id', $mentor->id);
            })->orWhere(function($q) use ($siswa, $mentor) {
                $q->where('sender_id', $mentor->id)->where('receiver_id', $siswa->id);
            })->orderBy('created_at', 'asc')->get();
        }

        return view('pelamar.chat_mentor', compact('siswa', 'mentor', 'messages'));
    }

    public function getMessagesAjax()
    {
        $siswa = Auth::user();
        $mentor = null;
        if ($siswa->pembimbing_lapangan_id) {
            $mentor = User::find($siswa->pembimbing_lapangan_id);
        }
        if (!$mentor) {
            $mentor = User::where('role', 'pembimbing_lapangan')->first();
        }

        if (!$mentor) {
            return response()->json(['status' => 'error', 'message' => 'Mentor belum tersedia.'], 404);
        }

        Chat::where('sender_id', $mentor->id)
            ->where('receiver_id', $siswa->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Chat::where(function($q) use ($siswa, $mentor) {
            $q->where('sender_id', $siswa->id)->where('receiver_id', $mentor->id);
        })->orWhere(function($q) use ($siswa, $mentor) {
            $q->where('sender_id', $mentor->id)->where('receiver_id', $siswa->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'siswa_id' => $siswa->id,
            'messages' => $messages->map(function($msg) use ($siswa) {
                return [
                    'id' => $msg->id,
                    'is_mine' => $msg->sender_id === $siswa->id,
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
            'message' => 'required_without:attachment|nullable|string',
            'attachment' => 'nullable|file|max:5120',
        ]);

        $siswa = Auth::user();
        $mentor = null;
        if ($siswa->pembimbing_lapangan_id) {
            $mentor = User::find($siswa->pembimbing_lapangan_id);
        }
        if (!$mentor) {
            $mentor = User::where('role', 'pembimbing_lapangan')->first();
        }

        if (!$mentor) {
            return response()->json(['status' => 'error', 'message' => 'Mentor belum tersedia.'], 422);
        }

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
            'sender_id' => $siswa->id,
            'receiver_id' => $mentor->id,
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
