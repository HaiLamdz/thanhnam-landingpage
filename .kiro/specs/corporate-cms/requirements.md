# Requirements Document

## Introduction

A corporate company website built with Laravel, Blade, and MySQL, featuring a public-facing frontend with multiple content sections and a full CMS admin panel. The system allows administrators to manage all dynamic content (Services, News, Contact messages) through a secure backend, while visitors browse a professional public website.

---

## Glossary

- **CMS**: Content Management System — the admin panel used to create, read, update, and delete site content.
- **Admin**: An authenticated user with access to the CMS backend.
- **Visitor**: An unauthenticated user browsing the public website.
- **Service**: A business offering displayed on the Services public page.
- **News_Post**: A dated article or announcement displayed on the News public page.
- **Contact_Message**: A form submission sent by a Visitor via the Contact page.
- **Slug**: A URL-friendly string derived from a title, used to identify resources in URLs.
- **Rich_Text**: HTML content produced by a WYSIWYG editor stored in the database.
- **Public_Site**: The publicly accessible Laravel/Blade frontend.
- **Admin_Panel**: The authenticated CMS backend accessible only to Admins.
- **Auth_Guard**: Laravel's authentication middleware protecting Admin routes.
- **Project**: A completed or ongoing work item displayed in the Recent Projects gallery on the Home page.
- **Site_Setting**: A key-value record stored in the database that holds editable static content such as hero text, about teaser copy, and company contact information.
- **CTA**: Call-to-action — a button or link prompting the Visitor to take a specific action.
- **Category_Tag**: A label attached to a News_Post used to visually classify the article on the public site.

---

## Requirements

### Requirement 1: Public Home Page

**User Story:** As a Visitor, I want to view a professional home page, so that I can get an overview of the company and navigate to other sections.

#### Acceptance Criteria

1. THE Public_Site SHALL render a Home page at the `/` route.
2. THE Public_Site SHALL include a consistent navigation bar on all public pages linking to Home, About, Services, News, and Contact.

**Hero Section**

3. WHEN a Visitor navigates to `/`, THE Public_Site SHALL display a Hero section containing a headline, a short description, a background image, and two CTA buttons labeled "Our Services" and "Contact Us".
4. WHEN a Visitor clicks "Our Services", THE Public_Site SHALL navigate to the `/services` route.
5. WHEN a Visitor clicks "Contact Us", THE Public_Site SHALL navigate to the `/contact` route.
6. THE Public_Site SHALL source the Hero headline, description, and background image from Site_Setting records managed in the Admin_Panel.

**About Teaser Section**

7. THE Public_Site SHALL display an About Teaser section with a company image on the left, descriptive text on the right, at least one highlighted statistic (e.g. "25+ Years of Experience"), and a "Learn More" CTA button linking to `/about`.
8. THE Public_Site SHALL source the About Teaser image, text, and statistic values from Site_Setting records managed in the Admin_Panel.

**Core Competencies Section**

9. THE Public_Site SHALL display a Core Competencies section presenting up to 3 Services in a three-column layout, each column showing the Service icon, title, and short description.
10. WHEN fewer than 3 published Services exist, THE Public_Site SHALL display only the available Services in the Core Competencies section.

**Recent Projects Section**

11. THE Public_Site SHALL display a Recent Projects section showing the latest published Projects in a responsive image gallery grid.
12. WHEN no published Projects exist, THE Public_Site SHALL display a placeholder message in the Recent Projects section.

**Industry Insights (News) Section**

13. THE Public_Site SHALL display an Industry Insights section showing the latest 3 published News_Posts as cards, each card containing the Category_Tag, publication date, title, and excerpt.
14. WHEN no published News_Posts exist, THE Public_Site SHALL display a placeholder message in the Industry Insights section.

**CTA Banner Section**

15. THE Public_Site SHALL display a CTA Banner section with a heading, a short description, and a "Contact Us" button linking to `/contact`.
16. THE Public_Site SHALL source the CTA Banner heading and description from Site_Setting records managed in the Admin_Panel.

