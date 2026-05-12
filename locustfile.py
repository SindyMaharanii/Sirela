from locust import HttpUser, task, between

class SISORELUser(HttpUser):
    """
    Simulasi pengunjung website SISOREL
    """
    
    # Waktu tunggu antar request (detik) - simulasi manusia membaca
    wait_time = between(1, 3)
    
    # Fungsi yang dijalankan saat user mulai
    def on_start(self):
        """Persiapan awal untuk setiap user"""
        print("User memulai kunjungan...")
    
    @task(5)  # Bobot 5 = lebih sering dijalankan (5x lebih sering dari task lain)
    def home_page(self):
        """Test 1: Akses halaman utama (daftar lembaga)"""
        response = self.client.get("/")
        
        # Validasi: apakah halaman berhasil dimuat?
        if response.status_code != 200:
            response.failure(f"Gagal load halaman utama! Status: {response.status_code}")
        elif "SISOREL" not in response.text:
            response.failure("Halaman utama tidak mengandung teks 'SISOREL'")
    
    @task(3)
    def public_lembaga_detail(self):
        """Test 2: Akses halaman detail lembaga publik"""
        # Coba akses lembaga dengan ID 1 (salah satu lembaga)
        response = self.client.get("/public/lembaga/1")
        
        if response.status_code != 200:
            response.failure(f"Gagal load detail lembaga! Status: {response.status_code}")
    
    @task(2)
    def informasi_donasi(self):
        """Test 3: Akses halaman informasi donasi (role lembaga)"""
        # Ini akan redirect ke login jika belum login
        # Tujuan untuk test apakah server bisa handle request
        response = self.client.get("/informasi/1")
        
        if response.status_code == 302 or response.status_code == 401:
            # HTTP 302 redirect ke login = normal (karena belum login)
            # Ini dianggap OK
            pass
        elif response.status_code != 200:
            response.failure(f"Error akses halaman donasi: {response.status_code}")
    
    @task(4)
    def search_filter(self):
        """Test 4: Test fitur pencarian dan filter"""
        # Simulasi search dengan parameter
        response = self.client.get("/?search=Yayasan")
        
        if response.status_code != 200:
            response.failure(f"Gagal melakukan pencarian! Status: {response.status_code}")
    
    @task(1)
    def tentang_page(self):
        """Test 5: Akses halaman tentang"""
        response = self.client.get("/tentang")
        
        if response.status_code != 200:
            response.failure(f"Gagal load halaman tentang! Status: {response.status_code}")
    
    @task(1)
    def panduan_page(self):
        """Test 6: Akses halaman panduan"""
        response = self.client.get("/panduan")
        
        if response.status_code != 200:
            response.failure(f"Gagal load halaman panduan! Status: {response.status_code}")