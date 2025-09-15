# Feature Specification: Simple Job Site

**Feature Branch**: `001-simple-job-site`  
**Created**: 2025-09-15  
**Status**: Draft  
**Input**: User description: "Simple Job Site, signup as employee (Job Seeker) or employer (Company), resume builder, use AI, home page shows list of recent jobs, job detail page, AI based job matching, AI based job generation. employee control panel and employee control panel."

## Execution Flow (main)
```
1. Parse user description from Input
   → If empty: ERROR "No feature description provided"
2. Extract key concepts from description
   → Identify: actors, actions, data, constraints
3. For each unclear aspect:
   → Mark with [NEEDS CLARIFICATION: specific question]
4. Fill User Scenarios & Testing section
   → If no clear user flow: ERROR "Cannot determine user scenarios"
5. Generate Functional Requirements
   → Each requirement must be testable
   → Mark ambiguous requirements
6. Identify Key Entities (if data involved)
7. Run Review Checklist
   → If any [NEEDS CLARIFICATION]: WARN "Spec has uncertainties"
   → If implementation details found: ERROR "Remove tech details"
8. Return: SUCCESS (spec ready for planning)
```

---

## ⚡ Quick Guidelines
- ✅ Focus on WHAT users need and WHY
- ❌ Avoid HOW to implement (no tech stack, APIs, code structure)
- 👥 Written for business stakeholders, not developers

### Section Requirements
- **Mandatory sections**: Must be completed for every feature
- **Optional sections**: Include only when relevant to the feature
- When a section doesn't apply, remove it entirely (don't leave as "N/A")

### For AI Generation
When creating this spec from a user prompt:
1. **Mark all ambiguities**: Use [NEEDS CLARIFICATION: specific question] for any assumption you'd need to make
2. **Don't guess**: If the prompt doesn't specify something (e.g., "login system" without auth method), mark it
3. **Think like a tester**: Every vague requirement should fail the "testable and unambiguous" checklist item
4. **Common underspecified areas**:
   - User types and permissions
   - Data retention/deletion policies  
   - Performance targets and scale
   - Error handling behaviors
   - Integration requirements
   - Security/compliance needs

---

## User Scenarios & Testing *(mandatory)*

### Primary User Story
As a Job Seeker, I want to sign up, build an AI-assisted resume, discover recent and recommended jobs, and apply easily so I can get hired. As an Employer, I want to sign up, quickly generate AI-assisted job postings, publish them, and manage applicants so I can fill roles efficiently.

### Acceptance Scenarios
1. **Given** I am new to the site, **When** I register and choose "Job Seeker", **Then** my account is created and I land on a Job Seeker dashboard.
2. **Given** I am a Job Seeker, **When** I open the resume builder and provide my background (skills, experience, education), **Then** an editable AI-generated resume draft is created that I can review and save.
3. **Given** there are published jobs, **When** I visit the home page, **Then** I see a list of recent jobs with key details and can click through to a job detail page.
4. **Given** I am viewing a job detail, **When** I click "Apply" and confirm, **Then** my application is recorded and I receive an immediate in-app confirmation and an email receipt.
5. **Given** I have a completed profile/resume, **When** I view "Recommended for you", **Then** I see an AI-generated list of jobs sorted by relevance with controls to save or hide items.
6. **Given** I am new to the site, **When** I register and choose "Employer", **Then** my account is created and I land on an Employer dashboard.
7. **Given** I am an Employer, **When** I use the AI job generator and provide a job title, seniority, and key requirements, **Then** I receive an editable job posting draft that I can publish.
8. **Given** I have published a job, **When** I open my Employer dashboard, **Then** I can see the job's status and a list of applicants with their resumes.
9. **Given** there are no relevant jobs for my profile, **When** I open recommendations, **Then** the system explains no matches were found and suggests actions (update resume, broaden filters).
10. **Given** the AI service is unavailable, **When** I try to use AI resume or job generation, **Then** I am informed and offered a manual alternative without losing my progress.

### Edge Cases
- Duplicate sign-ups with the same email; role switching after registration is not allowed (new account required for different role).
- "Recent jobs" defined as postings from the last 30 days; always ordered by published date descending; paginate 20 per page.
- AI-generated text quality and appropriateness; user must be able to edit before publishing
- Empty states: no jobs available, no applications, no recommendations
- Privacy: resumes are visible to Employers only when included with an application; Employers cannot search or browse a resume database.
- Rate limiting: AI features limited to 5 generations per hour and 20 per day per user; application submissions limited to 10 per hour per Job Seeker; no cap on total applicants per job.

## Requirements *(mandatory)*

