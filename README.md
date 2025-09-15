## Simple Job Site (Laravel 12)

A Laravel 12 monolith for a simple job marketplace with Job Seeker and Employer roles. Includes authentication via Fortify, role/permission management via Spatie, AI-assisted resume and job draft generation (stubbed), recommendations, applications, notifications, and basic dashboards.

### Features
- **Auth (Fortify)**: registration, login, reset password, 2FA views configured in `app/Providers/FortifyServiceProvider.php`.
- **Roles & Permissions**: via `spatie/laravel-permission` with gates in `app/Providers/AuthServiceProvider.php` and example routes restricting dashboards.
- **Jobs & Applications**: browse jobs, view details, and apply (authenticated). See routes in `routes/web.php` and controllers in `app/Http/Controllers`.
- **AI Draft Generators (stub)**: interfaces in `app/Services/AI` bound to `ProviderClient` in `AppServiceProvider`.
- **Rate Limiting**: custom limiters for AI and apply actions in `AppServiceProvider`.
- **Notifications**: stored in DB (see migration `2025_09_15_090000_create_notifications_table.php`) and mailed.
- **Dashboards**: role-based redirects for `admin`, `employer`, `job_seeker`.

### Tech Stack
- PHP 8.2+, Laravel 12
- Fortify (auth), Spatie Permission (roles)
- Pest (tests), Pint (formatting)
- Vite, Node 20+

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 20+ and npm
- SQLite (default) or another DB supported by Laravel

### Installation
```bash
# Clone and enter
git clone <your-repo-url> jobs && cd jobs

# Install PHP deps
composer install

# Copy env and app key
cp .env.example .env
php artisan key:generate

# Use SQLite by default
# Create the DB file if it doesn't exist
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"

# Configure your .env
# DB_CONNECTION=sqlite (uncomment) or set up MySQL/PostgreSQL
# MAIL_*, QUEUE_CONNECTION=database (optional)

# Run migrations
php artisan migrate --graceful --ansi

# Seed roles, demo data, and an admin user
php artisan db:seed --ansi
# Demo data seeder (optional but recommended)
php artisan db:seed --class=DemoSeeder --ansi

# Install JS deps and build assets
npm install
npm run build # or: npm run dev for hot reload
```

### Running the App
```bash
# Start Laravel HTTP server and Vite in separate terminals
php artisan serve
npm run dev
```
Open http://127.0.0.1:8000

### Demo Accounts
- **Admin**: `admin@example.com` / `password`
- **Employer**: `employer@example.com` / `password`
- **Job Seeker**: `seeker@example.com` / `password`

These are created by the seeders in `database/seeders`.

### Testing
```bash
# Clear cached config to avoid env drift
php artisan config:clear --ansi

# Run the test suite (Pest)
./vendor/bin/pest

# Or via composer script
composer test
```

### Development Utilities
```bash
# Run concurrent dev processes (HTTP server, queue listener, logs, Vite)
composer dev

# Lint/format with Pint
./vendor/bin/pint
```

### Configuration Notes
- **Auth Views**: registered in `FortifyServiceProvider` and rendered from `resources/views/auth/*`.
- **Roles/Gates**: `is-admin`, `is-employer`, `is-job-seeker` defined in `AuthServiceProvider`.
- **Dashboards**: `GET /dashboard` redirects to role dashboards; see `routes/web.php`.
- **AI Providers**: `AIResumeGeneratorService` and `AIJobGeneratorService` are bound to `Providers/ProviderClient` (stub implementation) in `AppServiceProvider`. Replace bindings to integrate a real AI provider.
- **Rate Limits**: named limiters `ai` and `apply` in `AppServiceProvider`.
- **Mail/Queues**: configure `MAIL_*` and `QUEUE_CONNECTION` as needed.

### Environment (.env) Quick Reference
```env
APP_NAME="Simple Job Site"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# SQLite (default)
DB_CONNECTION=sqlite
# For MySQL/Postgres, fill in DB_* accordingly

# Fortify / Session basics
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail (optional for notifications)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="no-reply@example.com"
MAIL_FROM_NAME="Simple Job Site"

# Queue (optional)
QUEUE_CONNECTION=sync
```

### Project Scripts (Composer)
- **dev**: runs server, queue:listen, pail logs, and Vite together.
- **test**: clears config cache and runs `artisan test` (Pest powered).

### Folder Highlights
- `app/Services/AI/*`: AI interfaces and provider client.
- `app/Providers/*`: service providers, Fortify, gates, rate limiting.
- `routes/web.php`: homepage, job views, application routes, dashboards.
- `database/seeders/*`: roles, demo data, admin user.
- `tests/*`: Pest tests (Feature, Integration, Contract, Unit).

### Replacing AI Stubs
Implement real providers by creating a concrete client that implements:
```php
App\Services\AI\AIResumeGeneratorService::generateResumeDraft(array $input): array
App\Services\AI\AIJobGeneratorService::generateJobDraft(array $input): array
```
Then bind it in `AppServiceProvider::register()` instead of `ProviderClient`.

### License
MIT
