# 🧩 PHP CRUD REST API with Docker + CI/CD + Azure

![CI](https://github.com/your-username/your-repo/actions/workflows/ci.yml/badge.svg)
[![codecov](https://codecov.io/gh/your-username/your-repo/branch/main/graph/badge.svg?token=7be6475b-38c3-4bc4-a2e0-dd50178ecbc1)](https://codecov.io/gh/your-username/your-repo)

This repository contains a clean, containerized PHP REST API for managing users with full CI/CD support, unit testing, coverage reporting, and automated deployment to Azure.

---

## ✨ Features

- ✅ PHP CRUD REST API
- 🐳 Docker + Docker Compose setup
- 🧪 Unit tests with PHPUnit
- 📈 Code coverage via Codecov
- 🔄 CI/CD using GitHub Actions
- ☁️ Azure Web App for Containers deployment
- 📬 Postman-friendly API endpoints

---

## 🧪 Postman Testing

### Base URL (local)
```
http://localhost:9090
```

### Available Endpoints

| Method | URL               | Description               |
|--------|--------------------|---------------------------|
| GET    | `/users`           | Get all users             |
| GET    | `/users/{id}`      | Get a user by ID          |
| POST   | `/users`           | Create user (form-data)   |
| PUT    | `/users/{id}`      | Update user (JSON)        |
| DELETE | `/users/{id}`      | Delete a user             |

---

## 🚀 Run Locally

```bash
docker-compose up --build
```

- API : [http://localhost:9090](http://localhost:9090)
- phpMyAdmin : [http://localhost:9091](http://localhost:9091) (user: root, password: root)

---

## ✅ CI/CD Pipeline

### CI (`.github/workflows/ci.yml`)

- Runs PHPUnit tests
- Uploads code coverage to Codecov
- Fails PR if coverage < 75%

### Deploy (`.github/workflows/deploy.yml`)

- Runs tests and coverage
- Pushes Docker image to Docker Hub
- Deploys image to Azure Web App for Containers

---

## 🔐 GitHub Secrets Required

| Secret                 | Description                          |
|------------------------|--------------------------------------|
| `CODECOV_TOKEN`        | Codecov token                        |
| `DOCKER_USERNAME`      | Docker Hub username                  |
| `DOCKER_PASSWORD`      | Docker Hub password                  |
| `AZURE_WEBAPP_NAME`    | Azure Web App name                   |
| `AZURE_PUBLISH_PROFILE`| XML publish profile from Azure       |

---

## 🧪 Run PHPUnit locally

```bash
docker-compose exec php bash
vendor/bin/phpunit --coverage-html coverage
```

Open `coverage/index.html` in your browser to see local test coverage.

---

## ☁️ Azure Deployment Notes

1. Build and push your Docker image manually or via CI:
```bash
docker build -t yourusername/php-crud-api .
docker push yourusername/php-crud-api
```

2. In Azure portal:
   - Create **Web App for Containers**
   - Use Docker Hub image: `yourusername/php-crud-api`
   - Set PORT to `9090` in Azure App Settings

