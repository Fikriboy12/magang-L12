@extends('template.master')

@section('title', 'Chat Pembimbing Lapangan')

@section('contents')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">
            <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
                {{-- Header Card --}}
                <div class="card-header text-white p-3 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white text-primary font-weight-bold mr-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px; font-size: 18px;">
                            {{ $mentor ? strtoupper(substr($mentor->name, 0, 1)) : 'M' }}
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $mentor ? $mentor->name : 'Pembimbing Lapangan' }}</h5>
                            <small class="text-white-50"><i class="fas fa-building mr-1"></i> PT. Media Balai Nusa &bull; Pembimbing Industri</small>
                        </div>
                    </div>
                    @if($mentor && $mentor->no_telp)
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $mentor->no_telp)) }}" target="_blank" class="btn btn-sm btn-success font-weight-bold shadow-sm">
                            <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                        </a>
                    @endif
                </div>

                @if(!$mentor)
                    <div class="card-body text-center py-5 text-muted">
                        <i class="fas fa-user-clock fa-3x mb-3 text-secondary"></i>
                        <h5>Belum Ada Pembimbing Lapangan Ditugaskan</h5>
                        <p class="small">Admin sedang mengatur akun Pembimbing Lapangan untuk Anda. Silakan hubungi admin magang.</p>
                    </div>
                @else
                    {{-- Container Pesan --}}
                    <div class="card-body p-4 bg-light" id="siswaChatContainer" style="height: 460px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px;">
                        @forelse($messages as $msg)
                            <div class="d-flex {{ $msg->sender_id === $siswa->id ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-3 shadow-sm" style="max-width: 75%; border-radius: 14px; word-wrap: break-word; {{ $msg->sender_id === $siswa->id ? 'background: #0d47a1; color: white; border-bottom-right-radius: 2px;' : 'background: white; color: #1e293b; border-bottom-left-radius: 2px;' }}">
                                    @if($msg->attachment)
                                        <div class="mb-2">
                                            <a href="{{ asset('uploads/chat/' . $msg->attachment) }}" target="_blank" class="btn btn-sm {{ $msg->sender_id === $siswa->id ? 'btn-light' : 'btn-primary' }}">
                                                <i class="fas fa-file-download mr-1"></i> Lihat Lampiran
                                            </a>
                                        </div>
                                    @endif
                                    @if($msg->message)
                                        <div style="font-size: 14px; line-height: 1.5;">{!! nl2br(e($msg->message)) !!}</div>
                                    @endif
                                    <small class="d-block text-right mt-1" style="font-size: 10px; opacity: 0.85;">
                                        {{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}
                                        @if($msg->sender_id === $siswa->id)
                                            <i class="fas {{ $msg->is_read ? 'fa-check-double text-warning' : 'fa-check' }} ml-1"></i>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center my-auto text-muted" id="noticeEmpty">
                                <i class="fas fa-comments fa-3x mb-2 text-secondary d-block"></i>
                                <h6 class="font-weight-bold">Ruang Obrolan dengan Mentor Lapangan</h6>
                                <p class="small text-muted">Kirimkan pertanyaan, laporan progres, atau konsultasi tugas magang Anda di sini.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Form Kirim --}}
                    <div class="card-footer bg-white p-3 border-top">
                        <form id="siswaChatForm" enctype="multipart/form-data">
                            @csrf
                            <div id="fileNotice" class="mb-2 d-none">
                                <span class="badge badge-info p-2">
                                    <i class="fas fa-paperclip mr-1"></i> <span id="fileNoticeName"></span>
                                    <a href="javascript:void(0)" class="text-white ml-2" onclick="hapusFile()">&times;</a>
                                </span>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="siswaAttachment" class="btn btn-light mb-0 border d-flex align-items-center" title="Unggah Lampiran" style="cursor: pointer;">
                                        <i class="fas fa-paperclip text-muted"></i>
                                    </label>
                                    <input type="file" id="siswaAttachment" name="attachment" class="d-none" onchange="filePilih(this)">
                                </div>
                                <input type="text" name="message" id="inputPesanSiswa" class="form-control" placeholder="Tulis pesan untuk mentor lapangan...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary font-weight-bold px-4">
                                        <i class="fas fa-paper-plane mr-1"></i> Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($mentor)
<script>
    const container = document.getElementById('siswaChatContainer');
    function scrollBawah() {
        if (container) container.scrollTop = container.scrollHeight;
    }
    scrollBawah();

    function filePilih(inp) {
        if (inp.files && inp.files[0]) {
            document.getElementById('fileNoticeName').textContent = inp.files[0].name;
            document.getElementById('fileNotice').classList.remove('d-none');
        }
    }
    function hapusFile() {
        document.getElementById('siswaAttachment').value = '';
        document.getElementById('fileNotice').classList.add('d-none');
    }

    document.getElementById('siswaChatForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const msg = document.getElementById('inputPesanSiswa').value.trim();
        const hasF = document.getElementById('siswaAttachment').files.length > 0;
        if (!msg && !hasF) return;

        const formData = new FormData(this);
        document.getElementById('inputPesanSiswa').value = '';
        hapusFile();

        fetch("{{ route('siswa.chat.send') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const emptyNotice = document.getElementById('noticeEmpty');
                if (emptyNotice) emptyNotice.remove();

                const c = data.chat;
                const row = document.createElement('div');
                row.className = 'd-flex justify-content-end';
                let attachHtml = c.attachment ? `<div class="mb-2"><a href="${c.attachment}" target="_blank" class="btn btn-sm btn-light"><i class="fas fa-file-download mr-1"></i> Lihat Lampiran</a></div>` : '';
                row.innerHTML = `
                    <div class="p-3 shadow-sm text-white" style="max-width: 75%; border-radius: 14px; border-bottom-right-radius: 2px; background: #0d47a1; word-wrap: break-word;">
                        ${attachHtml}
                        <div style="font-size: 14px; line-height: 1.5;">${c.message}</div>
                        <small class="d-block text-right mt-1 text-white-50" style="font-size: 10px;">${c.time} <i class="fas fa-check ml-1"></i></small>
                    </div>
                `;
                container.appendChild(row);
                scrollBawah();
            }
        });
    });

    // Polling setiap 4 detik
    setInterval(function() {
        fetch("{{ route('siswa.chat.messages') }}")
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && data.messages) {
                let html = '';
                data.messages.forEach(function(m) {
                    const isMine = m.is_mine;
                    const justify = isMine ? 'justify-content-end' : 'justify-content-start';
                    const bg = isMine ? 'background: #0d47a1; color: white; border-bottom-right-radius: 2px;' : 'background: white; color: #1e293b; border-bottom-left-radius: 2px;';
                    let attach = m.attachment ? `<div class="mb-2"><a href="${m.attachment}" target="_blank" class="btn btn-sm ${isMine ? 'btn-light' : 'btn-primary'}"><i class="fas fa-file-download mr-1"></i> Unduh Lampiran</a></div>` : '';
                    html += `
                        <div class="d-flex ${justify}">
                            <div class="p-3 shadow-sm" style="max-width: 75%; border-radius: 14px; word-wrap: break-word; ${bg}">
                                ${attach}
                                ${m.message ? `<div style="font-size: 14px; line-height: 1.5;">${m.message}</div>` : ''}
                                <small class="d-block text-right mt-1" style="font-size: 10px; opacity: 0.85;">${m.time}</small>
                            </div>
                        </div>
                    `;
                });

                if (data.messages.length > container.querySelectorAll('.d-flex').length) {
                    container.innerHTML = html;
                    scrollBawah();
                }
            }
        });
    }, 4000);
</script>
@endif
@endsection
