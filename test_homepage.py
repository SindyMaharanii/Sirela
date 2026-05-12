from locust import HttpUser, task, between

class TestHomePage(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def home_page(self):
        self.client.get("/")