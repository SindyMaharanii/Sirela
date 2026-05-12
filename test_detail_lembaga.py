from locust import HttpUser, task, between

class TestDetailLembaga(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def detail_lembaga(self):
        self.client.get("/public/lembaga/1")