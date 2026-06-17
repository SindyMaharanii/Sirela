from locust import HttpUser, task, between

class LaporanTest(HttpUser):
    wait_time = between(1, 2)

    @task(5)
    def laporan(self):
        self.client.get("/laporan")

    @task(2)
    def excel(self):
        self.client.get("/laporan/download-excel")

    @task(2)
    def pdf(self):
        self.client.get("/laporan/download-pdf")