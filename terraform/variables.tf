variable "project" {
  description = "The Google Cloud project ID"
  type        = string
  default     = "psoyey"
}

variable "region" {
  description = "The Google Cloud region"
  default     = "asia-southeast1"
}

variable "db_username" {
  description = "The database password"
  default     = "groot"
}

variable "db_password" {
  description = "The database password"
  default     = "supersecretpassword"
}
