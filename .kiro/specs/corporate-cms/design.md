# Design Document — corporate-cms

## Overview

Corporate CMS là một website công ty được xây dựng trên Laravel 11 + Blade + MySQL. Hệ thống gồm hai phần tách biệt:

- **Public Site**: Frontend server-side rendering, phục vụ visitor với các trang Home, About, Services, News, Contact.
- **Admin Panel**: Backend CMS được bảo vệ bởi Auth middleware, cho phép Admin quản lý toàn bộ nội dung động.

Ưu tiên thiết kế: đơn giản, thực tế, dễ bảo trì — không over-engineer.

---

## Architecture

### Pattern: MVC (Laravel Convention)

```
Request → Route → Middleware → Controller → Service (optional) → Model → View (Blade)
```

- **Controllers** xử lý HTTP request/response, validate input, gọi Model hoặc Service.
- **Models** (Eloquent) ánh xạ database, định nghĩa relationships.
- **Services** đóng gói logic tái sử dụng (slug generation, image upload).
- **Views** (Blade) render HTML, dùng layout kế thừa và components.

### Folder Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Public/
│   │   │   ├── HomeController.php
│   │   │   ├── AboutController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── NewsController.php
│   │   │   └── ContactController.php
│   │   └── Admin/
│   │       ├── AuthController.php
│   │       ├── DashboardController.php
│   │       ├── SettingController.php
│   │       ├── ServiceController.php
│   │       ├── NewsController.php
│   │       ├── ProjectController.php
│   │       └── ContactMessageController.php
│   ├── Middleware/
│   │   └── AdminAuth.php          (redirect to /admin/login if unauthenticated)
│   └── Requests/
│       ├── StoreContactRequest.php
│       ├── StoreServiceRequest.php
│       ├── StoreNewsPostRequest.php
│       └── StoreProjectRequest.php
├── Models/
│   ├── Service.php
│   ├── NewsPost.php
│   ├── Project.php
│   ├── ContactMessage.php
│   └── SiteSetting.php
├── Services/
│   ├── SlugService.php
│   └── ImageService.php
└── Helpers/
    └── SettingHelper.php          (global helper: setting('key'))

resources/
└── views/
    ├── layouts/
    │   ├── public.blade.php       (public layout: nav + footer)
    │   └── admin.blade.php        (admin layout: sidebar + topbar)
    ├── components/
    │   ├── public/
    │   │   ├── navbar.blade.php
    │   │   ├── footer.blade.php
    │   │   ├── hero.blade.php
    │   │   ├── about-teaser.blade.php
    │   │   ├── core-competencies.blade.php
    │   │   ├── recent-projects.blade.php
    │   │   ├── industry-insights.blade.php
    │   │   ├── cta-banner.blade.php
    │   │   └── contact-mini.blade.php
    │   └── admin/
    │       ├── sidebar.blade.php
    │       ├── alert.blade.php
    │       └── image-preview.blade.php
    ├── public/
    │   ├── home.blade.php
    │   ├── about.blade.php
    │   ├── services/
    │   │   ├── index.blade.php
    │   │   └── show.blade.php
    │   ├── news/
    │   │   ├── index.blade.php
    │   │   └── show.blade.php
    │   └── contact.blade.php
    └── admin/
        ├── auth/
        │   └── login.blade.php
        ├── dashboard.blade.php
        ├── settings/
        │   └── index.blade.php
        ├── services/
        │   ├── index.blade.php
        │   ├── create.blade.php
        │   └── edit.blade.php
        ├── news/
        │   ├── index.blade.php
        │   ├── create.blade.php
        │   └── edit.blade.php
        ├── projects/
        │   ├── index.blade.php
        │   ├── create.blade.php
        │   └── edit.blade.php
        └── contact-messages/
            ├── index.blade.php
            └── show.blade.php

database/
└── migrations/
    ├── create_services_table.php
    ├── create_news_posts_table.php
    ├── create_projects_table.php
    ├── create_contact_messages_table.php
    └── create_site_settings_table.php
