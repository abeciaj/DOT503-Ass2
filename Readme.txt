Requirements:
- Docker

Steps:
1. Configure Dockerfile
2. Configure docker-compose.yml
3. Build the containers
	- docker-compose build
4. Start the containers
	- docker-compose up -d
5. Run Laravel commands in the container
	- docker-compose exec app php artisan migrate
	- docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000
6. Stop the container
	- docker-compose down

