# Simple Job Site Constitution

## Core Principles

### I. Simplicity
- Single Laravel 12 monolith; prefer first-party features.
- Use Eloquent directly; avoid Repository/UoW unless justified.
- Introduce services only for substantial domain logic.

### II. Laravel Conventions
- PHP 8.3+, MySQL 8, Vite, SCSS, Bootstrap 5.3.6 + NobleUI, jQuery 3.7.1.
- Auth via Fortify; RBAC via Spatie Permission; PDFs via barryvdh/laravel-dompdf.
- Code style with Pint; variables use snake_case where practical.

### III. Test-First (Pest)
- TDD: write failing tests first; Red-Green-Refactor.
- Contract tests from OpenAPI under `specs/001-simple-job-site/contracts/`.
- Fast tests use SQLite in-memory; CI integration tests use MySQL.

### IV. Contracts & Integration
- Public API defined by OpenAPI; changes require updated contract tests.
- Integration tests cover auth, resumes, job CRUD, applications, recommendations.

### V. Security, Privacy, Observability, Versioning
- Enforce RBAC; phone verification; manual company verification.
- Resume privacy by default; employers only see resumes attached to their jobs.
- AI assistance requires explicit consent and clear labeling.
- Rate limits: AI 5/h & 20/day per user; applications 10/h per seeker.
- Structured logging with contextual ids; clear error/validation messaging.
- Semantic versioning post-MVP; safe migrations with rollback paths.

## Additional Constraints
- Performance: home jobs list P50 ≤ 2s, P95 ≤ 4s.
- Data deletion: deactivate immediately; purge within 30 days (retain minimal legal/accounting ≤ 90 days).
- No role switching after registration; new account needed for a different role.

## Development Workflow
- Keep docs in `specs/001-simple-job-site/`; contracts live in `/contracts/`.
- Start with entities and contracts → tests → implementation.
- Avoid premature abstraction; prefer early returns and small controllers.
- Use queues only when performance/UX requires.

## Governance
- This constitution supersedes other practices for this feature.
- Deviations require documented rationale and review approval.
- All PRs must pass tests, Pint, and constitution checks.

**Version**: 2.1.1 | **Ratified**: 2025-09-15 | **Last Amended**: 2025-09-15