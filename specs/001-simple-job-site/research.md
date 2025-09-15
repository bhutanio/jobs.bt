# Phase 0 Research: Simple Job Site

## Decisions and Rationale

- Framework: Laravel 12+ on PHP 8.3+
  - Rationale: Mature ecosystem, batteries-included MVC, first-class tooling, rapid delivery.
  - Alternatives: Symfony (more boilerplate), Slim (microframework, more plumbing), Node/NestJS (different stack).

- Database: MySQL 8.x with Eloquent ORM
  - Rationale: Well-supported in Laravel, strong indexing, transactional integrity, easy local/dev ops.
  - Alternatives: PostgreSQL (excellent features, also viable), SQLite (dev-only), MongoDB (not a fit for relational needs).

- Authentication: Laravel Fortify
  - Rationale: Official headless auth, flexible to pair with Blade/NobleUI; supports 2FA, email verification.
  - Alternatives: Breeze/Jetstream (UI-scaffolded), custom guards (more work).

- RBAC: Spatie Laravel Permission
  - Rationale: De facto standard for roles/permissions, clean API, policy integration.
  - Alternatives: Native Gates/Policies only (manual role mgmt), Bouncer (similar capability).

- PDF generation: DomPDF
  - Rationale: Popular, stable for resume export; supported via barryvdh/laravel-dompdf.
  - Alternatives: wkhtmltopdf (heavier), Browsershot (puppeteer-based), TCPDF.

- Frontend UI: Bootstrap 5.3.6 + NobleUI admin + jQuery 3.7.1, built with Vite and SCSS
  - Rationale: Fast delivery with Bootstrap components and NobleUI patterns; jQuery acceptable for light interactivity; Vite is Laravel default.
  - Alternatives: Tailwind + Livewire/Alpine (also viable), Vue/React SPA (overkill for MVP).

- Testing: Pest
  - Rationale: Concise syntax; integrates seamlessly with Laravel; aligns with team preference.
  - Alternatives: PHPUnit (more verbose). 

- Formatting: Laravel Pint
  - Rationale: Official code style enforcement.

- AI features (resume/job generation, matching): provider-agnostic adapter
  - Rationale: Ability to switch LLMs; enforce rate limits; clear disclaimers; manual fallback.
  - Alternatives: Hardwire to single provider (vendor lock-in risk).

- Notifications: In-app + email confirmations
  - Rationale: Explicit user feedback on application submission.

- Verification: Phone verification for both roles; manual company verification with "Verified" tag
  - Rationale: Trust/safety and employer authenticity.

## Key Constraints (from spec)
- Resume privacy: Employers cannot browse a resume DB; resumes only via applications.
- Role switching prohibited: New account required to change role.
- AI rate limits: 5/hour and 20/day per user; applications 10/hour per seeker.
- Performance: Home page jobs list P50 ≤ 2s, P95 ≤ 4s.

## Open Issues
None. All clarifications resolved in the spec.

## References
- Laravel, Fortify, Spatie Permission, DomPDF, Pest, Pint, Bootstrap, NobleUI, Vite documentation.


