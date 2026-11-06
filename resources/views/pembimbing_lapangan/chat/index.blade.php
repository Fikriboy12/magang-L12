@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Ruang Chat Pembimbing Lapangan & Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Chat Siswa</div>
        </div>
    </div>

    <style>
        .chat-app {
            display: flex;
            height: calc(100vh - 210px);
            min-height: 550px;
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        /* Sidebar Kontak */
        .chat-sidebar {
            width: 320px;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            background: #fafbfc;
        }

        .chat-sidebar-header {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .chat-search {
            position: relative;
        }

        .chat-search input {
            border-radius: 20px;
            padding-left: 36px;
            font-size: 13px;
        }

        .chat-search i {
            position: absolute;
            left: 12px;
            top: 10px;
            color: #94a3b8;
            font-size: 13px;
        }

        .chat-users-list {
            flex: 1;
            overflow-y: auto;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .chat-user-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none !important;
            color: inherit;
        }

        .chat-user-item:hover {
            background: #f1f5f9;
        }

        .chat-user-item.active {
            background: #e3f2fd;
            border-left: 4px solid #1976d2;
        }

        .chat-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #0d47a1;
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-right: 12px;
            flex-shrink: 0;
            position: relative;
        }

        .chat-user-info {
            flex: 1;
            min-width: 0;
        }

        .chat-user-name {
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-user-lastmsg {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Area Percakapan */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f8fafc;
        }

        .chat-main-header {
            padding: 14px 20px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Bubble Chat */
        .message-row {
            display: flex;
            margin-bottom: 8px;
        }

        .message-row.mine {
            justify-content: flex-end;
        }

        .message-row.theirs {
            justify-content: flex-start;
        }

        .message-bubble {
            max-width: 65%;
            padding: 10px 16px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.5;
            position: relative;
            word-wrap: break-word;
        }

        .message-row.mine .message-bubble {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: #ffffff;
            border-bottom-right-radius: 4px;
            box-shadow: 0 2px 8px rgba(13, 71, 161, 0.2);
        }

        .message-row.theirs .message-bubble {
            background: #ffffff;
            color: #1e293b;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .message-time {
            font-size: 10px;
            margin-top: 4px;
            display: block;
            text-align: right;
            opacity: 0.8;
        }

        .chat-footer {
            padding: 12px 18px;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        .chat-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-input-wrapper textarea {
            resize: none;
            border-radius: 20px;
            padding: 10px 16px;
            font-size: 14px;
            height: 44px;
        }

        .chat-btn-send {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d47a1;
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .chat-btn-send:hover {
            background: #1976d2;
            transform: scale(1.05);
        }

        .attachment-preview {
            max-width: 220px;
            border-radius: 8px;
            margin-bottom: 6px;
            display: block;
        }

        @media (max-width: 768px) {
            .chat-app {
                flex-direction: column;
                height: 700px;
            }
            .chat-sidebar {
                width: 100%;
                height: 180px;
            }
        }
    </style>

    <div class="chat-app">
        {{-- Sidebar Siswa --}}
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <div class="font-weight-bold text-dark mb-2">
                    <i class="fas fa-user-graduate text-primary mr-1"></i> Kontak Siswa ({{ count($siswaList) }})
                </div>
                <div class="chat-search">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchSiswa" class="form-control" placeholder="Cari siswa...">
                </div>
            </div>

            <ul class="chat-users-list" id="siswaListUl">
                @forelse($siswaList as $s)
                    @php
                        $unread = $unreadPerSiswa[$s->id] ?? 0;
                        $lastChat = $lastMessages[$s->id] ?? null;
                    @endphp
                    <li>
                        <a href="{{ route('pembimbing_lapangan.chat.index', $s->id) }}" 
                           class="chat-user-item {{ ($activeSiswa && $activeSiswa->id === $s->id) ? 'active' : '' }}" 
                           data-name="{{ strtolower($s->name) }}">
                            <div class="chat-avatar">
                                {{ strtoupper(substr($s->name, 0, 1)) }}
                            </div>
                            <div class="chat-user-info">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="chat-user-name">{{ $s->name }}</div>
                                    @if($unread > 0)
                                        <span class="badge badge-danger badge-pill">{{ $unread }}</span>
                                    @endif
                                </div>
                                <div class="chat-user-lastmsg">
                                    @if($lastChat)
                                        {{ $lastChat->sender_id === $mentor->id ? 'Anda: ' : '' }}{{ $lastChat->message ?: '[Lampiran file]' }}
                                    @else
                                        <span class="font-italic text-muted">Belum ada obrolan</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="p-4 text-center text-muted small">Belum ada siswa magang.</li>
                @endforelse
            </ul>
        </div>

        {{-- Area Chat Aktif --}}
        <div class="chat-main">
            @if($activeSiswa)
                {{-- Header Siswa Aktif --}}
                <div class="chat-main-header">
                    <div class="d-flex align-items-center">
                        <div class="chat-avatar mr-3" style="width: 40px; height: 40px; font-size: 15px;">
                            {{ strtoupper(substr($activeSiswa->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-weight-bold text-dark" style="font-size: 15px;">{{ $activeSiswa->name }}</div>
                            <small class="text-muted">
                                <i class="fas fa-school mr-1"></i> {{ $activeSiswa->pendaftaran->universitas ?? $activeSiswa->pendaftaran->asal_sekolah ?? '-' }} 
                                &bull; {{ $activeSiswa->pendaftaran->jurusan ?? '-' }}
                            </small>
                        </div>
                    </div>
                    <div>
                        @if($activeSiswa->no_telp)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $activeSiswa->no_telp)) }}" 
                               target="_blank" class="btn btn-sm btn-outline-success font-weight-bold mr-1">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        @endif
                        <a href="{{ route('pembimbing_lapangan.laporan.siswa', $activeSiswa->id) }}" class="btn btn-sm btn-outline-info" title="Laporan Siswa">
                            <i class="fas fa-book"></i> Laporan
                        </a>
                    </div>
                </div>

                {{-- Kontainer Pesan --}}
                <div class="chat-body" id="chatMessagesContainer">
                    @forelse($messages as $msg)
                        <div class="message-row {{ $msg->sender_id === $mentor->id ? 'mine' : 'theirs' }}">
                            <div class="message-bubble">
                                @if($msg->attachment)
                                    @php $ext = pathinfo($msg->attachment, PATHINFO_EXTENSION); @endphp
                                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                                        <a href="{{ asset('uploads/chat/' . $msg->attachment) }}" target="_blank">
                                            <img src="{{ asset('uploads/chat/' . $msg->attachment) }}" class="attachment-preview" alt="Lampiran">
                                        </a>
                                    @else
                                        <div class="mb-2">
                                            <a href="{{ asset('uploads/chat/' . $msg->attachment) }}" target="_blank" class="btn btn-sm btn-light text-dark">
                                                <i class="fas fa-file-download mr-1"></i> Unduh Lampiran
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if($msg->message)
                                    <div>{!! nl2br(e($msg->message)) !!}</div>
                                @endif
                                <span class="message-time">
                                    {{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}
                                    @if($msg->sender_id === $mentor->id)
                                        <i class="fas {{ $msg->is_read ? 'fa-check-double text-warning' : 'fa-check' }} ml-1"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted my-auto" id="emptyChatNotice">
                            <i class="fas fa-comments fa-3x mb-2 text-light d-block"></i>
                            <h6 class="font-weight-bold text-secondary">Mulai Percakapan</h6>
                            <p class="small text-muted mb-0">Kirim pesan pertama kepada <strong>{{ $activeSiswa->name }}</strong>.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Footer Input Pesan --}}
                <div class="chat-footer">
                    <form id="chatSendForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="receiver_id" id="receiverId" value="{{ $activeSiswa->id }}">
                        
                        <div id="fileSelectedBadge" class="mb-2 d-none">
                            <span class="badge badge-info p-2">
                                <i class="fas fa-paperclip mr-1"></i> <span id="fileNameDisplay">file</span>
                                <a href="javascript:void(0)" class="text-white ml-2" onclick="clearFile()">&times;</a>
                            </span>
                        </div>

                        <div class="chat-input-wrapper">
                            <label for="attachmentInput" class="btn btn-light mb-0" style="border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; cursor: pointer;" title="Lampirkan File">
                                <i class="fas fa-paperclip text-muted"></i>
                            </label>
                            <input type="file" id="attachmentInput" name="attachment" class="d-none" onchange="previewFile(this)">

                            <textarea name="message" id="chatMessageInput" class="form-control" placeholder="Tulis pesan bimbingan atau instruksi untuk siswa... (Tekan Enter untuk kirim)"></textarea>

                            <button type="submit" class="chat-btn-send" id="btnSend">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                    <i class="fas fa-comment-dots fa-4x text-light mb-3"></i>
                    <h5>Pilih Siswa untuk Memulai Chat</h5>
                    <p class="small">Klik salah satu siswa di daftar sebelah kiri untuk membuka ruang obrolan.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('scripts')
@if($activeSiswa)
<script>
    $(document).ready(function() {
        const container = document.getElementById('chatMessagesContainer');
        const activeSiswaId = {{ $activeSiswa->id }};
        const pollUrl = "{{ url('pembimbing-lapangan/chat-ajax/messages') }}/" + activeSiswaId;
        const sendUrl = "{{ route('pembimbing_lapangan.chat.send') }}";

        // Scroll ke bawah
        function scrollToBottom() {
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }
        scrollToBottom();

        // Cari Siswa di Sidebar
        $('#searchSiswa').on('keyup', function() {
            const val = $(this).val().toLowerCase();
            $('#siswaListUl li').each(function() {
                const name = $(this).find('.chat-user-item').data('name');
                if (name && name.indexOf(val) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Submit pesan via AJAX
        $('#chatSendForm').on('submit', function(e) {
            e.preventDefault();
            const message = $('#chatMessageInput').val().trim();
            const hasFile = $('#attachmentInput')[0].files.length > 0;

            if (!message && !hasFile) return;

            const formData = new FormData(this);
            $('#chatMessageInput').val('');
            clearFile();

            $.ajax({
                url: sendUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status === 'success') {
                        $('#emptyChatNotice').remove();
                        const chat = res.chat;
                        let attachHtml = '';
                        if (chat.attachment) {
                            attachHtml = `<div class="mb-2"><a href="${chat.attachment}" target="_blank" class="btn btn-sm btn-light"><i class="fas fa-file-download mr-1"></i> File Lampiran</a></div>`;
                        }

                        const bubble = `
                            <div class="message-row mine">
                                <div class="message-bubble">
                                    ${attachHtml}
                                    ${chat.message ? `<div>${chat.message.replace(/\n/g, '<br>')}</div>` : ''}
                                    <span class="message-time">
                                        ${chat.time} <i class="fas fa-check ml-1"></i>
                                    </span>
                                </div>
                            </div>
                        `;
                        $('#chatMessagesContainer').append(bubble);
                        scrollToBottom();
                    }
                },
                error: function(err) {
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                }
            });
        });

        // Kirim pakai tombol Enter (Shift+Enter untuk baris baru)
        $('#chatMessageInput').on('keydown', function(e) {
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                $('#chatSendForm').submit();
            }
        });

        // Polling pesan masuk secara real-time setiap 4 detik
        setInterval(function() {
            $.get(pollUrl, function(data) {
                if (data.status === 'success' && data.messages) {
                    // Update tampilan container dengan pesan terbaru
                    let html = '';
                    data.messages.forEach(function(msg) {
                        const rowClass = msg.is_mine ? 'mine' : 'theirs';
                        let attachHtml = '';
                        if (msg.attachment) {
                            const isImg = msg.attachment.match(/\.(jpeg|jpg|gif|png)$/) != null;
                            if (isImg) {
                                attachHtml = `<a href="${msg.attachment}" target="_blank"><img src="${msg.attachment}" class="attachment-preview" alt="Foto"></a>`;
                            } else {
                                attachHtml = `<div class="mb-2"><a href="${msg.attachment}" target="_blank" class="btn btn-sm btn-light text-dark"><i class="fas fa-file-download mr-1"></i> Unduh Lampiran</a></div>`;
                            }
                        }

                        html += `
                            <div class="message-row ${rowClass}">
                                <div class="message-bubble">
                                    ${attachHtml}
                                    ${msg.message ? `<div>${msg.message.replace(/\n/g, '<br>')}</div>` : ''}
                                    <span class="message-time">${msg.time}</span>
                                </div>
                            </div>
                        `;
                    });

                    // Hanya refresh jika jumlah pesan bertambah
                    const currentCount = $('#chatMessagesContainer .message-row').length;
                    if (data.messages.length > currentCount) {
                        $('#chatMessagesContainer').html(html);
                        scrollToBottom();
                    }
                }
            });
        }, 4000);
    });

    function previewFile(input) {
        if (input.files && input.files[0]) {
            $('#fileNameDisplay').text(input.files[0].name);
            $('#fileSelectedBadge').removeClass('d-none');
        }
    }

    function clearFile() {
        $('#attachmentInput').val('');
        $('#fileSelectedBadge').addClass('d-none');
    }
</script>
@endif
@endsection
