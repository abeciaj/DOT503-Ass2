pipeline {
    agent {
        docker {
            image 'php:8.1-cli'
        }
    }
    environment {
        APP_ENV = 'testing'
    }
    stages {
        stage('Checkout') {
            steps {
                // Clone the Laravel project
                git branch: 'main', url: 'git@github.com:abeciaj/DOT503-Ass2.git'
            }
        }
        stage('Install Dependencies') {
            steps {
                sh '''
                composer install
                cp .env.example .env
                php artisan key:generate
                '''
            }
        }
        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }
        stage('Build Docker Image') {
            steps {
                sh '''
                docker-compose -f docker-compose.yml build
                docker-compose -f docker-compose.yml up -d
                '''
            }
        }
        stage('Deploy') {
            steps {
                // Run migrations
                sh 'docker-compose exec app php artisan migrate'
                // Serve the application
                sh 'docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000'
            }
        }
    }
    post {
        always {
            echo "Pipeline completed."
        }
    }
}