### Functional Requirements
- **FR-001**: The system MUST allow users to register as either Job Seeker (employee) or Employer (company).
- **FR-002**: The system MUST collect required fields for each role and prevent incomplete submissions; both roles MUST verify a phone number; Employers MUST provide company name and work email; Company verification is performed manually by staff and, once approved, displays a "Verified" tag on the Company profile.
- **FR-003**: The system MUST provide role-specific dashboards: a Job Seeker dashboard and an Employer dashboard.
- **FR-004**: The home page MUST display a list of published recent jobs sorted by published date descending; "recent" is defined as postings from the last 30 days; the list MUST be paginated at 20 jobs per page.
- **FR-005**: Each job card on the home page MUST show title, company, location, employment type, posted date, and a link to job detail; salary MUST be shown only if provided by the Employer; no salary estimates are displayed.
- **FR-006**: The job detail page MUST display full job description, responsibilities, requirements, company info, posted date, and an "Apply" action for Job Seekers.
- **FR-007**: Job Seekers MUST be able to create and edit a resume using an AI-assisted builder.
- **FR-008**: The AI resume builder MUST accept user inputs (work history, education, skills) and produce an editable draft; users MUST be able to revise and save versions.
- **FR-009**: If AI features are unavailable, users MUST be able to complete resume creation manually with clear, non-blocking messaging.
- **FR-010**: Employers MUST be able to create job postings manually (title, description, requirements, location, salary if provided).
- **FR-011**: Employers MUST be able to generate an AI-assisted job posting draft from brief inputs and then edit and publish it.
- **FR-012**: Employers MUST be able to publish, pause, edit, and close job postings from the Employer dashboard.
- **FR-013**: Job Seekers MUST be able to apply to jobs with a selected resume version and optional cover letter.
- **FR-014**: The system MUST confirm successful application in the UI and record the application for both parties; an immediate in-app confirmation and an email receipt MUST be sent to the Job Seeker.
- **FR-015**: The system MUST provide AI-based job matching that recommends jobs to Job Seekers using their profile and resume data.
- **FR-016**: Recommendations MUST be labeled as AI-generated and MUST support user feedback (save, hide, not relevant) to refine future matches.
- **FR-017**: The system MUST provide job search and filtering by keywords, location, employment type, and company.
- **FR-018**: Employers MUST be able to view applicants per job, with access to submitted resumes and application details within the dashboard.
- **FR-019**: Job Seekers MUST have a dashboard to view/save jobs, track applications, and access recommendations.
- **FR-020**: The system MUST ensure resume privacy by default; Employers can only access resumes attached to applications submitted to their jobs; Employers cannot search or browse a general resume database.
- **FR-021**: Users MUST be able to manage their accounts: update profile information, change password, and request account deletion; upon deletion request, the account is deactivated immediately and personal data is permanently deleted within 30 days, except minimal records retained for legal/accounting purposes for up to 90 days.
- **FR-022**: The system MUST provide a mechanism to report inappropriate job postings or AI-generated content; reports create a moderation queue; moderators review within 48 hours and may remove content; high-risk content may be temporarily limited in visibility pending review.
- **FR-023**: The system MUST capture explicit user consent before using AI assistance, label AI-generated content clearly, and store consent timestamps; AI output MUST include a disclaimer that users should review and edit before publishing.
- **FR-024**: The home page jobs list MUST load within 2 seconds at P50 and 4 seconds at P95 on a typical broadband connection.
- **FR-025**: Role changes (Job Seeker ↔ Employer) are not allowed after registration; users who need a different role MUST create a new account.

### Key Entities *(include if feature involves data)*
- **User**: A person with an account; attributes include name, email, role (Admin, Job Seeker, or Employer), and profile metadata. One User belongs to exactly one role at a time.
- **Company (Employer)**: Represents an employer organization; attributes include company name, description, logo, and contact details. One Company is associated with one or more Users with Employer role.
- **Job Posting**: A published opportunity from an Employer; attributes include title, description, requirements, location, employment type, salary (optional), status (draft/published/paused/closed), created/updated dates. A Job Posting belongs to a Company and has many Applications.
- **Resume**: A Job Seeker's resume content; attributes include work history, education, skills, and versions (AI-generated or manual). A Job Seeker can have multiple Resume versions.
- **Application**: A Job Seeker's application to a Job Posting; attributes include submission date, attached resume version, optional cover letter, and status (submitted/reviewed/accepted/rejected/withdrawn). Belongs to a Job Seeker and a Job Posting.
- **Recommendation**: An AI-generated match between a Job Seeker and a Job Posting; attributes include relevance score, generated date, and feedback (saved/hidden/not-relevant). Belongs to a Job Seeker and references one Job Posting.

---

## Review & Acceptance Checklist
*GATE: Automated checks run during main() execution*

### Assumptions & Dependencies
- Assumes availability of email delivery for notifications and receipts.
- Assumes SMS or voice channel for phone verification for both roles.
- Depends on manual company verification operations to grant the "Verified" tag.
- Assumes AI provider availability within defined rate limits; fallbacks exist when unavailable.
- Depends on a moderation process capable of 48-hour SLA.
- Assumes typical broadband connectivity for performance targets (P50 2s / P95 4s).

### Content Quality
- [x] No implementation details (languages, frameworks, APIs)
- [x] Focused on user value and business needs
- [x] Written for non-technical stakeholders
- [x] All mandatory sections completed

### Requirement Completeness
- [x] No [NEEDS CLARIFICATION] markers remain
- [x] Requirements are testable and unambiguous  
- [x] Success criteria are measurable
- [x] Scope is clearly bounded
- [x] Dependencies and assumptions identified

---

## Execution Status
*Updated by main() during processing*

- [x] User description parsed
- [x] Key concepts extracted
- [x] Ambiguities marked
- [x] User scenarios defined
- [x] Requirements generated
- [x] Entities identified
- [x] Review checklist passed

---


