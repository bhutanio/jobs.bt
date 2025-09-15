# Tasks: Simple Job Site

**Input**: Design documents from `/Users/abi/Sites/jobs/specs/001-simple-job-site/`
**Prerequisites**: plan.md (required), research.md, data-model.md, contracts/

## Execution Flow (main)
```
1. Load plan.md from feature directory
   → Extract: tech stack, libraries, structure
2. Load optional design documents:
   → data-model.md: Extract entities → model tasks
   → contracts/: Each file → contract test task
   → research.md: Extract decisions → setup tasks
   → quickstart.md: Extract scenarios → integration tests
3. Generate tasks by category (Setup → Tests → Models → Services → Endpoints → Integration → Polish)
4. Apply task rules: [P] for different files; sequential within same file
5. Number tasks sequentially (T001, T002...)
6. Validate completeness
```

## Format: `[ID] [P?] Description`
- **[P]**: Can run in parallel (different files, no dependencies)
- Include exact file paths in descriptions

## Path Conventions
- Single Laravel monolith at repository root: `/Users/abi/Sites/jobs/`
- Source: `/Users/abi/Sites/jobs/app/`, `/Users/abi/Sites/jobs/routes/`, `/Users/abi/Sites/jobs/resources/`
- Tests (Pest): `/Users/abi/Sites/jobs/tests/`

## Phase 3.1: Setup
- [x] T001 Initialize Laravel 12 app in repo root
  - Command: `composer create-project laravel/laravel .` (run in `/Users/abi/Sites/jobs`)
- [x] T002 Require backend dependencies
  - Command: `composer require laravel/fortify spatie/laravel-permission barryvdh/laravel-dompdf`
- [x] T003 [P] Require dev tools (Pest, Pint)
  - Command: `composer require pestphp/pest --dev laravel/pint --dev`
- [x] T004 [P] Publish vendor configs
  - Commands:
    - `php artisan vendor:publish --provider="Laravel\\Fortify\\FortifyServiceProvider"`
    - `php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider"`
    - `php artisan vendor:publish --provider="Barryvdh\\DomPDF\\ServiceProvider"`
- [x] T005 [P] Configure Pest
  - Command: `php artisan pest:install`
  - Ensure tests directory at `/Users/abi/Sites/jobs/tests`
- [x] T006 [P] Configure Pint
  - Create `/Users/abi/Sites/jobs/pint.json` with PSR-12 and project rules (prefer snake_case for local variables)
- [x] T007 [P] Configure Vite + Bootstrap 5.3.6 + NobleUI + jQuery 3.7.1 + SCSS
  - Edit `/Users/abi/Sites/jobs/resources/js/app.js`, `/Users/abi/Sites/jobs/resources/scss/app.scss`, `/Users/abi/Sites/jobs/vite.config.js`
- [x] T008 Configure .env and database (MySQL 8)
  - Files: `/Users/abi/Sites/jobs/.env`, set DB_*, MAIL_*
  - Commands: `php artisan key:generate`, `php artisan migrate`
- [x] T009 [P] Seed base roles and permissions
  - Files: `/Users/abi/Sites/jobs/database/seeders/RolesSeeder.php`
  - Command: `php artisan db:seed --class=RolesSeeder`

## Phase 3.2: Tests First (TDD) – MUST FAIL BEFORE IMPLEMENTATION
### Contract tests from OpenAPI (/contracts/openapi.yaml)
- [x] T010 [P] Contract test POST /auth/register
  - File: `/Users/abi/Sites/jobs/tests/Contract/Auth/RegisterTest.php`
- [x] T011 [P] Contract test GET /jobs
  - File: `/Users/abi/Sites/jobs/tests/Contract/Jobs/ListJobsTest.php`
- [x] T012 [P] Contract test POST /jobs
  - File: `/Users/abi/Sites/jobs/tests/Contract/Jobs/CreateJobTest.php`
- [x] T013 [P] Contract test GET /jobs/{id}
  - File: `/Users/abi/Sites/jobs/tests/Contract/Jobs/ShowJobTest.php`
- [x] T014 [P] Contract test POST /jobs/{id}/apply
  - File: `/Users/abi/Sites/jobs/tests/Contract/Applications/ApplyJobTest.php`
- [x] T015 [P] Contract test POST /ai/resume
  - File: `/Users/abi/Sites/jobs/tests/Contract/AI/GenerateResumeTest.php`
- [x] T016 [P] Contract test POST /ai/job
  - File: `/Users/abi/Sites/jobs/tests/Contract/AI/GenerateJobTest.php`
- [x] T017 [P] Contract test GET /recommendations
  - File: `/Users/abi/Sites/jobs/tests/Contract/Recommendations/ListRecommendationsTest.php`

