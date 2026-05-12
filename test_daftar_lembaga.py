from locust import HttpUser, task, between

class TestDaftarLembaga(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def daftar_lembaga(self):
        self.client.get("/")