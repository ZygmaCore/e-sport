provider "google" {
    project = var.project_id
    region  = var.region
    zone    = var.zone
}

resource "google_compute_firewall" "allow_app" {
    name    = "allow-app"
    network = "default"

    allow {
        protocol = "tcp"
        ports    = ["80", "8000"]
    }

    source_ranges = ["0.0.0.0/0"]
}

resource "google_compute_instance" "app_vm" {
    name         = "mentor-demo-vm"
    machine_type = var.machine_type

    boot_disk {
        initialize_params {
            image = "ubuntu-os-cloud/ubuntu-2204-lts"
            size  = 20
        }
    }

    network_interface {
        network = "default"
        access_config {}
    }

    metadata_startup_script = file("startup.sh")

    tags = ["app"]
}
