from locust import HttpUser, task, between
import random

# ==============================================
# TEST UNTUK HALAMAN PUBLIK + DONASI + LAPORAN
# SEMUA TASK BOBOT 5 (SAMA RATA)
# ==============================================

class SISORELUser(HttpUser):
    """
    Simulasi pengunjung website SISOREL + Donatur + Lembaga
    Semua test dijalankan dengan bobot yang sama (5)
    """
    
    # Waktu tunggu antar request (detik) - simulasi manusia membaca
    wait_time = between(1, 3)
    
    def on_start(self):
        """Persiapan awal untuk setiap user"""
        print("User memulai kunjungan...")
    
    # ==========================================
    # TEST 1: HALAMAN UTAMA (Home)
    # ==========================================
    @task(5)
    def home_page(self):
        response = self.client.get("/")
        
        if response.status_code != 200:
            response.failure(f"Gagal load halaman utama! Status: {response.status_code}")
        elif "SISOREL" not in response.text and "SIRELA" not in response.text:
            response.failure("Halaman utama tidak mengandung teks yang sesuai")
    
    # ==========================================
    # TEST 2: DETAIL LEMBAGA PUBLIK
    # ==========================================
    @task(5)
    def public_lembaga_detail(self):
        lembaga_id = random.randint(1, 20)
        response = self.client.get(f"/public/lembaga/{lembaga_id}", name="/public/lembaga/{id}")
        
        if response.status_code != 200:
            response.failure(f"Gagal load detail lembaga! Status: {response.status_code}")
    
    # ==========================================
    # TEST 3: PENCARIAN LEMBAGA
    # ==========================================
    @task(5)
    def search_filter(self):
        response = self.client.get("/?search=Yayasan")
        
        if response.status_code != 200:
            response.failure(f"Gagal melakukan pencarian! Status: {response.status_code}")
    
    # ==========================================
    # TEST 4: FILTER KATEGORI
    # ==========================================
    @task(5)
    def filter_kategori(self):
        response = self.client.get("/?kategori=Pendidikan")
        
        if response.status_code != 200:
            response.failure(f"Gagal filter kategori! Status: {response.status_code}")
    
    # ==========================================
    # TEST 5: HALAMAN TENTANG
    # ==========================================
    @task(5)
    def tentang_page(self):
        response = self.client.get("/tentang")
        
        if response.status_code != 200:
            response.failure(f"Gagal load halaman tentang! Status: {response.status_code}")
    
    # ==========================================
    # TEST 6: HALAMAN PANDUAN
    # ==========================================
    @task(5)
    def panduan_page(self):
        response = self.client.get("/panduan")
        
        if response.status_code != 200:
            response.failure(f"Gagal load halaman panduan! Status: {response.status_code}")
    
    # ==========================================
    # TEST 7: DONASI BARANG
    # ==========================================
    @task(5)
    def create_donation_barang(self):
        donation = {
            "informasi_id": "1",
            "lembaga_id": "1",
            "kebutuhan_id": f"kebutuhan_{random.randint(1,10)}",
            "kebutuhan_nama": f"Kebutuhan Test {random.randint(1,10)}",
            "kebutuhan_jenis": "barang",
            "nama_donatur": f"Donatur_Locust_{random.randint(1,999)}",
            "no_hp": f"081{random.randint(10000000, 99999999)}",
            "pesan": "Donasi dari test Locust",
            "jumlah_barang": str(random.randint(1, 50)),
            "satuan": random.choice(["kg", "liter", "paket", "unit"])
        }
        
        response = self.client.post("/donasi/store", data=donation, name="/donasi/store (barang)")
        
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal membuat donasi barang! Status: {response.status_code}")
    
    # ==========================================
    # TEST 8: DONASI UANG
    # ==========================================
    @task(5)
    def create_donation_uang(self):
        donation = {
            "informasi_id": "1",
            "lembaga_id": "1",
            "kebutuhan_id": f"kebutuhan_uang_{random.randint(1,5)}",
            "kebutuhan_nama": "Dana Donasi Uang",
            "kebutuhan_jenis": "uang",
            "nama_donatur": f"Donatur_Uang_{random.randint(1,999)}",
            "no_hp": f"082{random.randint(10000000, 99999999)}",
            "pesan": "Donasi uang test Locust",
            "nominal_uang": str(random.randint(50000, 5000000)),
            "nama_rekening": "Test Rekening",
            "nama_bank": "BCA"
        }
        
        response = self.client.post("/donasi/store", data=donation, name="/donasi/store (uang)")
        
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal membuat donasi uang! Status: {response.status_code}")
    
    # ==========================================
    # TEST 9: HALAMAN LAPORAN
    # ==========================================
    @task(5)
    def view_laporan(self):
        bulan = random.randint(1, 12)
        tahun = random.randint(2023, 2026)
        
        response = self.client.get(
            f"/laporan?bulan={bulan}&tahun={tahun}",
            name="/laporan?bulan={bulan}&tahun={tahun}"
        )
        
        # 302 = redirect ke login (normal karena butuh auth)
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal akses laporan! Status: {response.status_code}")
    
    # ==========================================
    # TEST 10: DOWNLOAD EXCEL LAPORAN
    # ==========================================
    @task(5)
    def download_excel_laporan(self):
        bulan = random.randint(1, 12)
        tahun = random.randint(2023, 2026)
        
        response = self.client.get(
            f"/laporan/download-excel?bulan={bulan}&tahun={tahun}",
            name="/laporan/download-excel"
        )
        
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal download Excel! Status: {response.status_code}")
    
    # ==========================================
    # TEST 11: DOWNLOAD PDF LAPORAN
    # ==========================================
    @task(5)
    def download_pdf_laporan(self):
        bulan = random.randint(1, 12)
        tahun = random.randint(2023, 2026)
        
        response = self.client.get(
            f"/laporan/download-pdf?bulan={bulan}&tahun={tahun}",
            name="/laporan/download-pdf"
        )
        
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal download PDF! Status: {response.status_code}")
    
    # ==========================================
    # TEST 12: HALAMAN INFORMASI DONASI
    # ==========================================
    @task(5)
    def informasi_donasi_page(self):
        response = self.client.get("/informasi")
        
        # 302 = redirect ke login (normal karena butuh auth lembaga)
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal akses informasi donasi! Status: {response.status_code}")
    
    # ==========================================
    # TEST 13: HALAMAN DAFTAR DONATUR
    # ==========================================
    @task(5)
    def donasi_list_page(self):
        response = self.client.get("/donasi")
        
        if response.status_code not in [200, 302]:
            response.failure(f"Gagal akses daftar donatur! Status: {response.status_code}")
    
    # ==========================================
    # TEST 14: STATUS KOLABORASI
    # ==========================================
    @task(5)
    def check_status_kolaborasi(self):
        lembaga_id = random.randint(1, 20)
        response = self.client.get(f"/public/lembaga/{lembaga_id}", name="/public/lembaga/{id} (status)")
        
        if response.status_code == 200:
            if "Dibuka" not in response.text and "Ditutup" not in response.text:
                response.failure("Status kolaborasi tidak ditemukan")
        else:
            response.failure(f"Gagal cek status kolaborasi! Status: {response.status_code}")
    
    # ==========================================
    # TEST 15: KEBUTUHAN DONASI (Tabel)
    # ==========================================
    @task(5)
    def check_kebutuhan_donasi(self):
        lembaga_id = random.randint(1, 20)
        response = self.client.get(f"/public/lembaga/{lembaga_id}", name="/public/lembaga/{id} (kebutuhan)")
        
        if response.status_code == 200:
            if "Donasi" not in response.text and "Kebutuhan" not in response.text:
                response.failure("Tabel kebutuhan donasi tidak ditemukan")
        else:
            response.failure(f"Gagal cek kebutuhan donasi! Status: {response.status_code}")
    
    # ==========================================
    # TEST 16: JUMLAH ANAK ASUH
    # ==========================================
    @task(5)
    def check_jumlah_anak_asuh(self):
        lembaga_id = random.randint(1, 20)
        response = self.client.get(f"/public/lembaga/{lembaga_id}", name="/public/lembaga/{id} (anak asuh)")
        
        if response.status_code == 200:
            if "Jumlah Anak Asuh" not in response.text:
                response.failure("Jumlah anak asuh tidak ditemukan")
        else:
            response.failure(f"Gagal cek jumlah anak asuh! Status: {response.status_code}")