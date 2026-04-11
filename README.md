# Website Công ty Thành Nam TFC

Website giới thiệu công ty và hệ thống quản lý nội dung (CMS) cho **Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam**.

---

## Giới thiệu công ty

| Thông tin | Chi tiết |
|---|---|
| **Tên công ty** | Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam |
| **Tên quốc tế** | Thanh Nam Trading Foundation Construction Joint Stock Company |
| **Tên viết tắt** | THANH NAM TFC.,JSC |
| **Mã số thuế** | 0201574928 |
| **Địa chỉ** | Số nhà 12 hẻm 3 ngách 33 số 2 phố Văn Trì, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội, Việt Nam |
| **Người đại diện** | Trịnh Viết Dũng |
| **Ngày hoạt động** | 30/09/2014 |
| **Loại hình** | Công ty cổ phần ngoài nhà nước |
| **Tình trạng** | Đang hoạt động |
| **Ngành nghề chính** | Hoạt động xây dựng chuyên dụng — Khoan cắt bê tông, ép cọc, đóng cọc cừ, larsen, thi công cọc bê tông cốt thép, cọc bê tông dự ứng lực, cọc ly tâm |

---

## Về dự án

Dự án xây dựng website công ty kết hợp hệ thống CMS nội bộ, cho phép quản trị viên cập nhật toàn bộ nội dung mà không cần can thiệp code.

**Tính năng chính:**

- Trang công khai: Home, Giới thiệu, Dịch vụ, Tin tức, Liên hệ
- Admin CMS: Quản lý Dịch vụ, Tin tức, Dự án, Tin nhắn liên hệ, Cài đặt website
- Hệ thống cài đặt nội dung tĩnh (hero, footer, thông tin công ty)

---

## Tech Stack

- **Backend:** Laravel 11 (PHP)
- **Frontend:** Blade Templates
- **Database:** MySQL
- **CSS:** Bootstrap 5
- **WYSIWYG:** TinyMCE

---

## Cài đặt

```bash
# Clone repo
git clone <repo-url>
cd <project-folder>

# Cài dependencies
composer install

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Cấu hình database trong .env, sau đó chạy migration
php artisan migrate --seed

# Tạo symlink storage
php artisan storage:link

# Khởi động server
php artisan serve
```

Truy cập admin tại `/admin/login`.

---

## Cấu trúc thư mục chính

```
app/Http/Controllers/
├── Public/     # Controllers trang công khai
└── Admin/      # Controllers CMS admin

resources/views/
├── layouts/    # Layout chung (public + admin)
├── components/ # Blade components tái sử dụng
├── public/     # Views trang công khai
└── admin/      # Views trang admin
```

---

## License

Dự án nội bộ — © 2026 Thanh Nam TFC.,JSC. All rights reserved.
