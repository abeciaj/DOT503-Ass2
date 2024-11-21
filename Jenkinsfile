pipeline {
	
	agent any
	environment {
		GIT_COMMIT_SHORT = "${sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()}"
		DOCKER_IMAGE = "local-image:${env.GIT_COMMIT_SHORT}"
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
							// sh "echo Hello World "
							sh "docker build -t ${DOCKER_IMAGE} ."
					}
				}
			}
			stage('Run Docker Container') {
				steps {
					sh '''
					docker rm -f local-container || true
					docker run -d --name local-container -p 8080:80 ${DOCKER_IMAGE}
					'''
				}
			}
    }

    post {
			success {
				echo "Build and local deployment completed successfully."
			}
			failure {
				echo "Build or deployment failed. Please check the logs."
				// Add notifications like Slack or email here if needed
			}
    }
}