from locust import HttpUser, task, between

class TestInformasiDonasi(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def informasi_donasi(self):
        self.client.get("/informasi/1")