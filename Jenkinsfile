pipeline {
	
	agent any
	environment {
		GIT_COMMIT_SHORT = "${sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()}"
		DOCKER_IMAGE = "local-image:${env.GIT_COMMIT_SHORT}"
		DOCKER_TAG = "build-${env.BUILD_NUMBER}" // Jenkins BUILD_NUMBER for incremental tags
	}
    stages {
			stage('Checkout') {
				steps {
					git branch: 'jenkins-integration', url: 'https://github.com/abeciaj/DOT503-Ass2.git'
				}
			}

			stage('Build Docker Image') {
				steps {
					script {
						// Build the Docker image with a custom tag
						sh 'docker build -t laravel_app:${env.GIT_COMMIT_SHORT} -t laravel_app:${env.DOCKER_TAG} .'
					}
				}
			}

			stage('Run Docker Compose') {
				steps {
					script {
						// Start the application using docker
						sh 'docker run -d --name testing-app -p 8000:8000 -v $(pwd):/var/www -w /var/www laravel_app'
					}
				}
			}
    }

	post {
		success {
			echo "Build and deployment completed successfully. Image tagged as ${env.DOCKER_TAG} and ${env.GIT_COMMIT_SHORT}."
		}
		failure {
			echo "Build or deployment failed. Please check the logs."
		}
	}
}