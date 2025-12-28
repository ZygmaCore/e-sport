variable "project_id" {
  type        = string
  description = "GCP Project ID"
}

variable "region" {
  type    = string
  default = "asia-southeast2"
}

variable "zone" {
  type    = string
  default = "asia-southeast2-a"
}

variable "machine_type" {
  type    = string
  default = "e2-micro"
}

variable "ssh_user" {
  type = string
}