**Contact Mini-Form Section**

17. THE Public_Site SHALL display a Contact section on the Home page with company contact information (address, email, phone) on the left and a quick-contact form on the right containing fields: name, email, and message.
18. WHEN a Visitor submits the Home page contact form with valid data, THE Public_Site SHALL store the submission as a Contact_Message and display an inline success confirmation.
19. IF a Visitor submits the Home page contact form with missing or invalid fields, THEN THE Public_Site SHALL display inline validation error messages without navigating away from the Home page.
20. THE Public_Site SHALL source the company address, email, and phone from Site_Setting records managed in the Admin_Panel.

**Footer Section**

21. THE Public_Site SHALL display a Footer on all public pages containing the company logo, a short company description, navigation links, and social media icon links.
22. THE Public_Site SHALL source the Footer company description and social media URLs from Site_Setting records managed in the Admin_Panel.

---

### Requirement 2: Public About Page

**User Story:** As a Visitor, I want to read about the company, so that I can understand its mission, values, and history.

#### Acceptance Criteria

1. THE Public_Site SHALL render an About page at the `/about` route.
2. THE Public_Site SHALL display static or CMS-managed content including company description, mission, and values on the About page.

---

### Requirement 3: Public Services Page

**User Story:** As a Visitor, I want to browse the company's services, so that I can evaluate whether they meet my needs.

#### Acceptance Criteria

1. THE Public_Site SHALL render a Services listing page at the `/services` route.
2. WHEN Services exist, THE Public_Site SHALL display each Service with its title, summary, and icon or image.
3. WHEN no Services exist, THE Public_Site SHALL display a placeholder message.
4. THE Public_Site SHALL render a Service detail page at `/services/{slug}`.
5. WHEN a Visitor navigates to `/services/{slug}` for a non-existent slug, THE Public_Site SHALL return a 404 response.

---

### Requirement 4: Public News Page

**User Story:** As a Visitor, I want to read company news and announcements, so that I can stay informed about the company.

#### Acceptance Criteria

1. THE Public_Site SHALL render a News listing page at the `/news` route.
2. WHEN published News_Posts exist, THE Public_Site SHALL display them ordered by publication date descending, showing title, excerpt, and date.
3. THE Public_Site SHALL paginate the News listing at 10 items per page.
4. THE Public_Site SHALL render a News detail page at `/news/{slug}`.
5. WHEN a Visitor navigates to `/news/{slug}` for a non-existent or unpublished slug, THE Public_Site SHALL return a 404 response.

---

### Requirement 5: Public Contact Page

**User Story:** As a Visitor, I want to send a message to the company, so that I can make inquiries or request information.

#### Acceptance Criteria

1. THE Public_Site SHALL render a Contact page at the `/contact` route with a form containing fields: name, email, subject, and message.
2. WHEN a Visitor submits the Contact form with valid data, THE Public_Site SHALL store the submission as a Contact_Message and display a success confirmation.
3. IF a Visitor submits the Contact form with missing or invalid fields, THEN THE Public_Site SHALL redisplay the form with inline validation error messages.
4. THE Public_Site SHALL validate that the email field contains a valid email address format.
5. THE Public_Site SHALL validate that name, subject, and message fields are non-empty and do not exceed 255, 255, and 5000 characters respectively.

---

### Requirement 6: Admin Authentication

**User Story:** As an Admin, I want to log in to the CMS, so that I can manage website content securely.

#### Acceptance Criteria

1. THE Admin_Panel SHALL expose a login page at `/admin/login`.
2. WHEN an Admin submits valid credentials, THE Auth_Guard SHALL create an authenticated session and redirect to the Admin dashboard.
3. IF an Admin submits invalid credentials, THEN THE Auth_Guard SHALL redisplay the login form with a generic error message without revealing which field was incorrect.
4. WHILE an Admin is authenticated, THE Auth_Guard SHALL allow access to all `/admin/*` routes.
5. IF an unauthenticated user attempts to access any `/admin/*` route other than `/admin/login`, THEN THE Auth_Guard SHALL redirect the user to `/admin/login`.
6. WHEN an Admin clicks logout, THE Auth_Guard SHALL invalidate the session and redirect to `/admin/login`.

