# Laravel Application
This is a Laravel-based web application designed for robust and scalable solutions. Follow the instructions below to set up and run the project locally.

---

## Prerequisites

Ensure you have the following installed on your system:

- **PHP** >= 8.1.6
- **Composer** (Dependency Manager for PHP)
- **MySQL** (or any database configured in your `.env` file)
- **Git** (Version Control System)
- **Node.js** and **npm** (For frontend asset compilation, if applicable)
---

## Installation

Follow these steps to install and configure the application:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/neobros/e-com-application


2. **Run the following command to install all required PHP dependencies:**
   ```bash
   composer i

3. **Generate a new application key:**
   ```bash
   php artisan key:generate

4. **Open the .env file and set your database credentials:**
---
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
---

5. **Run Migrations:**
   ```bash
  php artisan migrate


6. **Run seeders to populate your database with sample or required data:**
   ```bash
  php artisan db:seed


## Running the Application
   ```bash
   php artisan serve

