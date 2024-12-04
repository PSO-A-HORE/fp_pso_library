resource "google_secret_manager_secret" "env_secret" {
  secret_id = "env-secret-mawar"
  replication {
    automatic = true
  }
}

resource "google_secret_manager_secret_version" "env_secret_version" {
  secret = google_secret_manager_secret.env_secret.id
  secret_data = filebase64("${path.module}/../.env")
}
