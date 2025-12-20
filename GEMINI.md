# GEMINI Project Analysis: Laravel Doorgift App

## Project Overview

This project is a web application built with the Laravel framework (version 11). It appears to be an e-commerce or product catalog application, specifically for "doorgifts." The application uses Filament (version 4) for its admin panel, which seems to be the primary interface for managing the application's data. The frontend is built using Vite and Tailwind CSS. The application is also configured to be multilingual, supporting both English and Malay.

### Key Technologies

*   **Backend:** Laravel 11, PHP 8.2
*   **Admin Panel:** Filament 4
*   **Frontend:** Vite, Tailwind CSS
*   **Database:** (Not explicitly defined, but likely MySQL or similar, using Laravel's default)

### Architecture

The application follows a standard Laravel MVC architecture. The main business logic appears to be centered around the `Product` model and its management through the Filament admin panel. The `routes/web.php` is very minimal, suggesting that most user interaction happens within the admin panel.

## Building and Running

### Setup

To set up the project for the first time, run the following command:

```bash
composer run setup
```

This will:
1.  Install Composer dependencies.
2.  Create a `.env` file from the example.
3.  Generate an application key.
4.  Run database migrations.
5.  Install NPM dependencies.
6.  Build frontend assets.

### Development

To start the development server, user has to run:

```bash
./vendor/bin/sail up -d

npm run dev
```

To start Laravel Reverb server, user has to run:

```bash
./vendor/bin/sail artisan reverb:start

npm run dev
```


### Testing

To run the test suite, use:

```bash
composer run test
```

## Development Conventions

*   **Code Style:** The project uses Laravel Pint for code styling.
*   **Database Migrations:** Database schema changes are managed through Laravel's migration system.
*   **Localization:** All user-facing strings in the Filament resources are translated using Laravel's localization features (e.g., `__('Nama')`). The application supports English and Malay.
*   **Admin Panel:** The primary interface for data management is the Filament admin panel, located at `/admin`.
*   **Models:** Eloquent models are used for database interaction. The `Product` model is a key part of the application.
