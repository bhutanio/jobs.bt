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

# Optional: seed base roles/permissions + demo data
php artisan db:seed
php artisan db:seed --class=DemoSeeder
```

## Demo Accounts

- Admin: `admin@example.com` / `password`
- Employer: `employer@example.com` / `password`
- Job Seeker: `seeker@example.com` / `password`

## Notes

- API rate limits: AI `5/hour` and `20/day` per user; apply `10/hour`.
- Notifications are stored in the `notifications` table (mail + database).

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
./vendor/bin/pest

# Format code
./vendor/bin/pint
```
