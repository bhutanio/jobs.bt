# Quickstart: Simple Job Site (Laravel Monolith)

## Prerequisites
- PHP 8.3+
- Composer
- MySQL 8.x
- Node 20+, npm or pnpm

## Setup
```bash
# From the repository root after cloning
cp .env.example .env
php artisan key:generate

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Configure database in .env then run migrations
php artisan migrate

# Optional: seed base roles/permissions
php artisan db:seed
```

## Tooling
- Authentication: Laravel Fortify
- RBAC: Spatie Laravel Permission
- PDFs: barryvdh/laravel-dompdf
- UI: Bootstrap 5.3.6 + NobleUI + jQuery 3.7.1
- Build: Vite, SCSS
- Tests: Pest
- Formatter: Laravel Pint

## Useful Commands
```bash
# Run dev server
php artisan serve

# Run Vite dev
npm run dev

# Run tests (Pest)
php artisan test

# Format code
./vendor/bin/pint
```
