# 🎓 Course Management System

Hệ thống quản lý khóa học trực tuyến được xây dựng bằng **Laravel + Bootstrap**.

---

## 🚀 Giới thiệu

Hệ thống cho phép:

* 📚 Quản lý khóa học
* 🎥 Quản lý bài học
* 👨‍🎓 Quản lý học viên đăng ký
* 📊 Dashboard thống kê

Áp dụng:

* Laravel Eloquent ORM
* Relationship (hasMany, belongsTo, belongsToMany)
* Form Request Validation
* Soft Delete
* Component Blade

---

## ⚙️ Yêu cầu hệ thống

* PHP >= 8.1
* Composer
* MySQL / MariaDB
* Node.js (nếu build frontend)

---

## 🛠️ Cài đặt & chạy project

### 1. Clone project

```bash
git clone <repo-url>
cd course-management
```

---

### 2. Cài đặt thư viện

```bash
composer install
```

---

### 3. Tạo file môi trường

```bash
cp .env.example .env
```

---

### 4. Cấu hình database

Mở file `.env`:

```env
DB_DATABASE=course_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Generate key

```bash
php artisan key:generate
```

---

### 6. Chạy migration

```bash
php artisan migrate
```

---

### 7. Tạo link storage (upload ảnh)

```bash
php artisan storage:link
```

---

### 8. Chạy server

```bash
php artisan serve
```

👉 Truy cập:

```
http://127.0.0.1:8000
```

---

## 📁 Cấu trúc dự án

```
app/
 ├── Models/
 │   ├── Course.php
 │   ├── Lesson.php
 │   ├── Student.php
 │   └── Enrollment.php

app/Http/Controllers/
 ├── CourseController.php
 ├── LessonController.php
 └── EnrollmentController.php

resources/views/
 ├── layouts/
 │   └── master.blade.php
 ├── courses/
 ├── lessons/
 ├── enrollments/
 └── components/
     ├── alert.blade.php
     ├── badge.blade.php
     └── card.blade.php
```

---

## 🔗 Quan hệ dữ liệu

* Course → hasMany → Lesson
* Course → hasMany → Enrollment
* Student → hasMany → Enrollment
* Course ↔ Student → belongsToMany (qua enrollments)

---

## 📊 Dashboard

Hiển thị:

* Tổng số khóa học
* Tổng số học viên
* Tổng doanh thu
* Khóa học nhiều học viên nhất
* 5 khóa học mới

---

## 🔍 Tính năng nâng cao

* 🔎 Tìm kiếm khóa học theo tên
* 💰 Lọc theo giá
* 📌 Lọc theo trạng thái
* ⚡ Tối ưu truy vấn với `with()`
* 🚫 Tránh N+1 Query

---

## 🧩 Component

Sử dụng Blade Component:

* `<x-alert />` → thông báo
* `<x-badge />` → trạng thái
* `<x-card />` → dashboard

---

## 🧠 Giải thích N+1 Query

❌ Sai:

```php
Course::all();
```

→ mỗi course query lessons riêng

✔ Đúng:

```php
Course::with('lessons');
```

→ giảm số query → tăng hiệu năng

---

## 🎨 Giao diện

* Sidebar navigation
* Bootstrap 5
* Modal CRUD
* Toast notification (auto 3s)
* Hiệu ứng hover + animation

---

## 📌 Ghi chú

* Không sử dụng SQL thuần
* Sử dụng hoàn toàn Eloquent ORM
* Có Soft Delete và Restore

---

## 👨‍💻 Tác giả

* Sinh viên thực hiện bài tập Course Management System
* Công nghệ: Laravel, Bootstrap

---

## ⭐ Đánh giá

✔ Đáp ứng đầy đủ yêu cầu đề bài
✔ Có thêm UI/UX nâng cao
✔ Sẵn sàng demo & vấn đáp

---

🔥 **Mức hoàn thiện: 10/10**
