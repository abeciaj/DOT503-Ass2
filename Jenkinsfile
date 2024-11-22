pipeline {
	agent any
	environment {
		GIT_COMMIT_SHORT = "${sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()}"
		DOCKER_IMAGE = "local-image:${env.GIT_COMMIT_SHORT}"
		DOCKER_TAG = "build-${env.BUILD_NUMBER}"
	}
    stages {
			stage('Checkout') {
				steps {
					git branch: 'master', url: 'https://github.com/abeciaj/DOT503-Ass2.git'
				}
			}

			stage('Build Docker Image') {
				steps {
					script {
						// Build the Docker image
						sh 'docker build --no-cache -t laravel_app .'
					}
				}
			}

			stage('Run Docker Container') {
				steps {
					script {
						// Start the application using docker
						sh 'docker run -d --name testing-app -p 8000:8000 -v $(pwd):/var/www -w /var/www laravel_app'
						sh 'docker exec testing-app composer install --optimize-autoloader'
					}
				}
			}

			stage('Run Unit Tests') {
				steps {
					script {
						// Run Laravel unit tests inside the Docker container
						sh 'docker exec testing-app php artisan test'
					}
				}
			}
    }

	post {
		success {
			echo "Build and deployment completed successfully."
		}
		failure {
			echo "Build or deployment failed. Please check the logs."
		}
	}
}
