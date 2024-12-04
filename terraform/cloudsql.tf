resource "google_sql_database_instance" "db_instance" {
  name             = "library-db-indri"
  database_version = "MYSQL_5_7"
  region           = var.region

  settings {
    tier = "db-f1-micro"
    ip_configuration {
      authorized_networks {
        name  = "all"
        value = "0.0.0.0/0"
      }
    }
  }

  depends_on = [google_project_service.sqladmin]
}

resource "google_sql_database" "db" {
  name     = "crud-library"
  instance = google_sql_database_instance.db_instance.name
}

resource "google_sql_user" "users" {
  name     = var.db_username
  instance = google_sql_database_instance.db_instance.name
  password = var.db_password
}

resource "google_project_service" "sqladmin" {
  service = "sqladmin.googleapis.com"
}
