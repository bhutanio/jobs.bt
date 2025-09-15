# Phase 1: Data Model (Simple Job Site)

## Entities and Fields

### User
- id (bigInt)
- name (string, 255)
- email (string, unique)
- phone (string, verified_at nullable datetime)
- role (enum: admin, job_seeker, employer)
- email_verified_at (datetime nullable)
- password (hashed)
- created_at, updated_at

Validation:
- email required, unique; phone required; role required in set

### Company
- id (bigInt)
- name (string, unique)
- description (text nullable)
- logo (string nullable)
- verified_at (datetime nullable)
- created_at, updated_at

Relations:
- hasMany(User as employers)

Validation:
- name required, unique

### JobPosting
- id (bigInt)
- company_id (bigInt, fk Company)
- title (string)
- description (longtext)
- requirements (longtext)
- location (string nullable)
- employment_type (enum: full_time, part_time, contract, intern, temp)
- salary (string nullable)
- status (enum: draft, published, paused, closed)
- published_at (datetime nullable)
- created_at, updated_at

Indexes:
- (status, published_at desc)

### Resume
- id (bigInt)
- user_id (bigInt, fk User)
- content (longtext)
- version_label (string, 100)
- created_at, updated_at

Constraints:
- visibility private; only shared via Application

### Application
- id (bigInt)
- user_id (bigInt, fk User)
- job_posting_id (bigInt, fk JobPosting)
- resume_id (bigInt, fk Resume)
- cover_letter (longtext nullable)
- status (enum: submitted, reviewed, accepted, rejected, withdrawn)
- submitted_at (datetime)
- created_at, updated_at

Unique:
- (user_id, job_posting_id)

### Recommendation
- id (bigInt)
- user_id (bigInt, fk User)
- job_posting_id (bigInt, fk JobPosting)
- relevance_score (decimal(5,2))
- feedback (enum: saved, hidden, not_relevant nullable)
- generated_at (datetime)
- created_at, updated_at

## Relationships Summary
- User hasMany Resume, hasMany Application, hasMany Recommendation
- Company hasMany JobPosting, hasMany User (employers)
- JobPosting belongsTo Company; hasMany Application
- Application belongsTo User, JobPosting, Resume
- Recommendation belongsTo User and JobPosting

## State Transitions
- JobPosting: draft → published → paused ↔ published → closed (terminal)
- Application: submitted → reviewed → accepted|rejected; submitted → withdrawn (terminal)


