from locust import HttpUser, task, between

class TestJumlahAnakAsuh(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def jumlah_anak_asuh(self):
        response = self.client.get("/public/lembaga/1")
        if "Jumlah Anak Asuh" not in response.text:
            response.failure("Jumlah anak asuh tidak ditemukan")