```

---

## Components and Interfaces

### Public Layout (`layouts/public.blade.php`)

Kế thừa bởi tất cả public views. Inject `@yield('meta')`, `@yield('content')`. Bao gồm `<x-public.navbar>` và `<x-public.footer>`.

### Admin Layout (`layouts/admin.blade.php`)

Kế thừa bởi tất cả admin views. Bao gồm `<x-admin.sidebar>` với navigation links và badge unread messages. Inject `@yield('content')`.

### Key Blade Components

| Component | Mô tả |
|---|---|
| `x-public.navbar` | Nav bar với links: Home, About, Services, News, Contact |
| `x-public.footer` | Footer với logo, description, nav links, social icons |
| `x-public.hero` | Hero section — nhận props từ SiteSetting |
| `x-public.about-teaser` | About teaser — image trái, text phải, statistic |
| `x-public.core-competencies` | Grid 3 cột Services |
| `x-public.recent-projects` | Gallery grid Projects |
| `x-public.industry-insights` | 3 News cards |
| `x-public.cta-banner` | CTA banner với heading + button |
| `x-public.contact-mini` | Mini contact form + company info |
| `x-admin.sidebar` | Sidebar với nav links + unread badge |
| `x-admin.alert` | Flash message (success/error) |
| `x-admin.image-preview` | Preview ảnh upload hiện tại |

### Service Classes

**`SlugService`**
```php
class SlugService {
    public function generate(string $title, string $model, ?int $excludeId = null): string
    // Tạo slug từ title, kiểm tra uniqueness trong bảng tương ứng,
    // append -1, -2, ... nếu collision
}
```

**`ImageService`**
```php
class ImageService {
    public function store(UploadedFile $file, string $directory): string
    // Validate MIME (jpeg/png/webp), max 2MB, lưu vào storage/app/public/uploads/{directory}
    // Trả về relative path

