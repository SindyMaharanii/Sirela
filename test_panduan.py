from locust import HttpUser, task, between

class TestPanduan(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def panduan(self):
        self.client.get("/panduan")