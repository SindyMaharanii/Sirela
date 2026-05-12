from locust import HttpUser, task, between

class TestSearch(HttpUser):
    wait_time = between(1, 2)
    
    @task
    def search(self):
        self.client.get("/?search=Yayasan")