    public function delete(?string $path): void
    // Xóa file cũ nếu tồn tại
}
```

**`SettingHelper`** — global helper function:
```php
function setting(string $key, string $default = ''): string
// Đọc từ cache hoặc DB bảng site_settings theo key
```

---

## Data Models

### Bảng `services`

| Column | Type | Constraints | Ghi chú |
|---|---|---|---|
| id | bigint unsigned | PK, auto-increment | |
| title | varchar(255) | NOT NULL | |
| slug | varchar(255) | NOT NULL, UNIQUE | |
| summary | text | NOT NULL | Hiển thị trên listing |
| body | longtext | NULLABLE | Rich text cho detail page |
| icon | varchar(255) | NULLABLE | CSS class hoặc SVG name |
| image_path | varchar(255) | NULLABLE | Path ảnh upload |
| status | enum('draft','published') | NOT NULL, DEFAULT 'draft' | |
| sort_order | int | NOT NULL, DEFAULT 0 | Thứ tự hiển thị |
| created_at | timestamp | | |
| updated_at | timestamp | | |

### Bảng `news_posts`

| Column | Type | Constraints | Ghi chú |
|---|---|---|---|
| id | bigint unsigned | PK, auto-increment | |
| title | varchar(255) | NOT NULL | |
| slug | varchar(255) | NOT NULL, UNIQUE | |
| excerpt | text | NULLABLE | Tóm tắt hiển thị trên listing |
| body | longtext | NOT NULL | Rich text content |
| category_tag | varchar(100) | NULLABLE | Free-text label |
| featured_image_path | varchar(255) | NULLABLE | |
| status | enum('draft','published') | NOT NULL, DEFAULT 'draft' | |
| published_at | timestamp | NULLABLE | |
| created_at | timestamp | | |
| updated_at | timestamp | | |

Index: `(status, published_at DESC)` cho query listing public.

### Bảng `projects`

| Column | Type | Constraints | Ghi chú |
|---|---|---|---|
| id | bigint unsigned | PK, auto-increment | |
| title | varchar(255) | NOT NULL | |
| description | text | NULLABLE | Short description |
| image_path | varchar(255) | NOT NULL | Required per Req 15.7 |
| status | enum('draft','published') | NOT NULL, DEFAULT 'draft' | |
| created_at | timestamp | | |
| updated_at | timestamp | | |

### Bảng `contact_messages`

| Column | Type | Constraints | Ghi chú |
|---|---|---|---|
| id | bigint unsigned | PK, auto-increment | |
| name | varchar(255) | NOT NULL | |
| email | varchar(255) | NOT NULL | |
| subject | varchar(255) | NOT NULL | Bắt buộc — dùng chung cho cả 2 form |
| message | text | NOT NULL | |
| is_read | tinyint(1) | NOT NULL, DEFAULT 0 | |
| created_at | timestamp | | |
| updated_at | timestamp | | |

> Cả form trang Contact (`/contact`) và mini-form trang Home đều có đủ 4 fields: name, email, subject, message. Tất cả submissions đều lưu vào bảng này.

### Bảng `site_settings`

| Column | Type | Constraints | Ghi chú |
|---|---|---|---|
| id | bigint unsigned | PK, auto-increment | |
| key | varchar(100) | NOT NULL, UNIQUE | |
| value | text | NULLABLE | |
| created_at | timestamp | | |
| updated_at | timestamp | | |

**Danh sách keys chuẩn** (seed khi migrate):

| Key | Section | Loại |
|---|---|---|
| `hero_headline` | Hero | text |
| `hero_description` | Hero | text |
| `hero_bg_image` | Hero | image path |
| `about_image` | About Teaser | image path |
| `about_text` | About Teaser | textarea |
| `about_stat_label` | About Teaser | text |
| `about_stat_value` | About Teaser | text |
| `cta_heading` | CTA Banner | text |
| `cta_description` | CTA Banner | text |
| `contact_address` | Contact Info | text |
| `contact_email` | Contact Info | text |
| `contact_phone` | Contact Info | text |
| `footer_description` | Footer | textarea |
| `social_linkedin` | Footer | url |
| `social_facebook` | Footer | url |
| `social_youtube` | Footer | url |
| `about_page_content` | About Page | rich text |
| `company_name` | General | text |
| `company_logo` | General | image path |
| `meta_description_default` | SEO | text |

**Seeder data mặc định** (`database/seeders/SiteSettingSeeder.php`):

```php
[
    // General
    'company_name'           => 'Thành Nam TFC.,JSC',
    'company_logo'           => '',

    // Hero
    'hero_headline'          => 'Giải Pháp Nền Móng Chuyên Nghiệp',
    'hero_description'       => 'Chuyên thi công cọc bê tông, ép cọc, khoan cắt bê tông và các giải pháp nền móng chuyên dụng. Hơn 10 năm kinh nghiệm, uy tín và chất lượng hàng đầu.',
    'hero_bg_image'          => '',

    // About Teaser
    'about_image'            => '',
    'about_text'             => 'Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam (THANH NAM TFC.,JSC) được thành lập năm 2014, chuyên cung cấp các dịch vụ xây dựng nền móng chuyên dụng tại Hà Nội và các tỉnh lân cận. Với đội ngũ kỹ sư giàu kinh nghiệm và trang thiết bị hiện đại, chúng tôi cam kết mang lại giải pháp tối ưu cho mọi công trình.',
    'about_stat_label'       => 'Năm kinh nghiệm',
    'about_stat_value'       => '10+',

    // CTA Banner
    'cta_heading'            => 'Xây Dựng Nền Móng Vững Chắc Cùng Chúng Tôi',
    'cta_description'        => 'Liên hệ ngay để được tư vấn giải pháp nền móng phù hợp nhất cho công trình của bạn.',

    // Contact Info
    'contact_address'        => 'Số nhà 12 hẻm 3 ngách 33 số 2 phố Văn Trì, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội',
    'contact_email'          => 'thanhnambmtfc@gmail.com',
    'contact_phone'          => '',

    // Footer
    'footer_description'     => 'Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam — Chuyên ép cọc, khoan cắt bê tông, thi công cọc bê tông cốt thép, cọc dự ứng lực, cọc ly tâm.',
    'social_linkedin'        => '',
    'social_facebook'        => '',
    'social_youtube'         => '',

    // About Page
    'about_page_content'     => '<p>Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam (THANH NAM TFC.,JSC) được thành lập ngày 30/09/2014, hoạt động trong lĩnh vực xây dựng chuyên dụng.</p><p><strong>Ngành nghề chính:</strong> Khoan cắt bê tông, ép cọc, đóng cọc cừ larsen, thi công cọc bê tông cốt thép, cọc bê tông dự ứng lực, cọc ly tâm.</p><p><strong>Địa chỉ:</strong> Số nhà 12 hẻm 3 ngách 33 số 2 phố Văn Trì, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội, Việt Nam.</p><p><strong>Mã số thuế:</strong> 0201574928</p>',

    // SEO
    'meta_description_default' => 'Thành Nam TFC.,JSC — Chuyên ép cọc, khoan cắt bê tông, thi công cọc bê tông cốt thép tại Hà Nội. MST: 0201574928.',
]
```

### Bảng `users` (Laravel default)

Dùng bảng `users` mặc định của Laravel. Seed 1 admin user mặc định:

```php
// database/seeders/AdminUserSeeder.php
User::create([
    'name'     => 'Admin Thành Nam',
    'email'    => 'admin@thanhnambm.vn',
    'password' => Hash::make('Admin@2024!'), // đổi ngay sau khi deploy
]);
```

### Relationships

- Không có foreign key phức tạp — các model độc lập.
- `SiteSetting` là key-value store, không có relationship.

---

## Route Map

### Public Routes (`routes/web.php`)

```php
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{slug}', [ServiceController::class, 'show']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{slug}', [NewsController::class, 'show']);
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']); // dùng chung cho cả trang Contact và mini-form Home
```

### Admin Routes (`routes/web.php` — prefix `admin`, middleware `admin.auth`)

```php
// Auth (không cần middleware)
Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