### Integration tests from acceptance scenarios
- [x] T018 [P] Integration: register Job Seeker → lands on Job Seeker dashboard
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/RegisterJobSeekerTest.php`
- [x] T019 [P] Integration: AI resume draft creation/edit/save flow
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/ResumeBuilderFlowTest.php`
- [x] T020 [P] Integration: Home page lists recent jobs sorted by published_at desc
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/HomeRecentJobsTest.php`
- [x] T021 [P] Integration: Apply to job → in-app + email confirmation
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/ApplyJobFlowTest.php`
- [x] T022 [P] Integration: Recommendations appear for completed profile
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/RecommendationsFlowTest.php`
- [x] T023 [P] Integration: register Employer → lands on Employer dashboard
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/RegisterEmployerTest.php`
- [x] T024 [P] Integration: AI job generation draft/edit/publish flow
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/AIJobGeneratorFlowTest.php`
- [x] T025 [P] Integration: Employer dashboard lists applicants with resumes
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/EmployerApplicantsListTest.php`
- [x] T026 [P] Integration: No matches messaging + suggestions
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/NoMatchesMessagingTest.php`
- [x] T027 [P] Integration: AI unavailable → manual fallback
  - File: `/Users/abi/Sites/jobs/tests/Feature/Integration/AIFallbackFlowTest.php`

## Phase 3.3: Core Implementation (ONLY after tests are failing)
### Models, Migrations, Factories
- [x] T028 [P] User model updates (role: admin|job_seeker|employer, phone)
  - Files: `/Users/abi/Sites/jobs/app/Models/User.php`, `/Users/abi/Sites/jobs/database/migrations/*_update_users_table.php`, `/Users/abi/Sites/jobs/database/factories/UserFactory.php`
- [x] T029 [P] Company model + migration + factory (logo field)
  - Files: `/Users/abi/Sites/jobs/app/Models/Company.php`, `/Users/abi/Sites/jobs/database/migrations/*_create_companies_table.php`, `/Users/abi/Sites/jobs/database/factories/CompanyFactory.php`
- [x] T030 [P] JobPosting model + migration + factory (salary field)
  - Files: `/Users/abi/Sites/jobs/app/Models/JobPosting.php`, `/Users/abi/Sites/jobs/database/migrations/*_create_job_postings_table.php`, `/Users/abi/Sites/jobs/database/factories/JobPostingFactory.php`
- [x] T031 [P] Resume model + migration + factory (no source enum)
  - Files: `/Users/abi/Sites/jobs/app/Models/Resume.php`, `/Users/abi/Sites/jobs/database/migrations/*_create_resumes_table.php`, `/Users/abi/Sites/jobs/database/factories/ResumeFactory.php`
- [x] T032 [P] Application model + migration + factory
  - Files: `/Users/abi/Sites/jobs/app/Models/Application.php`, `/Users/abi/Sites/jobs/database/migrations/*_create_applications_table.php`, `/Users/abi/Sites/jobs/database/factories/ApplicationFactory.php`
- [x] T033 [P] Recommendation model + migration + factory
  - Files: `/Users/abi/Sites/jobs/app/Models/Recommendation.php`, `/Users/abi/Sites/jobs/database/migrations/*_create_recommendations_table.php`, `/Users/abi/Sites/jobs/database/factories/RecommendationFactory.php`
- [x] T034 Define relationships and indexes per data-model
  - Files: all model files above and related migrations

### Services
- [ ] T035 [P] AIResumeGeneratorService interface + provider adapter
  - Files: `/Users/abi/Sites/jobs/app/Services/AI/AIResumeGeneratorService.php`, `/Users/abi/Sites/jobs/app/Services/AI/Providers/ProviderClient.php`
- [ ] T036 [P] AIJobGeneratorService interface + provider adapter
  - Files: `/Users/abi/Sites/jobs/app/Services/AI/AIJobGeneratorService.php`, `/Users/abi/Sites/jobs/app/Services/AI/Providers/ProviderClient.php`
- [ ] T037 [P] RecommendationsService (match jobs to seeker profile)
  - Files: `/Users/abi/Sites/jobs/app/Services/RecommendationsService.php`

### Controllers, Routes, Policies
- [x] T038 Customize Fortify registration to include role + phone verification stubs
  - Files: `/Users/abi/Sites/jobs/app/Providers/FortifyServiceProvider.php`, `/Users/abi/Sites/jobs/app/Actions/Fortify/CreateNewUser.php`
- [x] T039 JobsController (index, store, show) + routes
  - Files: `/Users/abi/Sites/jobs/app/Http/Controllers/JobsController.php`, `/Users/abi/Sites/jobs/routes/web.php`, `/Users/abi/Sites/jobs/routes/api.php`
- [x] T040 ApplicationsController@apply + routes
  - Files: `/Users/abi/Sites/jobs/app/Http/Controllers/ApplicationsController.php`, `/Users/abi/Sites/jobs/routes/api.php`
- [x] T041 AIController (generateResume, generateJob) + routes
  - Files: `/Users/abi/Sites/jobs/app/Http/Controllers/AIController.php`, `/Users/abi/Sites/jobs/routes/api.php`
- [x] T042 RecommendationsController@index + routes
  - Files: `/Users/abi/Sites/jobs/app/Http/Controllers/RecommendationsController.php`, `/Users/abi/Sites/jobs/routes/api.php`
- [ ] T043 [P] Policies + Spatie roles/permissions (admin, job_seeker, employer)
  - Files: `/Users/abi/Sites/jobs/app/Policies/*.php`, `/Users/abi/Sites/jobs/app/Providers/AuthServiceProvider.php`

### Views (Bootstrap + NobleUI)
- [x] T044 Home page (recent jobs), job detail page (apply button)
  - Files: `/Users/abi/Sites/jobs/resources/views/home.blade.php`, `/Users/abi/Sites/jobs/resources/views/jobs/show.blade.php`
- [x] T045 Dashboards: Job Seeker and Employer
  - Files: `/Users/abi/Sites/jobs/resources/views/dashboards/job_seeker.blade.php`, `/Users/abi/Sites/jobs/resources/views/dashboards/employer.blade.php`
- [x] T046 Resume builder (AI-assisted) and employer job generator pages
  - Files: `/Users/abi/Sites/jobs/resources/views/resume/builder.blade.php`, `/Users/abi/Sites/jobs/resources/views/jobs/generator.blade.php`

## Phase 3.4: Integration
- [ ] T047 Notifications: ApplicationSubmitted (in-app + email)
  - Files: `/Users/abi/Sites/jobs/app/Notifications/ApplicationSubmitted.php`
- [ ] T048 Rate limiting per spec (AI 5/h & 20/day; apply 10/h)
  - Files: `/Users/abi/Sites/jobs/app/Providers/RouteServiceProvider.php` (throttle), route middleware
- [ ] T049 Resume privacy enforcement and access controls
  - Files: Controllers/Policies ensuring only attached resumes visible to employers
- [ ] T050 Company verification tag display (verified_at)
  - Files: `/Users/abi/Sites/jobs/resources/views/components/company-badge.blade.php`
- [ ] T051 Performance: cache recent jobs list; ensure P50≤2s, P95≤4s
  - Files: JobsController index; caching config
- [ ] T052 Logging and error handling (structured context per request)
  - Files: middleware/logging config

## Phase 3.5: Polish
- [ ] T053 [P] Unit tests for services (AI + Recommendations)
  - Files: `/Users/abi/Sites/jobs/tests/Unit/AIResumeGeneratorServiceTest.php`, `/Users/abi/Sites/jobs/tests/Unit/AIJobGeneratorServiceTest.php`, `/Users/abi/Sites/jobs/tests/Unit/RecommendationsServiceTest.php`
- [ ] T054 [P] Factories and seeders for demo data (companies, jobs, users)
  - Files: `/Users/abi/Sites/jobs/database/factories/*`, `/Users/abi/Sites/jobs/database/seeders/DemoSeeder.php`
- [ ] T055 [P] Documentation updates (quickstart.md, README, API contract cross-check)
  - Files: `/Users/abi/Sites/jobs/specs/001-simple-job-site/quickstart.md`, `/Users/abi/Sites/jobs/README.md`
- [ ] T056 [P] Code style pass with Pint (ensure snake_case for variables where applicable)
  - Command: `./vendor/bin/pint`

## Dependencies
- Setup (T001–T009) before Tests (T010–T027)
- Tests must fail before Core (T028–T046)
- Models (T028–T033) before Services/Controllers (T035–T043)
- Controllers before Views integration (T044–T046)
- Core before Integration (T047–T052)
- Implementation before Polish (T053–T056)

## Parallel Example
```
# Launch contract tests together ([P] tasks T010–T017):
Task: "php artisan make:test Contract/Auth/RegisterTest --pest --unit" -> /tests/Contract/Auth/RegisterTest.php
Task: "php artisan make:test Contract/Jobs/ListJobsTest --pest --unit" -> /tests/Contract/Jobs/ListJobsTest.php
Task: "php artisan make:test Contract/Jobs/CreateJobTest --pest --unit" -> /tests/Contract/Jobs/CreateJobTest.php
Task: "php artisan make:test Contract/Jobs/ShowJobTest --pest --unit" -> /tests/Contract/Jobs/ShowJobTest.php
Task: "php artisan make:test Contract/Applications/ApplyJobTest --pest --unit" -> /tests/Contract/Applications/ApplyJobTest.php
Task: "php artisan make:test Contract/AI/GenerateResumeTest --pest --unit" -> /tests/Contract/AI/GenerateResumeTest.php
Task: "php artisan make:test Contract/AI/GenerateJobTest --pest --unit" -> /tests/Contract/AI/GenerateJobTest.php
Task: "php artisan make:test Contract/Recommendations/ListRecommendationsTest --pest --unit" -> /tests/Contract/Recommendations/ListRecommendationsTest.php
```

## Validation Checklist
- [x] All contracts have corresponding tests
- [x] All entities have model tasks
- [x] All tests come before implementation
- [x] Parallel tasks marked only when independent
- [x] Each task specifies exact file path
- [x] No task modifies same file as another [P] task
