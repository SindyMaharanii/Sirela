<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Lembaga - SISOREL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #0f2b5c 0%, #1e3a8a 50%, #2563eb 100%);
            min-height: 100vh;
        }
        .register-card {
            background: white;
            border-radius: 2rem;
        }
        .type-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #e5e7eb;
        }
        .type-card.selected {
            border-color: #2563eb;
            background: #eff6ff;
            transform: scale(1.02);
        }
        .type-card:hover {
            border-color: #93c5fd;
            background: #f8fafc;
        }
        .form-step {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .step-circle {
            transition: all 0.3s ease;
        }
        .step-circle.done {
            background: #10b981;
            color: white;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        .step-circle.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }
        .step-circle.pending {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        input:focus, select:focus, textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
        .required { color: #ef4444; }
    </style>
</head>
<body class="py-10">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-2 text-white/80 hover:text-white mb-4 text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
            <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur rounded-2xl px-6 py-3">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                    <span class="text-blue-600 text-2xl font-bold">S</span>
                </div>
                <div class="text-left">
                    <h1 class="text-2xl font-bold text-white">SISOREL</h1>
                    <p class="text-white/80 text-sm">Sistem Informasi Sosial & Relawan</p>
                </div>
            </div>
        </div>

        <!-- Progress Step -->
        <div class="relative flex justify-between mb-8 px-4">
            <div class="absolute top-5 left-0 right-0 h-0.5 bg-white/30 -z-0 rounded-full"></div>
            <div class="flex-1 text-center relative z-10">
                <div class="step-circle step-1 w-10 h-10 rounded-full bg-white text-gray-600 font-bold flex items-center justify-center mx-auto mb-2 shadow-md">1</div>
                <div class="absolute top-5 left-1/2 w-full h-0.5 -z-10 step-line step-line-1 hidden" style="background: linear-gradient(90deg, #10b981, #3b82f6, #60a5fa);"></div>
                <p class="text-white text-xs font-medium mt-2">Pilih Jenis</p>
            </div>
            <div class="flex-1 text-center relative z-10">
                <div class="step-circle step-2 w-10 h-10 rounded-full bg-white/30 text-white font-bold flex items-center justify-center mx-auto mb-2 shadow-md">2</div>
                <div class="absolute top-5 left-1/2 w-full h-0.5 -z-10 step-line step-line-2 hidden"></div>
                <p class="text-white text-xs font-medium mt-2">Data Lembaga</p>
            </div>
            <div class="flex-1 text-center relative z-10">
                <div class="step-circle step-3 w-10 h-10 rounded-full bg-white/30 text-white font-bold flex items-center justify-center mx-auto mb-2 shadow-md">3</div>
                <div class="absolute top-5 left-1/2 w-full h-0.5 -z-10 step-line step-line-3 hidden"></div>
                <p class="text-white text-xs font-medium mt-2">Legalitas</p>
            </div>
            <div class="flex-1 text-center relative z-10">
                <div class="step-circle step-4 w-10 h-10 rounded-full bg-white/30 text-white font-bold flex items-center justify-center mx-auto mb-2 shadow-md">4</div>
                <p class="text-white text-xs font-medium mt-2">Akun Login</p>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
            <div class="flex items-start gap-2">
                <i class="fas fa-exclamation-circle mt-0.5"></i>
                <div>
                    <p class="font-semibold">Data tidak lengkap! Silakan lengkapi:</p>
                    <ul class="text-sm list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Form Card -->
        <div class="register-card shadow-2xl overflow-hidden">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                @csrf
                <div class="p-8">
                    <!-- STEP 1: PILIH JENIS LEMBAGA -->
                    <div id="step1" class="form-step">
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                                <i class="fas fa-building text-white text-2xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Pilih Jenis Lembaga</h2>
                            <p class="text-gray-500 text-sm">Pilih jenis lembaga sosial Anda</p>
                            <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full mx-auto mt-3"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="type-card rounded-xl p-5 text-center cursor-pointer" data-type="pemerintah">
                                <i class="fas fa-landmark text-4xl text-blue-500 mb-3"></i>
                                <h3 class="font-bold text-gray-800 text-lg">Lembaga Pemerintah</h3>
                                <p class="text-xs text-gray-500 mt-2">Dinas / Instansi / Badan Pemerintah</p>
                                <div class="mt-3 text-xs text-blue-600 font-medium">Kementerian, Dinas Sosial, dll</div>
                            </div>
                            <div class="type-card rounded-xl p-5 text-center cursor-pointer" data-type="swasta">
                                <i class="fas fa-building text-4xl text-green-500 mb-3"></i>
                                <h3 class="font-bold text-gray-800 text-lg">Lembaga Swasta</h3>
                                <p class="text-xs text-gray-500 mt-2">Yayasan / LSM / Perkumpulan</p>
                                <div class="mt-3 text-xs text-green-600 font-medium">Berbadan Hukum & Terdaftar</div>
                            </div>
                            <div class="type-card rounded-xl p-5 text-center cursor-pointer" data-type="komunitas">
                                <i class="fas fa-hand-holding-heart text-4xl text-purple-500 mb-3"></i>
                                <h3 class="font-bold text-gray-800 text-lg">Komunitas Sosial</h3>
                                <p class="text-xs text-gray-500 mt-2">Kelompok / Organisasi Masyarakat</p>
                                <div class="mt-3 text-xs text-purple-600 font-medium">Terdaftar di KEMENSOS</div>
                            </div>
                        </div>
                        <input type="hidden" name="jenis_lembaga" id="jenis_lembaga" required>
                    </div>

                    <!-- STEP 2: DATA LEMBAGA -->
                    <div id="step2" class="form-step hidden">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Data Lembaga</h2>
                            <p class="text-gray-500 text-sm">Semua field wajib diisi <span class="required">*</span></p>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap Lembaga <span class="required">*</span></label>
                                <input type="text" name="nama_lembaga" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="Contoh: Yayasan Bina Anak Bangsa">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Berdiri <span class="required">*</span></label>
                                    <input type="number" name="tahun_berdiri" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="Contoh: 2010">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bidang Kegiatan <span class="required">*</span></label>
                                    <select name="bidang" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400">
                                        <option value="">Pilih Bidang</option>
                                        <option value="Pendidikan">📚 Pendidikan</option>
                                        <option value="Kesehatan">🏥 Kesehatan</option>
                                        <option value="Anak & Remaja">👶 Anak & Remaja</option>
                                        <option value="Lanjut Usia">👴 Lanjut Usia</option>
                                        <option value="Disabilitas">♿ Disabilitas</option>
                                        <option value="Lingkungan">🌳 Lingkungan Hidup</option>
                                        <option value="Ekonomi">💼 Pemberdayaan Ekonomi</option>
                                        <option value="Bencana">🌊 Penanggulangan Bencana</option>
                                        <option value="Hukum">⚖️ Advokasi Hukum & HAM</option>
                                        <option value="Agama">🕌 Kegiatan Keagamaan</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap <span class="required">*</span></label>
                                <textarea name="alamat" rows="2" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan"></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi <span class="required">*</span></label>
                                    <input type="text" name="provinsi" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kota/Kabupaten <span class="required">*</span></label>
                                    <input type="text" name="kota" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos <span class="required">*</span></label>
                                    <input type="text" name="kode_pos" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon <span class="required">*</span></label>
                                    <input type="tel" name="telepon_lembaga" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="(021) 1234567 / 08123456789">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Lembaga <span class="required">*</span></label>
                                    <input type="email" name="email_lembaga" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="info@yayasananda.org">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Website (Opsional)</label>
                                <input type="url" name="website" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400">
                            </div>
                        </div>
                    </div>

                    <!-- STEP 3: LEGALITAS -->
                    <div id="step3" class="form-step hidden">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Data Legalitas</h2>
                            <p class="text-gray-500 text-sm">Dokumen legal dan bukti keabsahan lembaga (semua wajib diisi)</p>
                        </div>
                        
                        <!-- FORM PEMERINTAH -->
                        <div id="form-pemerintah" class="legal-form hidden space-y-4">
                            <div class="bg-blue-50 rounded-xl p-4 mb-4">
                                <div class="flex items-center gap-2 mb-3"><i class="fas fa-building text-blue-600"></i><h3 class="font-bold text-blue-800">Data Lembaga Pemerintah (WAJIB)</h3></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Kementerian/Instansi Induk <span class="required">*</span></label><input type="text" name="kementerian" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Eselon <span class="required">*</span></label><select name="eselon" class="w-full px-4 py-3 border border-gray-200 rounded-xl"><option value="">Pilih Eselon</option><option value="Eselon I">Eselon I</option><option value="Eselon II">Eselon II</option><option value="Eselon III">Eselon III</option><option value="Eselon IV">Eselon IV</option></select></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">NIP Pimpinan <span class="required">*</span></label><input type="text" name="nip_pimpinan" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Nomor SOTK <span class="required">*</span></label><input type="text" name="nomor_sotk" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Upload File SOTK <span class="required">*</span></label><input type="file" name="file_sotk" accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-xl"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FORM SWASTA -->
                        <div id="form-swasta" class="legal-form hidden space-y-4">
                            <div class="bg-green-50 rounded-xl p-4 mb-4">
                                <div class="flex items-center gap-2 mb-3"><i class="fas fa-handshake text-green-600"></i><h3 class="font-bold text-green-800">Data Lembaga Swasta (WAJIB)</h3></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Lembaga <span class="required">*</span></label><select name="tipe_swasta" class="w-full px-4 py-3 border border-gray-200 rounded-xl"><option value="">Pilih Tipe</option><option value="Yayasan">Yayasan</option><option value="Perkumpulan">Perkumpulan</option><option value="LSM">LSM</option></select></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Akta Pendirian <span class="required">*</span></label><input type="text" name="nomor_akta" class="w-full px-4 py-3 border border-gray-200 rounded-xl" placeholder="Contoh: 123/AKTA/2024"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">NPWP Lembaga <span class="required">*</span></label><input type="text" name="npwp_lembaga" class="w-full px-4 py-3 border border-gray-200 rounded-xl" placeholder="00.000.000.0-000.000"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pimpinan <span class="required">*</span></label><input type="text" name="nama_pimpinan" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">NIK Pimpinan <span class="required">*</span></label><input type="text" name="nik_pimpinan" maxlength="16" class="w-full px-4 py-3 border border-gray-200 rounded-xl" placeholder="16 digit NIK KTP"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Rekening Bank a.n. Lembaga <span class="required">*</span></label><input type="text" name="rekening_lembaga" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Upload Akta Pendirian <span class="required">*</span></label><input type="file" name="file_akta" accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-xl"></div>
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Upload NPWP Lembaga <span class="required">*</span></label><input type="file" name="file_npwp" accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-xl"></div>
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Upload KTP Pimpinan <span class="required">*</span></label><input type="file" name="file_ktp_pimpinan" accept=".jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-xl"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FORM KOMUNITAS -->
                        <div id="form-komunitas" class="legal-form hidden space-y-4">
                            <div class="bg-purple-50 rounded-xl p-4 mb-4">
                                <div class="flex items-center gap-2 mb-3"><i class="fas fa-users text-purple-600"></i><h3 class="font-bold text-purple-800">Data Komunitas Sosial (WAJIB)</h3></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Nomor SK KEMENSOS <span class="required">*</span></label><input type="text" name="nomor_sk" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal SK <span class="required">*</span></label><input type="date" name="tanggal_sk" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Nama Koordinator <span class="required">*</span></label><input type="text" name="nama_koordinator" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">NIK Koordinator <span class="required">*</span></label><input type="text" name="nik_koordinator" maxlength="16" class="w-full px-4 py-3 border border-gray-200 rounded-xl" placeholder="16 digit NIK KTP"></div>
                                    <div><label class="block text-sm font-semibold text-gray-700 mb-2">Rekening Komunitas <span class="required">*</span></label><input type="text" name="rekening_komunitas" class="w-full px-4 py-3 border border-gray-200 rounded-xl"></div>
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Upload SK KEMENSOS <span class="required">*</span></label><input type="file" name="file_sk" accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-xl"></div>
                                    <div class="md:col-span-2"><label class="block text-sm font-semibold text-gray-700 mb-2">Upload KTP Koordinator <span class="required">*</span></label><input type="file" name="file_ktp_koordinator" accept=".jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-xl"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: AKUN LOGIN -->
                    <div id="step4" class="form-step hidden">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Buat Akun Login</h2>
                            <p class="text-gray-500 text-sm">Data untuk mengakses dashboard SISOREL (semua wajib diisi)</p>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-amber-50 rounded-xl p-4 mb-4">
                                <div class="flex items-start gap-3"><i class="fas fa-shield-alt text-amber-600 text-xl mt-0.5"></i><div><p class="text-sm text-amber-800 font-semibold">Perhatian!</p><p class="text-xs text-amber-700">Akun Anda akan diverifikasi oleh admin terlebih dahulu sebelum dapat mengakses dashboard. Proses verifikasi membutuhkan waktu 1x24 jam.</p></div></div>
                            </div>
                            <div><label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengguna <span class="required">*</span></label><input type="text" name="name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400"></div>
                            <div><label class="block text-sm font-semibold text-gray-700 mb-2">Email Login <span class="required">*</span></label><input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400"></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div><label class="block text-sm font-semibold text-gray-700 mb-2">Password <span class="required">*</span></label><input type="password" name="password" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="Minimal 8 karakter"></div>
                                <div><label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password <span class="required">*</span></label><input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-blue-400" placeholder="Ulangi password"></div>
                            </div>
                            <div class="flex items-start gap-3 pt-4"><input type="checkbox" name="terms" id="terms" required class="mt-1"><label for="terms" class="text-sm text-gray-600">Saya menyatakan bahwa semua data yang saya isikan adalah BENAR dan sesuai dengan dokumen resmi. Apabila ditemukan data palsu, akun akan ditolak dan dilaporkan ke pihak berwenang. <span class="required">*</span></label></div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                        <button type="button" id="prevBtn" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition hidden">
                            <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                        </button>
                        <button type="button" id="nextBtn" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold transition shadow-md ml-auto">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        <button type="submit" id="submitBtn" class="px-8 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold transition shadow-md hidden">
                            <i class="fas fa-paper-plane mr-2"></i> Daftar Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <p class="text-center text-white/70 text-sm mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">Login disini</a>
        </p>
    </div>

    <script>
        let currentStep = 1;
        let selectedType = null;
        
        function updateSteps() {
            for (let i = 1; i <= 4; i++) document.getElementById(`step${i}`).classList.add('hidden');
            document.getElementById(`step${currentStep}`).classList.remove('hidden');
            for (let i = 1; i <= 4; i++) {
                const circle = document.querySelector(`.step-${i}`);
                const line = document.querySelector(`.step-line-${i}`);
                if (circle) {
                    circle.classList.remove('active', 'done', 'pending');
                    if (i < currentStep) {
                        circle.classList.add('done');
                        circle.innerHTML = '<i class="fas fa-check text-white text-xs"></i>';
                        if (line && i < 4) line.classList.remove('hidden');
                    } else if (i === currentStep) {
                        circle.classList.add('active');
                        circle.innerHTML = i;
                        if (line && i < 4) line.classList.remove('hidden');
                    } else {
                        circle.classList.add('pending');
                        circle.innerHTML = i;
                        if (line && i < 4) line.classList.add('hidden');
                    }
                }
            }
            const prev = document.getElementById('prevBtn'), next = document.getElementById('nextBtn'), submit = document.getElementById('submitBtn');
            if (currentStep === 1) { prev.classList.add('hidden'); next.classList.remove('hidden'); submit.classList.add('hidden'); }
            else if (currentStep === 4) { prev.classList.remove('hidden'); next.classList.add('hidden'); submit.classList.remove('hidden'); }
            else { prev.classList.remove('hidden'); next.classList.remove('hidden'); submit.classList.add('hidden'); }
        }
        
        function validateStep(step) {
            if (step === 1 && !selectedType) { alert('Silakan pilih jenis lembaga terlebih dahulu'); return false; }
            const stepDiv = document.getElementById(`step${step}`);
            const requiredFields = stepDiv.querySelectorAll('[required]');
            for (let field of requiredFields) { if (!field.value) { alert('Harap lengkapi semua field yang bertanda *'); field.focus(); return false; } }
            return true;
        }
        
        function showLegalForm(type) {
            document.getElementById('form-pemerintah').classList.add('hidden');
            document.getElementById('form-swasta').classList.add('hidden');
            document.getElementById('form-komunitas').classList.add('hidden');
            if (type === 'pemerintah') { document.getElementById('form-pemerintah').classList.remove('hidden'); }
            else if (type === 'swasta') { document.getElementById('form-swasta').classList.remove('hidden'); }
            else if (type === 'komunitas') { document.getElementById('form-komunitas').classList.remove('hidden'); }
        }
        
        document.querySelectorAll('.type-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.type-card').forEach(c => c.classList.remove('selected', 'border-blue-500', 'bg-blue-50'));
                this.classList.add('selected', 'border-blue-500', 'bg-blue-50');
                selectedType = this.getAttribute('data-type');
                document.getElementById('jenis_lembaga').value = selectedType;
            });
        });
        
        document.getElementById('nextBtn').addEventListener('click', function() {
            if (validateStep(currentStep)) {
                if (currentStep === 1 && selectedType) showLegalForm(selectedType);
                currentStep++;
                updateSteps();
            }
        });
        document.getElementById('prevBtn').addEventListener('click', function() { currentStep--; updateSteps(); });
        updateSteps();
    </script>
</body>
</html>