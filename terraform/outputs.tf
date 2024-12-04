output "cloudrun_service_url" {
  value = google_cloud_run_service.service.status[0].url
}

output "db_instance_connection_name" {
  value = google_sql_database_instance.db_instance.connection_name
}
