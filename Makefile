# Install

copy:
	cp .env.example .env

install:
	@echo "Starting full installation"
	docker compose up -d
	@echo "Waiting for containers..."
	sleep 5

	@echo "Installing PHP dependencies"
	docker exec -it laravel_app composer install

	@echo "Generating app key"
	docker exec -it laravel_app php artisan key:generate

	@echo "Running migrations"
	docker exec -it laravel_app php artisan migrate --force
	docker exec -it laravel_app php artisan db:seed --class=SettingsSeeder

	@echo "Creating admin user"
		docker exec laravel_app php artisan tinker --execute="\
		\\App\\Models\\User::firstOrCreate( \
			['email' => '$(ADMIN_EMAIL)'], \
			[ \
				'name' => 'Admin Demo', \
				'password' => bcrypt('$(ADMIN_PASSWORD)'), \
				'role' => 'admin', \
				'status' => 'active', \
			] \
		);"
		@echo "------------------------------------"
		@echo "Admin user ready:"
		@echo "Email    : $(ADMIN_EMAIL)"
		@echo "Password : $(ADMIN_PASSWORD)"
		@echo "------------------------------------"

		@echo "Installation complete"


start:
	docker compose up -d
	docker exec -it laravel_app php artisan serve --host=0.0.0.0 --port=8000
# Git Shortcut (Main Push)
g:
	git pull
	git add .
	git commit -m "Last Commit"
	git push -u origin main

# Use Command
app:
	docker exec -it laravel_app bash

# Other
tunnel:
	ngrok start web1
