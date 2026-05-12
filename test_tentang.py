from locust import HttpUser, task, between

class TestTentang(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def tentang(self):
        self.client.get("/tentang")