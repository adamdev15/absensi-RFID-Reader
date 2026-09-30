<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kiosk - {{ $station->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Courier+New&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-bg {
            background-color: #0F5132;
            /* Menggunakan gambar masjid sbg ilustrasi banner, dilapisi gradient hijau transparan */
            background-image: linear-gradient(to bottom, rgba(15,81,50,0.95) 0%, rgba(15,81,50,0.4) 50%, rgba(15,81,50,0.95) 100%), url('{{ asset('images/bg_banner.png') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased overflow-hidden text-slate-800 bg-slate-50 h-screen w-screen flex">
    
    <!-- Sidebar Kiri (30%) -->
    <div class="w-[30%] sidebar-bg flex flex-col items-center justify-between py-12 relative shadow-2xl z-10 text-center border-r border-slate-200">
        <div class="flex flex-col items-center mt-10">
            <img src="{{ asset('images/logo.png') }}" alt="Logo NU" class="w-40 h-40 object-contain mb-8 filter drop-shadow-lg">
            <h1 class="text-white text-5xl font-extrabold tracking-tight mb-2">PCNU</h1>
            <h2 class="text-white text-2xl font-bold tracking-wide mb-4">KAB. TEGAL</h2>
            <p class="text-emerald-200 text-sm font-medium tracking-wider">KHIDMAT - JAM'IYAH -<br>UNTUK UMAT</p>
        </div>
        
        <div class="mb-10 text-white text-base italic opacity-90 font-light">
            "Merawat Tradisi<br>Menjaga Negeri<br>Menuju Peradaban Mulia"
        </div>
    </div>

    <!-- Konten Utama (70%) -->
    <div class="w-[70%] bg-slate-50 flex flex-col relative h-full">
        <!-- Header -->
        <div class="flex justify-between items-center px-8 py-6 pb-2 border-b-0 border-slate-200 bg-transparent shrink-0">
            <div class="flex items-center gap-3">
                <div class="bg-primary-100 text-primary-700 p-3 rounded-full shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-0.5">Kiosk Station Aktif</div>
                    <div class="text-xl font-bold text-slate-800">
                        {{ $station->name }} 
                        <span class="text-sm font-medium {{ $station->type->value == 'IN' ? 'bg-blue-100 text-blue-700' : ($station->type->value == 'OUT' ? 'bg-orange-100 text-orange-700' : 'bg-purple-100 text-purple-700') }} px-2 py-0.5 rounded-full ml-2">
                            {{ $station->type->label() }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="bg-primary-50 border border-primary-100 text-primary-800 rounded-full px-5 py-2.5 flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span id="clock" class="font-semibold text-lg tracking-wide"></span>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-grow flex p-8 gap-6 pt-4 min-h-0">
            <!-- Left Area (Kamera & Input) -->
            <div class="w-3/5 flex flex-col">
                <!-- Info Label Box -->
                <div id="info_box" class="bg-transparent rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 border border-transparent transition-colors duration-300">
                    <div id="info_lbl" class="text-slate-500 text-lg font-medium text-center whitespace-pre-wrap">Silakan tap kartu RFID atau presensi wajah</div>
                </div>

                <!-- Kamera Box -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 flex flex-col flex-grow overflow-hidden relative">
                    
                    <div class="flex-grow bg-slate-800 m-4 rounded-xl flex items-center justify-center relative overflow-hidden shadow-inner group">
                        <video id="webcam" autoplay playsinline class="w-full h-full object-cover hidden scale-x-[-1]"></video>
                        <div id="webcam-overlay" class="absolute inset-0 border-2 border-dashed border-slate-600/50 rounded-xl m-2 pointer-events-none transition-all"></div>
                        
                    </div>
                    
                </div>
            </div>

            <!-- Right Area (Status & Tombol) -->
            <div class="w-2/5 flex flex-col gap-6">
                <!-- Status Perangkat -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 flex-grow p-6 flex flex-col relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-slate-50 rounded-full opacity-50"></div>
                    
                    <div class="flex items-center mb-6 relative z-10">
                        <span class="text-xl mr-2">⚙</span>
                        <h3 class="font-bold text-slate-800 text-lg tracking-wide">STATUS PERANGKAT</h3>
                    </div>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="flex items-center text-green-600 font-medium bg-green-50/50 p-2 rounded-lg">
                            <span class="mr-3 text-lg">🟢</span> <span id="status-cam-list">Kamera: Terhubung</span>
                        </div>
                        <div class="flex items-center text-green-600 font-medium bg-green-50/50 p-2 rounded-lg">
                            <span class="mr-3 text-lg">🟢</span> <span>Pembaca RFID: Terhubung (Web)</span>
                        </div>
                        <div class="flex items-center text-green-600 font-medium bg-green-50/50 p-2 rounded-lg">
                            <span class="mr-3 text-lg">🟢</span> <span>Koneksi Database: Online</span>
                        </div>
                        <div class="flex items-center text-green-600 font-medium bg-green-50/50 p-2 rounded-lg">
                            <span class="mr-3 text-lg">🟢</span> <span>Internet: Terhubung</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button id="btn-rfid-demo" class="flex-1 bg-primary-700 hover:bg-primary-800 text-white rounded-3xl p-4 flex flex-col items-center justify-center transition-all shadow-md hover:shadow-lg transform hover:-translate-y-1 group">
                        <div class="bg-white/20 p-3 rounded-full mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <span class="font-bold text-lg leading-tight text-center">Simulasi<br>Tap RFID</span>
                    </button>
                    
                    <button class="flex-1 bg-slate-100 border-2 border-slate-200 hover:border-slate-300 text-primary-800 rounded-3xl p-4 flex flex-col items-center justify-center transition-all shadow-sm hover:shadow-md transform hover:-translate-y-1 group">
                        <div class="bg-primary-50 p-3 rounded-full mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-bold text-lg leading-tight text-center">Lakukan<br>Presensi Wajah</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Input for RFID (To mimic physical scanner if needed) -->
    <input type="text" id="dummy_entry" class="opacity-0 absolute -top-10 left-0" autocomplete="off" autofocus>

    <script>
        // --- 1. CLOCK LOGIC ---
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[now.getDay()];
            const day = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            
            // Format time HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('clock').innerHTML = `${dayName}, ${day} ${month} ${year} &nbsp;|&nbsp; <span class="font-bold text-primary-700">${hours}:${minutes}:${seconds}</span>`;
        }
        
        setInterval(updateClock, 1000);
        updateClock();

        // --- 2. WEBCAM LOGIC ---
        const videoElement = document.getElementById('webcam');
        const webcamStatus = document.getElementById('webcam-status');
        const camIndicator = document.getElementById('cam-indicator');
        const camDot = document.getElementById('cam-dot');
        const camText = document.getElementById('cam-text');
        const statusCamList = document.getElementById('status-cam-list');
        const overlay = document.getElementById('webcam-overlay');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    // Success
                    if (videoElement) {
                        videoElement.srcObject = stream;
                        videoElement.classList.remove('hidden');
                    }
                    if (webcamStatus) webcamStatus.classList.add('hidden');
                    
                    // Update Indicators to Green (Active)
                    if (camIndicator) camIndicator.className = 'bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-sm font-medium flex items-center shadow-sm';
                    if (camDot) camDot.className = 'w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse';
                    if (camText) camText.textContent = 'Kamera siap digunakan';
                    if (statusCamList) statusCamList.textContent = 'Kamera: Online';
                    if (overlay) overlay.className = 'absolute inset-0 border-2 border-green-500/30 rounded-xl m-2 pointer-events-none transition-all';
                })
                .catch(function(err) {
                    // Error
                    if (webcamStatus) webcamStatus.innerHTML = `<span class="text-red-400">Gagal mengakses kamera: ${err.message}</span>`;
                    
                    // Update Indicators to Red (Error)
                    if (camIndicator) camIndicator.className = 'bg-red-100 text-red-700 px-4 py-1.5 rounded-full text-sm font-medium flex items-center shadow-sm';
                    if (camDot) camDot.className = 'w-2 h-2 rounded-full bg-red-500 mr-2';
                    if (camText) camText.textContent = 'Kamera Tidak Tersedia';
                    if (statusCamList) {
                        statusCamList.textContent = 'Kamera: Offline (Ditolak/Tidak Ditemukan)';
                        statusCamList.parentElement.className = 'flex items-center text-red-600 font-medium bg-red-50/50 p-2 rounded-lg';
                    }
                });
        } else {
            if (webcamStatus) webcamStatus.innerHTML = `<span class="text-red-400">Browser tidak mendukung akses kamera</span>`;
        }

        // --- 3. UI INTERACTIONS & API ---
        const dummyInput = document.getElementById('dummy_entry');
        const infoLbl = document.getElementById('info_lbl');
        const infoBox = document.getElementById('info_box');
        
        // Keep focus on input
        document.addEventListener('click', () => {
            dummyInput.focus();
        });
        
        // Get token
        const apiToken = '{{ $station->tokens->first()->plain_token ?? '' }}';
        let isProcessing = false;

        // --- 4. TTS (Text to Speech) ---
        function speak(text) {
            if ('speechSynthesis' in window) {
                // Cancel any ongoing speech
                window.speechSynthesis.cancel();
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'id-ID'; // Indonesian voice
                utterance.rate = 1.0;
                window.speechSynthesis.speak(utterance);
            }
        }

        function takeSnapshot() {
            if (!videoElement.srcObject) return null;
            const canvas = document.createElement('canvas');
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            const ctx = canvas.getContext('2d');
            
            // Mirror image horizontally to match mirrored video
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            
            ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
            // Return base64 jpeg
            return canvas.toDataURL('image/jpeg', 0.7);
        }

        async function submitAttendance(uid, photoBase64) {
            try {
                // format Y-m-d H:i:s
                const now = new Date();
                const y = now.getFullYear();
                const m = String(now.getMonth() + 1).padStart(2, '0');
                const d = String(now.getDate()).padStart(2, '0');
                const h = String(now.getHours()).padStart(2, '0');
                const min = String(now.getMinutes()).padStart(2, '0');
                const s = String(now.getSeconds()).padStart(2, '0');
                const ts = `${y}-${m}-${d} ${h}:${min}:${s}`;

                const response = await fetch('/api/station/attendance', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${apiToken}`
                    },
                    body: JSON.stringify({
                        records: [{
                            uid: uid,
                            timestamp: ts,
                            type: '{{ $station->type->value }}',
                            photo: photoBase64
                        }]
                    })
                });
                if (!response.ok) {
                    const text = await response.text();
                    console.error('Failed to submit attendance', text);
                }
            } catch (e) {
                console.error('Network Error submitting attendance', e);
            }
        }

        async function processRfid(uid) {
            if (isProcessing) return;
            if (!apiToken) {
                infoBox.className = 'bg-red-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
                infoLbl.innerHTML = `<span class="text-red-700 text-lg font-bold text-center">Error: API Token Station tidak ditemukan!<br>Pastikan station memiliki token.</span>`;
                setTimeout(resetUI, 3000);
                return;
            }
            
            isProcessing = true;
            infoLbl.innerHTML = '<span class="text-slate-500 text-lg font-medium text-center">Memeriksa...</span>';
            infoBox.className = 'bg-slate-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
            
            const photoBase64 = takeSnapshot();
            
            try {
                const response = await fetch('/api/station/check-rfid', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${apiToken}`
                    },
                    body: JSON.stringify({ uid: uid })
                });
                
                if (!response.ok) {
                    const errText = await response.text();
                    throw new Error(`HTTP ${response.status}: ${errText.substring(0, 50)}...`);
                }

                const result = await response.json();
                const status = result.status;
                const name = result.data?.name || 'Peserta';
                
                // Truncate name
                const nameFmt = name.length > 20 ? name.substring(0, 17) + '...' : name.padEnd(20, ' ');
                const uidFmt = uid.padEnd(10, ' ');
                const stationFmt = '{{ $station->type->value }}'.padEnd(20, ' ');
                const timeStr = new Date().toLocaleTimeString('id-ID');

                if (status === 'SUCCESS' || status === 'valid') {
                    infoBox.className = 'bg-green-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
                    infoLbl.innerHTML = `<div class="font-['Courier_New'] font-bold text-green-700 text-left w-full max-w-md mx-auto text-[13px] leading-relaxed whitespace-pre">✓   ABSENSI VALID\n\nNama       : ${nameFmt} RFID       : ${uidFmt}\nStation    : ${stationFmt} Waktu      : ${timeStr}\nStatus     : DITERIMA\n\nAbsensi Diterima Silahkan Masuk</div>`;
                    speak("Absensi Diterima, Silahkan Masuk");
                    // Fire and forget attendance submission
                    submitAttendance(uid, photoBase64);
                } 
                else if (status === 'DUPLICATE') {
                    infoBox.className = 'bg-amber-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
                    infoLbl.innerHTML = `<div class="font-['Courier_New'] font-bold text-amber-700 text-left w-full max-w-md mx-auto text-[13px] leading-relaxed whitespace-pre">⚠  ABSENSI TIDAK VALID\n\nNama       : ${nameFmt} RFID       : ${uidFmt}\nStation    : ${stationFmt} Waktu      : ${timeStr}\nStatus     : TIDAK VALID\n\nAnda telah absensi tercatat sebelumnya, Data Duplikat Absen</div>`;
                    speak("Data Duplikat Absen");
                }
                else if (status === 'unassigned') {
                    infoBox.className = 'bg-red-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
                    infoLbl.innerHTML = `<span class="text-red-700 text-lg font-bold text-center">Kartu belum dihubungkan ke peserta</span>`;
                    speak("Kartu belum dihubungkan ke peserta");
                }
                else {
                    infoBox.className = 'bg-red-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
                    infoLbl.innerHTML = `<span class="text-red-700 text-lg font-bold text-center">Kartu tidak terdaftar</span>`;
                    speak("Kartu tidak terdaftar");
                }
            } catch (error) {
                infoBox.className = 'bg-red-100 rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 transition-colors duration-300';
                infoLbl.innerHTML = `<span class="text-red-700 text-sm font-bold text-center">Error: ${error.message}</span>`;
            }

            setTimeout(resetUI, 3000);
        }

        function resetUI() {
            infoBox.className = 'bg-transparent rounded-2xl mb-4 py-4 px-6 flex justify-center items-center h-48 border border-transparent transition-colors duration-300';
            infoLbl.innerHTML = '<span class="text-slate-500 text-lg font-medium text-center">Silakan tap kartu RFID atau presensi wajah</span>';
            dummyInput.value = '';
            dummyInput.focus();
            isProcessing = false;
        }

        // Listener for RFID scanner (keyboard emulation)
        dummyInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const uid = this.value.trim();
                if (uid) {
                    processRfid(uid);
                }
            }
        });

        // Demo button simulates scanning '04A1B2C3'
        document.getElementById('btn-rfid-demo').addEventListener('click', () => {
            processRfid('2903940169'); // UID contoh dari user request
        });
    </script>
</body>
</html>