// Protected
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/settings', [SettingController::class, 'index']);
    Route::post('/settings', [SettingController::class, 'update']);
    Route::resource('services', Admin\ServiceController::class);
    Route::resource('news', Admin\NewsController::class);
    Route::resource('projects', Admin\ProjectController::class);
    Route::resource('contact-messages', Admin\ContactMessageController::class)
         ->only(['index', 'show', 'destroy']);
});
```

---

## Blade Layout / Component Structure

### Public Layout Inheritance

```
layouts/public.blade.php
  ├── @section('meta')     ← title + description + OG tags
  └── @section('content')
        ├── <x-public.navbar />
        ├── [page content]
        └── <x-public.footer />
```

### Home Page Composition

```
public/home.blade.php @extends('layouts.public')
  ├── <x-public.hero :settings="$settings" />
  ├── <x-public.about-teaser :settings="$settings" />
  ├── <x-public.core-competencies :services="$services" />
  ├── <x-public.recent-projects :projects="$projects" />
  ├── <x-public.industry-insights :posts="$posts" />
  ├── <x-public.cta-banner :settings="$settings" />
  └── <x-public.contact-mini :settings="$settings" />
```

### Admin Layout Inheritance

```
layouts/admin.blade.php
  ├── <x-admin.sidebar :unreadCount="$unreadCount" />
  └── @section('content')
        ├── <x-admin.alert />
        └── [page content]
```

### SEO Meta Strategy

Mỗi public view override `@section('meta')`:
```blade
@section('meta')
  <title>{{ $title }} — {{ setting('company_name') }}</title>
  <meta name="description" content="{{ $description ?? setting('meta_description_default') }}">
  @isset($ogImage)
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset($ogImage) }}">
  @endisset
