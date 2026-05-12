from locust import HttpUser, task, between

class TestKebutuhanDonasi(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def kebutuhan_donasi(self):
        response = self.client.get("/public/lembaga/1")
        if "Donasi" not in response.text:
            response.failure("Kebutuhan donasi tidak ditemukan")