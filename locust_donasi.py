from locust import HttpUser, task, between
import random

class DonasiTest(HttpUser):
    wait_time = between(1, 2)

    @task
    def donation_barang(self):
        donation = {
            "informasi_id": "0",
            "lembaga_id": "1",
            "kebutuhan_id": f"kebutuhan_{random.randint(1,10)}",
            "kebutuhan_nama": f"Kebutuhan Test {random.randint(1,10)}",
            "kebutuhan_jenis": "barang",
            "nama_donatur": f"Donatur_Locust_{random.randint(1,999)}",
            "no_hp": f"081{random.randint(10000000, 99999999)}",
            "pesan": "Donasi dari test Locust",
            "jumlah_barang": str(random.randint(1,50)),
            "satuan": "kg"
        }

        self.client.post("/donasi/store", data=donation)