@endsection
```

---

## Key Design Decisions

1. **Không dùng Vue/React**: Toàn bộ rendering server-side với Blade. Form submit truyền thống.

2. **Form liên hệ dùng chung**: Mini-form trên Home và form trang Contact đều POST đến `POST /contact`, dùng chung `StoreContactRequest` (name, email, subject, message — tất cả required), lưu vào cùng bảng `contact_messages`. Sau submit thành công, redirect back với flash message.

3. **SiteSetting là key-value**: Đơn giản hơn nhiều bảng riêng lẻ. Cache bằng `Cache::remember` để tránh N+1 query trên mỗi request.

4. **SlugService tách biệt**: Tái sử dụng cho cả Services và News. Logic collision-safe với suffix `-{n}`.

5. **ImageService tập trung**: Validate + store + delete ở một chỗ, tránh lặp code trong nhiều controllers.

6. **Admin auth dùng Laravel built-in**: Dùng `Auth::attempt()` + session, không cần Sanctum/Passport. Middleware `admin.auth` đơn giản check `Auth::check()`.

7. **Không có Project detail page**: Chỉ có gallery grid trên Home.

8. **WYSIWYG cho News body**: Dùng TinyMCE CDN (free tier) — nhẹ, không cần npm build pipeline.

9. **Bootstrap 5 CDN cho admin**: Table, form, badge sẵn có. Public site dùng custom CSS.

10. **Pagination**: Dùng Laravel built-in `paginate(10)` cho News listing.

11. **Unread badge**: `ContactMessage::where('is_read', false)->count()` — inject vào admin layout qua View Composer.


---

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system — essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

---

### Property 1: SiteSetting Round-Trip

*For any* Site_Setting key-value pair that is saved via the Admin Settings form, rendering any public page that displays that setting must output the saved value.

**Validates: Requirements 1.6, 1.8, 1.16, 1.20, 1.22, 8.2**

---

### Property 2: Consistent Public Layout

*For any* public route (/, /about, /services, /news, /contact), the rendered HTML must contain both the navigation bar (with links to Home, About, Services, News, Contact) and the footer.

**Validates: Requirements 1.2, 1.21**

---

### Property 3: Core Competencies Count Bound

*For any* number of published Services (0, 1, 2, 3, or more), the Core Competencies section on the Home page must display exactly `min(count, 3)` service entries.

**Validates: Requirements 1.9, 1.10**

---

### Property 4: Recent Projects Display

*For any* set of published Projects, all published Projects must appear in the Recent Projects gallery on the Home page, ordered by `created_at` descending. When no published Projects exist, a placeholder message must be shown.

**Validates: Requirements 1.11, 1.12, 15.9**

---

### Property 5: Industry Insights Latest-3

*For any* set of published News_Posts, the Industry Insights section on the Home page must display exactly the 3 most recently published posts (or fewer if less than 3 exist). When none exist, a placeholder message must be shown.

**Validates: Requirements 1.13, 1.14**

---

### Property 6: Contact Form Submission Persistence

*For any* valid contact form submission (name, email, subject/optional, message all within constraints), a `Contact_Message` record must be created in the database with matching field values, and the response must indicate success.

**Validates: Requirements 1.18, 5.2**

---

### Property 7: Contact Form Validation Rejection

*For any* contact form submission containing at least one invalid field (empty required field, invalid email format, or field exceeding character limits), the system must reject the submission, return the form with inline validation errors, and create no `Contact_Message` record.

**Validates: Requirements 1.19, 5.3, 5.4, 5.5**

---

### Property 8: Admin Auth Middleware

*For any* HTTP request to an `/admin/*` route other than `/admin/login`, an unauthenticated request must be redirected to `/admin/login`, and an authenticated request must receive a non-redirect response.

**Validates: Requirements 6.4, 6.5**

---

### Property 9: Slug Format Validity

*For any* title string used to generate a slug (for Services or News_Posts), the resulting slug must match the regex `^[a-z0-9][a-z0-9-]*[a-z0-9]$` (or be a single alphanumeric character), containing only lowercase alphanumeric characters and hyphens, with no leading or trailing hyphens.

**Validates: Requirements 12.1, 12.2, 9.6, 10.7**

---

### Property 10: Slug Uniqueness with Collision Suffix

*For any* sequence of content records created with titles that would produce the same base slug, each record must receive a distinct slug — the first gets the base slug, subsequent ones get `-1`, `-2`, etc. appended.

**Validates: Requirements 12.4, 9.7**

---

### Property 11: Slug Round-Trip Resolution

*For any* published Service or News_Post, fetching the public URL `/services/{slug}` or `/news/{slug}` must return the correct record. For any slug that does not correspond to a published record, the response must be HTTP 404.

**Validates: Requirements 12.3, 3.4, 3.5, 4.4, 4.5**

---

### Property 12: News Listing Order

*For any* set of published News_Posts, the `/news` listing page must display them ordered by `published_at` descending.

**Validates: Requirements 4.2**

---

### Property 13: News Pagination

*For any* set of more than 10 published News_Posts, the first page of `/news` must contain exactly 10 items, and subsequent pages must contain the remaining items.

**Validates: Requirements 4.3**

---

### Property 14: Image Upload Validation

*For any* file upload attempt, files with MIME type other than `image/jpeg`, `image/png`, or `image/webp`, or files exceeding 2MB, must be rejected with a validation error and no file must be written to disk.

**Validates: Requirements 13.1, 13.2**

---

### Property 15: Image Storage and Replacement

*For any* valid image upload, the file must be stored under `storage/app/public/uploads/` and be accessible via the `/storage/` URL path. When an existing image is replaced, the previous file must no longer exist on disk after the update.

**Validates: Requirements 13.3, 13.4, 13.5**

---

### Property 16: CRUD Persistence

*For any* valid create or update form submission for Services, News_Posts, or Projects, the submitted field values must be persisted to the database and be retrievable with matching values. After a delete operation, the record must no longer exist in the database.

**Validates: Requirements 9.2, 9.4, 9.5, 10.2, 10.4, 10.5, 15.2, 15.4, 15.5, 11.4**

---

### Property 17: Mark-as-Read on View

*For any* `Contact_Message` with `is_read = false`, viewing it via the admin show page must set `is_read = true` in the database.

**Validates: Requirements 11.2**

---

### Property 18: Unread Count Accuracy

*For any* state of the `contact_messages` table, the unread count displayed in the admin navigation must equal the number of records where `is_read = false`.

**Validates: Requirements 11.5**

---

### Property 19: SEO Meta Tags Presence

*For any* public page, the rendered HTML must contain a `<title>` tag including the page/content title and the company name, and a `<meta name="description">` tag. For Service and News_Post detail pages, the HTML must additionally contain `og:title`, `og:description`, and `og:image` meta tags.

**Validates: Requirements 14.1, 14.2, 14.3**

---

### Property 20: Services Listing Completeness

*For any* set of published Services, the `/services` listing page must display all of them, each showing title, summary, and icon/image. When no Services exist, a placeholder message must be shown.

**Validates: Requirements 3.2, 3.3**

---

## Error Handling

### Validation Errors

- Tất cả form submissions dùng Laravel Form Request (`StoreContactRequest`, v.v.) với `validate()`.
- Lỗi validation được trả về qua `$errors` bag trong Blade — hiển thị inline bên cạnh field tương ứng.
- Không navigate away khi có lỗi — dùng `redirect()->back()->withErrors()->withInput()`.

### 404 Errors

- Các route `/services/{slug}` và `/news/{slug}` dùng `findOrFail()` hoặc `firstOrFail()` — Laravel tự động trả về 404 nếu không tìm thấy.
- Unpublished records: query thêm `where('status', 'published')` trước `firstOrFail()`.
- Custom 404 view tại `resources/views/errors/404.blade.php`.

### Image Upload Errors

- `ImageService::store()` throw `ValidationException` nếu MIME type không hợp lệ hoặc file > 2MB.
- Controller catch exception và redirect back với error message.
- File cũ không bị xóa nếu upload mới thất bại.

### Authentication Errors

- Login thất bại: trả về generic message "These credentials do not match our records." — không tiết lộ field nào sai.
- Session hết hạn: middleware redirect về `/admin/login` với message thông báo.

### Database Errors

- Không expose raw database errors ra ngoài.
- Production: `APP_DEBUG=false`, Laravel log errors vào `storage/logs/laravel.log`.

---

## Testing Strategy

### Dual Testing Approach

Dự án dùng cả **unit/feature tests** và **property-based tests** để đảm bảo coverage toàn diện.

### Unit & Feature Tests (PHPUnit)

Dùng Laravel's built-in PHPUnit test suite (`php artisan test`).

**Scope:**
- Feature tests cho từng HTTP route (public + admin) — kiểm tra status codes, redirects, view content.
- Unit tests cho `SlugService` và `ImageService` với các input cụ thể.
- Edge cases: empty database states, 404 responses, unauthenticated access.

**Ví dụ test cases:**
```php
// Feature test
public function test_home_page_returns_200() { ... }
public function test_admin_redirects_unauthenticated_to_login() { ... }
public function test_contact_form_stores_message() { ... }
public function test_news_slug_returns_404_for_unpublished() { ... }

// Unit test
public function test_slug_service_strips_special_chars() { ... }
public function test_image_service_rejects_non_image_mime() { ... }
```

**Tránh viết quá nhiều unit tests** — property-based tests sẽ cover các input variations.

### Property-Based Tests

Dùng thư viện **[Eris](https://github.com/giorgiosironi/eris)** (PHP property-based testing library) hoặc **[PHPCheck](https://github.com/fp4php/functional)**.

> Recommendation: Dùng **Eris** — mature, tích hợp tốt với PHPUnit, hỗ trợ generators cho strings, integers, arrays.

**Cấu hình:** Mỗi property test chạy tối thiểu **100 iterations**.

**Tag format cho mỗi test:**
```php
// Feature: corporate-cms, Property {N}: {property_text}
```

**Property test mapping:**

| Property | Test Class | Mô tả |
|---|---|---|
| Property 1 | `SiteSettingRoundTripTest` | Generate random key-value pairs, save, render, verify |
| Property 2 | `PublicLayoutConsistencyTest` | For all public routes, check navbar + footer present |
| Property 3 | `CoreCompetenciesCountTest` | Generate 0-10 services, verify min(count,3) shown |
| Property 4 | `RecentProjectsDisplayTest` | Generate random projects, verify all published shown |
| Property 5 | `IndustryInsightsLatest3Test` | Generate random news posts, verify latest 3 shown |
| Property 6 | `ContactFormPersistenceTest` | Generate valid form data, verify DB record created |
| Property 7 | `ContactFormValidationTest` | Generate invalid inputs, verify rejection + no DB record |
| Property 8 | `AdminAuthMiddlewareTest` | For all admin routes, verify auth enforcement |
| Property 9 | `SlugFormatTest` | Generate random titles, verify slug matches regex |
| Property 10 | `SlugUniquenessTest` | Generate duplicate titles, verify unique slugs with suffix |
| Property 11 | `SlugRoundTripTest` | Create record → get slug → fetch by slug → same record |
| Property 12 | `NewsListingOrderTest` | Generate random posts, verify descending order |
| Property 13 | `NewsPaginationTest` | Generate >10 posts, verify page 1 has exactly 10 |
| Property 14 | `ImageUploadValidationTest` | Generate invalid files, verify rejection |
| Property 15 | `ImageStorageTest` | Upload valid image, verify path + accessibility |
| Property 16 | `CrudPersistenceTest` | Generate valid CRUD data, verify DB state |
| Property 17 | `MarkAsReadTest` | View unread message, verify is_read = true |
| Property 18 | `UnreadCountAccuracyTest` | Generate random read/unread states, verify count |
| Property 19 | `SeoMetaTagsTest` | For all public pages, verify meta tags present |
| Property 20 | `ServicesListingTest` | Generate random services, verify all shown |

**Ví dụ property test với Eris:**
```php
// Feature: corporate-cms, Property 9: Slug format validity
public function testSlugFormatValidity()
{
    $this->forAll(
        Generator\string()
    )->then(function (string $title) {
        $slug = app(SlugService::class)->generate($title, Service::class);
        $this->assertMatchesRegularExpression('/^[a-z0-9][a-z0-9-]*[a-z0-9]$|^[a-z0-9]$/', $slug);
    });
}

// Feature: corporate-cms, Property 10: Slug uniqueness with collision suffix
public function testSlugUniquenessWithCollision()
{
    $this->forAll(
        Generator\string()->filter(fn($s) => strlen(trim($s)) > 0)
    )->then(function (string $title) {
        $slug1 = app(SlugService::class)->generate($title, Service::class);
        // Simulate first record exists
        Service::factory()->create(['slug' => $slug1]);
        $slug2 = app(SlugService::class)->generate($title, Service::class);
        $this->assertNotEquals($slug1, $slug2);
        $this->assertStringStartsWith($slug1, $slug2);
    });
}
```