---

### Requirement 7: Admin Dashboard

**User Story:** As an Admin, I want a dashboard welcome page, so that I can confirm I have successfully logged in to the CMS.

#### Acceptance Criteria

1. THE Admin_Panel SHALL render a dashboard at `/admin/dashboard` displaying a welcome message after successful login.

---

### Requirement 8: Site Settings Management

**User Story:** As an Admin, I want to edit static site content (hero text, about teaser, company info, CTA banner, footer), so that I can keep the Home page and Footer up to date without code changes.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide a Site Settings page at `/admin/settings` listing all editable Site_Setting records grouped by section (Hero, About Teaser, CTA Banner, Contact Info, Footer).
2. WHEN an Admin submits the Site Settings form with valid data, THE Admin_Panel SHALL persist all updated Site_Setting records and display a success message.
3. IF an Admin submits the Site Settings form with invalid data, THEN THE Admin_Panel SHALL redisplay the form with inline validation error messages.
4. THE Admin_Panel SHALL support uploading a background image for the Hero section and a company image for the About Teaser section, subject to the constraints defined in Requirement 13.
5. THE Admin_Panel SHALL provide input fields for: Hero headline, Hero description, Hero background image, About Teaser image, About Teaser text, About Teaser statistic label and value, CTA Banner heading, CTA Banner description, company address, company email, company phone, Footer description, and social media URLs (LinkedIn, Facebook, YouTube).

---

### Requirement 9: Services CRUD

**User Story:** As an Admin, I want to create, read, update, and delete Services, so that the public Services page reflects current offerings.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide a Services index page at `/admin/services` listing all Services with title, status, and action links.
2. WHEN an Admin submits a valid create form, THE Admin_Panel SHALL persist the Service to the database and redirect to the Services index with a success message.
3. IF an Admin submits an invalid create form, THEN THE Admin_Panel SHALL redisplay the form with validation error messages.
4. WHEN an Admin submits a valid edit form, THE Admin_Panel SHALL update the Service record and redirect to the Services index with a success message.
5. WHEN an Admin deletes a Service, THE Admin_Panel SHALL remove the Service record from the database and redirect to the Services index with a confirmation message.
6. THE Admin_Panel SHALL auto-generate a unique Slug from the Service title on creation.
7. IF a Slug collision occurs, THEN THE Admin_Panel SHALL append a numeric suffix to ensure uniqueness.
8. THE Admin_Panel SHALL support uploading an image for each Service, storing the file path in the database.

---

### Requirement 10: News CRUD

**User Story:** As an Admin, I want to create, read, update, and delete News_Posts, so that the public News page stays current.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide a News index page at `/admin/news` listing all News_Posts with title, status, publication date, and action links.
2. WHEN an Admin submits a valid create form, THE Admin_Panel SHALL persist the News_Post with Rich_Text body content and redirect to the News index with a success message.
3. IF an Admin submits an invalid create form, THEN THE Admin_Panel SHALL redisplay the form with validation error messages.
4. WHEN an Admin submits a valid edit form, THE Admin_Panel SHALL update the News_Post record and redirect to the News index with a success message.
5. WHEN an Admin deletes a News_Post, THE Admin_Panel SHALL remove the News_Post record and redirect to the News index with a confirmation message.
6. THE Admin_Panel SHALL support draft and published status for News_Posts.
7. THE Admin_Panel SHALL auto-generate a unique Slug from the News_Post title on creation.
8. THE Admin_Panel SHALL support uploading a featured image for each News_Post.
9. THE Admin_Panel SHALL allow an Admin to assign a Category_Tag (free-text label) to each News_Post.
10. THE Public_Site SHALL display the Category_Tag on each News_Post card in the Industry Insights section and on the News listing page.

---

### Requirement 11: Contact Messages Management

