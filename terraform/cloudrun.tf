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
    metadata {
        annotations = {
          "run.googleapis.com/cloudsql-instances" = google_sql_database_instance.db_instance.connection_name
          "run.googleapis.com/client-name"        = "library_db"
        }
     }
  }
  autogenerate_revision_name = true
  
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