# Laravel Application

A Laravel Boilerplate application setup for rapid development, including Docker, MySQL, and authentication scaffolding. This boilerplate is ideal for starting new Laravel projects with essential features pre-configured.

---

## Features

- **Laravel Framework**: A robust PHP framework for building modern web applications.
- **Dockerized Setup**: Includes Docker and Docker Compose for containerized development.
- **MySQL Database**: Pre-configured MySQL database container.
- **Authentication**: Scaffolding provided via Laravel Breeze.
- **phpMyAdmin**: Database management through an easy-to-use web interface.
- **Pre-configured Scripts**: Convenient commands for setup and deployment.

---

## Passwords

-   admin@gmail.com
-   123456

## Prerequisites

Ensure you have the following installed on your system:

- Docker & Docker Compose
- PHP 8.1 or higher (if running locally)
- Composer (if running locally)
- Node.js & npm

---

## Installation 

Follow these steps to install and configure the application:

1. **Clone the Repository**

    ```bash
    git clone https://github.com/neobros/e-com-application

    ```
2. **Run the following command to install all required PHP dependencies:**

    ```bash
    composer i

    ```
3. **Generate a new application key:**

    ```bash
    php artisan key:generate

    ```
4. **Run Migrations:**

    ```bash
    php artisan migrate

    ```
5. **Run seeders to populate your database with sample or required data:**
    ```bash
    php artisan db:seed
    ```

## Running the Application

```bash
php artisan serve

```

## Installation (Docker) 

## Prerequisites

Before using this tool, make sure you have the following installed:

- **Docker**: Docker is required to build and run the application in a container.

## Building the Docker Image

To build the Docker image for the SES-Automation Tool, execute the following command in the root directory of the project:

```bash
docker-compose run --rm app composer install
docker-compose exec app php artisan key:generate
docker-compose run --rm app chmod -R 777 storage bootstrap/cache
docker-compose exec app php artisan migrate
docker-compose up --build -d
docker-compose up -d
docker-compose down

docker-compose logs app
docker-compose logs nginx
docker-compose logs mysql