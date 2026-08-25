# 🚀 دليل تثبيت وتشغيل منصة آمر تم

## هيكل المشروع

```
📁 amrtm/
├── 📁 amrtm-laravel/          ← Backend (Laravel)
│   ├── app/Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── ServiceController.php
│   │   ├── RequestController.php
│   │   └── DashboardController.php
│   ├── app/Models/
│   │   ├── User.php
│   │   └── Models.php         ← Category, Entity, Service, ServiceRequest, Payment, RequestLog
│   ├── database/migrations/   ← 3 migration files
│   └── routes/api.php
│
├── 📁 frontend/               ← Frontend (HTML/CSS/JS)
│   ├── index.html
│   ├── amr_form.html
│   ├── amr_login.html
│   ├── amr_register.html
│   ├── amr_dashboard.html      (Admin)
│   ├── amr_dashboard_user.html (User)
│   └── amrtm-api.js           ← Shared API helper
```

---

## ⚙️ تثبيت Laravel

### الخطوة 1 — متطلبات النظام
```
PHP >= 8.2
Composer
MySQL >= 8.0
Node.js (optional for mix)
```

### الخطوة 2 — إنشاء مشروع Laravel
```bash
composer create-project laravel/laravel amrtm-backend
cd amrtm-backend
```

### الخطوة 3 — نسخ ملفاتنا
```bash
# انسخ الملفات التالية إلى مجلد مشروع Laravel:
cp -r amrtm-laravel/app/Http/Controllers/* app/Http/Controllers/
cp -r amrtm-laravel/app/Models/* app/Models/
cp -r amrtm-laravel/database/migrations/* database/migrations/
cp amrtm-laravel/routes/api.php routes/api.php
```

### الخطوة 4 — تثبيت Sanctum
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### الخطوة 5 — إعداد قاعدة البيانات
```bash
# في ملف .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=amrtm_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### الخطوة 6 — إنشاء قاعدة البيانات
```sql
CREATE DATABASE amrtm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### الخطوة 7 — تشغيل Migrations و Seeder
```bash
php artisan migrate
php artisan db:seed
```

### الخطوة 8 — إعداد Storage
```bash
php artisan storage:link
```

### الخطوة 9 — إعداد CORS
في ملف `config/cors.php`:
```php
'allowed_origins' => ['*'],  // في الإنتاج: ضع رابط موقعك فقط
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

### الخطوة 10 — تشغيل السيرفر
```bash
php artisan serve
# السيرفر يعمل على: http://localhost:8000
```

---

## 🔗 ربط الـ Frontend بالـ Backend

### في ملف `amrtm-api.js`، غير هذا السطر:
```javascript
// من:
const API_BASE = 'http://localhost:8000/api/v1';

// إلى رابط السيرفر الحقيقي:
const API_BASE = 'https://api.amrtm.com.sa/api/v1';
```

### أضف هذا السكريبت في كل صفحة HTML:
```html
<script src="amrtm-api.js"></script>
```

---

## 🔑 بيانات الدخول التجريبية

| النوع | البريد | كلمة المرور |
|-------|--------|-------------|
| Admin | admin@amrtm.com.sa | Admin@2025 |
| User  | user@amrtm.com.sa  | User@2025  |

---

## 📡 API Endpoints

### Authentication
```
POST /api/v1/register     ← تسجيل مستخدم جديد
POST /api/v1/login        ← تسجيل الدخول
POST /api/v1/logout       ← تسجيل الخروج (يحتاج token)
GET  /api/v1/profile      ← بيانات المستخدم الحالي
PUT  /api/v1/profile      ← تحديث البيانات
POST /api/v1/profile/avatar ← رفع صورة الملف الشخصي
```

### Services
```
GET  /api/v1/services          ← كل الفئات والخدمات
GET  /api/v1/entities/{id}     ← جهة محددة مع خدماتها
GET  /api/v1/services/{id}     ← خدمة محددة مع سعرها
```

### Requests
```
POST /api/v1/requests          ← تقديم طلب جديد
GET  /api/v1/requests          ← طلباتي
GET  /api/v1/requests/{id}     ← طلب محدد
```

### Payments
```
POST /api/v1/payments/charge   ← شحن رصيد
GET  /api/v1/payments/history  ← سجل المدفوعات
```

### Dashboard
```
GET  /api/v1/dashboard/user    ← إحصائيات المستخدم
GET  /api/v1/dashboard/admin   ← إحصائيات الأدمن
```

### Admin
```
GET  /api/v1/admin/requests              ← كل الطلبات
PUT  /api/v1/admin/requests/{id}/status  ← تحديث حالة طلب
PUT  /api/v1/admin/requests/{id}/time    ← تحديد وقت الإنجاز
PUT  /api/v1/admin/services/{id}/price   ← تحديث سعر خدمة
GET  /api/v1/admin/payments              ← كل المعاملات المالية
```

---

## 🗄️ هيكل قاعدة البيانات

```
users
  id, name, email, phone, password, role, avatar, balance

categories
  id, key, name_ar, name_en, icon, color, bg

entities
  id, category_id, name_ar, name_en, icon, color, tag_ar

services
  id, entity_id, name_ar, name_en, icon, price, estimated_days

service_requests
  id, ref_number, user_id, service_id, entity_id,
  client_name, client_email, client_phone, client_id_number,
  company_name, company_cr, notes, attachments (JSON),
  price, status, reject_reason, estimated_completion

request_logs
  id, request_id, user_id, status, note

payments
  id, user_id, request_id, amount, type, status
```

---

## 🌐 الاستضافة (Production)

### على Shared Hosting (cPanel):
1. ارفع مجلد `public` على `public_html`
2. ارفع باقي الملفات خارج `public_html`
3. عدّل `public/index.php` ليشير للـ bootstrap الصحيح

### على VPS (مع Nginx):
```nginx
server {
    listen 80;
    server_name api.amrtm.com.sa;
    root /var/www/amrtm-backend/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

---

## ✅ Checklist قبل الرفع

- [ ] تغيير `API_BASE` في `amrtm-api.js`
- [ ] تعديل `CORS` في Laravel للسماح بدومين الموقع فقط
- [ ] تغيير `APP_ENV=production` في `.env`
- [ ] تشغيل `php artisan config:cache`
- [ ] تشغيل `php artisan route:cache`
- [ ] ضبط صلاحيات مجلد `storage`
- [ ] ربط بوابة دفع حقيقية في `PaymentController`
