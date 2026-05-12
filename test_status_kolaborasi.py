from locust import HttpUser, task, between

class TestStatusKolaborasi(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def status_kolaborasi(self):
        response = self.client.get("/public/lembaga/1")
        if "Dibuka" not in response.text and "Ditutup" not in response.text:
            response.failure("Status kolaborasi tidak ditemukan")