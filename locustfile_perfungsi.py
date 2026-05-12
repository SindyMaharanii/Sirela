from locust import HttpUser, task, between

# ==============================================
# TEST 1: HALAMAN UTAMA (Home)
# ==============================================
class TestHomePage(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def home_page(self):
        response = self.client.get("/")
        if response.status_code == 200:
            print("✓ Home Page OK")
        else:
            print(f"✗ Home Page GAGAL: {response.status_code}")

# ==============================================
# TEST 2: DAFTAR LEMBAGA (PUBLIC)
# ==============================================
class TestDaftarLembaga(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def daftar_lembaga(self):
        response = self.client.get("/")
        if "SISOREL" in response.text:
            print("✓ Daftar Lembaga OK")
        else:
            print("✗ Daftar Lembaga GAGAL")

# ==============================================
# TEST 3: DETAIL LEMBAGA
# ==============================================
class TestDetailLembaga(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def detail_lembaga(self):
        response = self.client.get("/public/lembaga/1")
        if response.status_code == 200:
            print("✓ Detail Lembaga OK")
        else:
            print(f"✗ Detail Lembaga GAGAL: {response.status_code}")

# ==============================================
# TEST 4: PENCARIAN LEMBAGA
# ==============================================
class TestSearchLembaga(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def search(self):
        response = self.client.get("/?search=Yayasan")
        if response.status_code == 200:
            print("✓ Pencarian Lembaga OK")
        else:
            print("✗ Pencarian Lembaga GAGAL")

# ==============================================
# TEST 5: FILTER KATEGORI
# ==============================================
class TestFilterKategori(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def filter_kategori(self):
        response = self.client.get("/?kategori=Pendidikan")
        if response.status_code == 200:
            print("✓ Filter Kategori OK")
        else:
            print("✗ Filter Kategori GAGAL")

# ==============================================
# TEST 6: HALAMAN TENTANG
# ==============================================
class TestTentang(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def tentang(self):
        response = self.client.get("/tentang")
        if "SISOREL" in response.text:
            print("✓ Halaman Tentang OK")
        else:
            print("✗ Halaman Tentang GAGAL")

# ==============================================
# TEST 7: HALAMAN PANDUAN
# ==============================================
class TestPanduan(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def panduan(self):
        response = self.client.get("/panduan")
        if "Masyarakat" in response.text and "Lembaga" in response.text:
            print("✓ Halaman Panduan OK")
        else:
            print("✗ Halaman Panduan GAGAL")

# ==============================================
# TEST 8: INFORMASI DONASI (Role Lembaga)
# ==============================================
class TestInformasiDonasi(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def informasi_donasi(self):
        response = self.client.get("/informasi/1")
        # 302 = redirect ke login (normal karena belum login)
        if response.status_code == 302 or response.status_code == 200:
            print("✓ Informasi Donasi OK (redirect ke login)")
        else:
            print(f"✗ Informasi Donasi GAGAL: {response.status_code}")

# ==============================================
# TEST 9: STATUS KOLABORASI (Di detail lembaga)
# ==============================================
class TestStatusKolaborasi(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def status_kolaborasi(self):
        response = self.client.get("/public/lembaga/1")
        if "Dibuka" in response.text or "Ditutup" in response.text:
            print("✓ Status Kolaborasi OK")
        else:
            print("✗ Status Kolaborasi GAGAL")

# ==============================================
# TEST 10: JUMLAH ANAK ASUH
# ==============================================
class TestJumlahAnakAsuh(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def jumlah_anak_asuh(self):
        response = self.client.get("/public/lembaga/1")
        if "Jumlah Anak Asuh" in response.text:
            print("✓ Jumlah Anak Asuh OK")
        else:
            print("✗ Jumlah Anak Asuh GAGAL")

# ==============================================
# TEST 11: KEBUTUHAN DONASI (Tabel donasi)
# ==============================================
class TestKebutuhanDonasi(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def kebutuhan_donasi(self):
        response = self.client.get("/public/lembaga/1")
        if "Donasi" in response.text or "Kebutuhan" in response.text:
            print("✓ Kebutuhan Donasi OK")
        else:
            print("✗ Kebutuhan Donasi GAGAL")