**User Story:** As an Admin, I want to view and manage Contact_Messages, so that I can respond to visitor inquiries.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide a Contact_Messages index page at `/admin/contact-messages` listing all submissions with sender name, email, subject, and received date.
2. WHEN an Admin views a Contact_Message, THE Admin_Panel SHALL mark it as read and display the full message content.
3. THE Admin_Panel SHALL visually distinguish unread Contact_Messages from read ones in the index listing.
4. WHEN an Admin deletes a Contact_Message, THE Admin_Panel SHALL remove the record and redirect to the index with a confirmation message.
5. THE Admin_Panel SHALL display the total count of unread Contact_Messages in the admin navigation.

---

### Requirement 12: Slug Generation and Round-Trip Integrity

**User Story:** As a developer, I want slug generation to be consistent and reversible, so that public URLs remain stable and unique.

#### Acceptance Criteria

1. THE Admin_Panel SHALL generate Slugs using only lowercase alphanumeric characters and hyphens.
2. THE Admin_Panel SHALL strip leading and trailing hyphens from generated Slugs.
3. FOR ALL content records with a Slug, THE Public_Site SHALL resolve the Slug to the correct record (round-trip: create record → generate slug → fetch by slug → same record).
4. IF a generated Slug already exists for the same content type, THEN THE Admin_Panel SHALL append `-{n}` where `{n}` is the lowest integer that produces a unique Slug.

---

### Requirement 13: Image Upload and Storage

**User Story:** As an Admin, I want to upload images for content records, so that the public site displays rich visual content.

#### Acceptance Criteria

1. THE Admin_Panel SHALL accept image uploads in JPEG, PNG, and WebP formats only.
2. IF an uploaded file exceeds 2MB, THEN THE Admin_Panel SHALL reject the upload and display a validation error.
3. THE Admin_Panel SHALL store uploaded images under the `storage/app/public/uploads` directory using Laravel's public disk.
4. WHEN an Admin replaces an existing image, THE Admin_Panel SHALL delete the previous file from storage.
5. THE Public_Site SHALL serve uploaded images via the `/storage` symlink path.

---

### Requirement 14: SEO Meta Tags

**User Story:** As a developer, I want each public page to have appropriate meta tags, so that search engines can index the site effectively.

#### Acceptance Criteria

1. THE Public_Site SHALL render a unique `<title>` tag on each public page composed of the page or content title and the company name.
2. THE Public_Site SHALL render a `<meta name="description">` tag on each public page using the page excerpt or a configured default.
3. WHEN a News_Post or Service detail page is rendered, THE Public_Site SHALL include Open Graph meta tags (`og:title`, `og:description`, `og:image`).

---

### Requirement 15: Projects CRUD

**User Story:** As an Admin, I want to create, read, update, and delete Projects, so that the Recent Projects gallery on the Home page showcases current work.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide a Projects index page at `/admin/projects` listing all Projects with title, status, and action links.
2. WHEN an Admin submits a valid create form, THE Admin_Panel SHALL persist the Project and redirect to the Projects index with a success message.
3. IF an Admin submits an invalid create form, THEN THE Admin_Panel SHALL redisplay the form with validation error messages.
4. WHEN an Admin submits a valid edit form, THE Admin_Panel SHALL update the Project record and redirect to the Projects index with a success message.
5. WHEN an Admin deletes a Project, THE Admin_Panel SHALL remove the Project record and redirect to the Projects index with a confirmation message.
6. THE Admin_Panel SHALL support draft and published status for Projects.
7. THE Admin_Panel SHALL require an image upload for each Project, subject to the constraints defined in Requirement 13.
8. THE Admin_Panel SHALL capture the following fields for each Project: title, short description, image, and status.
9. THE Public_Site SHALL display published Projects ordered by creation date descending in the Recent Projects gallery on the Home page.


# NOTE
Implementation scope should prioritize speed and simplicity.
Use Laravel + Blade with practical CRUD screens.
Avoid over-engineering.
Use a simple admin UI.
No multilingual support.
No advanced permission system.
No job application workflow in phase 1.
Project detail page is optional unless explicitly required.
SEO should be basic only.