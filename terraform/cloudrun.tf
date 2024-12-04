resource "google_cloud_run_service" "service" {
  name     = "library-nida"
  location = var.region

  template {
    spec {
      containers {
        image = "asia-southeast2-docker.pkg.dev/${var.project}/library/library:library@sha256:471dbafe1f91f88fb9bb35a4be2a134469b1ce555c7c5ff53086f630b5951d80"
        ports {
            container_port = 80
        }
      }
    }
  }

  traffic {
    percent = 100
    latest_revision = true
    }

  depends_on = [google_project_service.run]
}

resource "google_project_service" "run" {
  service = "run.googleapis.com"
}

resource "google_cloud_run_service_iam_member" "noauth" {
     service = google_cloud_run_service.service.name
     location = google_cloud_run_service.service.location
     role = "roles/run.invoker"
     member = "allUsers"
     }
