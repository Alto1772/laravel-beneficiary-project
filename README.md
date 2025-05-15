# TUPAD Beneficiary Management System

## Introduction

This is a Laravel-based web application I built for managing TUPAD program beneficiaries. I created this as a group project with myself as the only programmer, as well as to practice and explore Laravel development. The application provides a simple interface for tracking beneficiaries, managing projects, and visualizing data through a dashboard.

## Description

This beneficiary management system allows users to:

- Create, read, update, and delete beneficiary records
- Manage projects and associate beneficiaries with them
- Import/export beneficiary data from Excel spreadsheets
- View analytics on a dashboard with two simple bar charts
- Manage user accounts and settings

The UI is based on the free [Sneat Bootstrap HTML Laravel Admin Template](https://github.com/themeselection/sneat-bootstrap-html-laravel-admin-template-free), which I've customized to fit the needs of this project.

## Core Functionality

I've built this application around standard CRUD (Create, Read, Update, Delete) operations for managing beneficiary data. Beyond these basic operations, I've implemented:

- **Data Import**: I created a feature to bulk import beneficiary records from Excel spreadsheets, which helps me streamline the data entry process
- **Data Export**: I added functionality to export beneficiary data to Excel for my reporting and external analysis needs
- **Excel Template**: My import functionality expects data in a specific format as defined in the Beneficiaries2022.xlsx template file (I haven't included this in the repository for privacy reasons)
- **Data Validation**: I implemented validation for both manual entry and imports to ensure my data remains accurate and consistent

This approach allows me to efficiently manage large beneficiary datasets while maintaining data quality throughout my project.

## Building and Running the App

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- Laravel 11

### Installation

1. Clone the repository

```bash
git clone https://github.com/Alto1772/laravel-beneficiary-project.git
cd laravel-beneficiary-project
```

2. Install PHP dependencies

```bash
composer install
```

3. Install JavaScript dependencies

```bash
npm install
```

4. Create and configure environment file

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in the .env file

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations

```bash
php artisan migrate
```

7. Build assets

```bash
npm run build
```

8. Start the development server

```bash
php artisan serve
```

The application will be available at http://localhost:8000

## Folder Structure

```
laravel-beneficiary-project/
├── app/                    # Application code
│   ├── Console/            # Artisan commands
│   ├── Exports/            # Excel export classes
│   ├── Http/               # Controllers, middleware, requests
│   ├── Imports/            # Excel import classes
│   ├── Models/             # Eloquent models
│   ├── Providers/          # Service providers
│   └── Rules/              # Validation rules
├── database/
│   ├── factories/          # Model factories for testing
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── public/                 # Publicly accessible files
├── resources/
│   ├── assets/             # Raw assets
│   ├── css/                # CSS files
│   ├── js/                 # JavaScript files
│   ├── menu/               # Menu configuration
│   ├── sass/               # SASS files
│   └── views/              # Blade templates
├── routes/                 # Route definitions
│   └── web.php             # Web routes
├── storage/                # Application storage
├── tests/                  # Test cases (not used for brevity reasons)
├── .env                    # Environment configuration
├── composer.json           # PHP dependencies
└── package.json            # JavaScript dependencies
```

The application follows the standard Laravel structure with some additional directories for imports, exports, and menu configuration specific to this project.
