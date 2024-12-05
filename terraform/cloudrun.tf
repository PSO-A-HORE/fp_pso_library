resource "google_cloud_run_service" "service" {
  name     = "library"
  location = var.region

  template {
    spec {
      containers {
        image = "asia-southeast2-docker.pkg.dev/${var.project}/library/library:latest"
        ports {
          container_port = 80
        }
      }
    }
  }

  traffic {
    percent         = 100
    latest_revision = true
  }

  depends_on = [google_project_service.run]
}

resource "google_project_service" "run" {
  service = "run.googleapis.com"
}

resource "google_cloud_run_service_iam_member" "noauth" {
  service  = google_cloud_run_service.service.name
  location = google_cloud_run_service.service.location
  role     = "roles/run.invoker"
  member   = "allUsers"
}