# AMRTM Project Rules — قواعد مشروع أمر تم

> قواعد صارمة لمساعد AI عند العمل على مشروع أمر تم (Laravel 12, PHP 8.2+, MySQL)

---

## 1. هوية المشروع

- **المشروع**: أمر تم — منصة سعودية لإدارة القاعات والخدمات والاستشارات
- **الإطار**: Laravel 12.x / PHP 8.2+ / MySQL
- **اللغة الافتراضية**: عربية (`ar`) — واجهات RTL
- **CSS**: كود CSS مكتوب يدويًا (ليس Tailwind Utility Classes) — استخدم Cairo font
- **JS**: Blade + Vanilla JS — لا Alpine.js ولا Livewire
- **Font**: `Cairo` (Google Fonts) — لا تستخدم خطوط أخرى

---

## 2. قواعد الكود البرمجي (PHP)

### 2.1 일반 القواعد
- استخدم **PHP 8.2** features: enums, match expressions, arrow functions, named arguments
- استخدم **Laravel Pint** بعد كل تعديل: `vendor/bin/pint`
- **لا комментарии** في الكود إلا إذا طُلب ذلك
- **لا تعديل أكواد مجاورة** — امسح ما أنشأته فقط (Surgical Modification)

### 2.2 Models
- **لا تستخدم `$casts` property** — استخدم method-based `casts()`:
  ```php
  protected function casts(): array {
      return [
          'status' => HallStatus::class,
          'is_active' => 'boolean',
      ];
  }
  ```
- **لا تستخدم `HasFactory`** إلا إذا كان الـ Factory موجود فعلاً
- حدد `$fillable` صراحةً لكل model
- العلاقات تستخدم return types: `public function owner(): BelongsTo`
- **لا تنشئ Model فارغ** — اربطه بـ migration موجودة

### 2.3 Controllers
- **لا Service Layer** — Controllers تستدعي Eloquent مباشرة
- **لا FormRequest** للعمليات البسيطة — استخدم `$request->validate()` مباشرة
- استخدم `compact()` لتمرير البيانات للـ views
- Auth guard: حدد الـ guard всегда: `Auth::guard('office')->user()`
- **لا تنشئ controllers فارغة** — اكتب المنطق الكامل في الملف الواحد
-_return types: `public function dashboard(): View`, `public function stats(): JsonResponse`

### 2.4 Database
- **3 اتصالات قاعدة بيانات** — استخدم الصحيح:
  | الاتصال | قاعدة البيانات | الاستخدام |
  |---------|---------------|-----------|
  | `mysql` (default) | amrtmco_project | القاعات، المستخدمون، الحجوزات |
  | `business` | amrtmco_business | المكاتب، الطلبات، التخصصات |
  | `job_listings` | amrtmco_jobs | الوظائف، الشركات، المتقدمون |
- Models في `app/Models/Business/` تستخدم `protected $connection = 'business'`
- **لا تنشئ migration فارغة** — تأكد من وجود الجدول أولاً عبر `php artisan migrate`

---

## 3. قواعد التوثيق والتحقق (Validation)

### 3.1 التحقق من المدخلات
```php
// ✅ صحيح — للعمليات البسيطة
$request->validate([
    'name_ar' => 'required|string|max:255',
    'phone' => 'required|string|max:20',
]);

// ✅ صحيح — للعمليات المعقدة (فقط في module Business)
class RegisterRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array { ... }
    public function messages(): array {
        return ['email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً.'];
    }
}
```

### 3.2 رسائل الخطأ
- استخدم رسائل عربية مخصصة في FormRequest: `messages()`
- لا تعتمد على رسائل Laravel الافتراضية بالإنجليزية

---

## 4. قواعد الواجهة (Frontend)

### 4.1 Layouts
- **Dashboards**: `@extends('layouts.dashboard')` مع `@section('sidebar-nav')`
- **الصفحات العامة**: مستقلة (standalone HTML) مع `@include('partials.public_nav')`
- **لا تنشئ layout جديدة** — استخدم `layouts/dashboard.blade.php` للوحة التحكم

### 4.2 CSS
- **لا تستخدم Tailwind Utility Classes** — المشروع يستخدم CSS مكتوب يدويًا
- أنماط CSS موجودة في `<style>` blocks داخل Blade templates
- استخدم المتغيرات CSS الموجودة:
  ```css
  :root { --navy: #163d28; --gold: #f59e0b; --danger: #dc2626; }
  ```
- استخدم Cairo font دائمًا: `font-family: 'Cairo', sans-serif`
- **RTL أولاً**: `<html lang="ar" dir="rtl">`

### 4.3 JavaScript
- **لا تستخدم Alpine.js أو Livewire** — استخدم Vanilla JS فقط
- تفاعلات AJAX: استخدم `fetch()` مع `X-CSRF-TOKEN`
- **لا تنشئ مكونات Vue جديدة** — المشروع يستخدم Blade فقط في الـ dashboards

### 4.4 الخطوط والعناصر
- Font Awesome 6.5 عبر CDN
- أيقونات: `fas fa-*` أو `fab fa-*`
- لا تستخدم Tabler Icons إلا في صفحات business services

---

## 5. قواعد i18n والترجمة

### 5.1 إدارة اللغات
- **العربية هي اللغة الافتراضية** — كل النصوص بالعربية أولاً
- استخدم `__()` helper للنصوص: `{{ __('home.hero_title') }}`
- ملفات الترجمة في `lang/ar/` و `lang/en/`
- **لا تنشئ ملفات ترجمة جديدة** إلا إذا كان النص معقدًا

### 5.2 RTL
- **جميع الواجهات RTL** — لا يوجد استثناء
- `<html lang="ar" dir="rtl">`
- الـ Switch/Toggle: استخدم `direction:ltr` دائماً:
  ```html
  <input type="checkbox" style="direction: ltr;">
  ```
- حقول الأرقام: استخدم `dir="ltr"` دائماً

---

## 6. قواعد الملفات والتخزين

### 6.1 رفع الملفات
- استخدم `Storage::disk('public')->put(...)` لرفع الملفات
- مسار التخزين: `storage/app/public/`
- **لا تستخدم `public_path()`** — استخدم `asset()` للروابط

### 6.2 الصور
- للصور المavityية: استخدم `route('public.storage', ['path' => ...])`
- للصور الثابتة: `asset('images/...')`
- **لا تنشئ مجلدات جديدة** في `public/` — استخدم `storage/`

---

## 7. قواعد الأمان

### 7.1 Authentication
- **4 auth guards** — حدد الصحيح:
  | Guard | الاستخدام |
  |-------|----------|
  | `web` | المستخدمون العاديون (Owner, Partner, etc.) |
  | `business` | المشرفون والمسؤولون |
  | `office` | المستخدمون في المكاتب |
  | `jobs` | المتقدمون للوظائف |
- **لا تستخدم `Auth::user()` بدون guard** — حدد دائماً: `Auth::guard('office')->user()`

### 7.2 Authorization
- **لا تستخدم Policies/Gate** — استخدم `abort_if()` مباشرة:
  ```php
  abort_if($hall->status !== HallStatus::Active, 404);
  ```
- التحقق من الأدوار: `if ($user->role === UserRole::Supervisor)`

### 7.3 CSRF
- كل POST/PUT/DELETE يحتاج `@csrf` و `@method`
- AJAX: أضف `X-CSRF-TOKEN` header

---

## 8. قواعد الإشعارات (Toast Notifications)

> **الإشعارات يجب أن تعكس الواقع الفعلي — لا إشعارات نجاح مزيفة!**

### قواعد الاستخدام
| الدالة | متى تُستخدم |
|--------|-------------|
| `toast.success()` | **فقط** بعد استلام رد ناجح (200, 201) من السيرفر |
| `toast.error()` | عند فشل الاتصال أو رد خاطئ (400, 401, 500) |
| `toast.loading()` | أثناء انتظار رد السيرفر |

### ممنوعات
- ❌ `toast.success()` قبل استلام رد السيرفر
- ❌ `toast.success()` في كتلة catch
- ❌ `toast.success('تم الحفظ')` إذا كان الـ API mock

### ✓ صحيح
```javascript
// بعد استلام رد ناجح
fetch('/api/save', { method: 'POST', body: data })
    .then(res => { if(res.ok) toast.success('تم الحفظ بنجاح'); })
    .catch(() => toast.error('حدث خطأ في الاتصال'));
```

---

## 9. قواعد الاستجابة (Responsive)

- **Dialogs & Modals**: استخدم `max-h-[85vh]` مع `overflow-y-auto`
- **Tables**: استخدم `overflow-x-auto` للتمرير الأفقي
- **Mobile**: breakpoints عند `768px` و `480px`
- **Sidebar**: قابل للطي على الجوال مع toggle button

---

## 10. قواعد الاختبار

- **PHPUnit 11** مع `RefreshDatabase` trait
- SQLite in-memory للاختبارات
- قم بتشغيل الاختبارات بعد التعديل: `php artisan test`
- **لا تنشئ اختبارات جديدة** إلا إذا طُلب ذلك

---

## 11. أوامر شائعة

```bash
# بعد كل تعديل
vendor/bin/pint                          # تنسيق الكود

# قاعدة البيانات
php artisan migrate                      # تشغيل الترحيلات
php artisan migrate:fresh --seed         # إعادة إنشاء قاعدة البيانات

# الخادم
php artisan serve                        # تشغيل الخادم المحلي

# الاختبارات
php artisan test                         # تشغيل جميع الاختبارات

# بناء الأصول
npm run build                            # بنء Vite
npm run dev                              # وضع التطوير
```

---

## 12. قواعد حماية الكود

| القاعدة | الشرح |
|---------|-------|
| **Touch only what's needed** | لا تحسن تنسيق كود مجاور |
| **Match existing style** | التزم بأسلوب الكود الحالي تمامًا |
| **Clean your orphans** | إذا سبب تعديلك import يتيماً → أزله |
| **No fake success** | لا اقتراح UI متفائل وهمي |
| **No unconfirmed status** | لا تحديث Status بدون تأكيد API |
| **Real roles only** | الأدوار حقيقية: Admin ≠ Employee ≠ Client |
| **No scope creep** | لا توسيع صلاحيات "للراحة" |
| **Ask before creating** | لا تنشئ ملفات جديدة بدون سؤال المستخدم |

---

## 13. بروتوكول التعديل الجراحي

1. **افهم الكود المحيط** قبل التعديل
2. **تطابق الأسلوب** — نفس المتغيرات، نفس الطريقة، نفس التسمية
3. **لا تلمس** ملفات لم تطلب تعديلها
4. **نظف أثرك** — إذا أضفت import وأزلت الاستخدام، احذف الـ import
5. **تأكد من العمل** — شغّل `php artisan serve` وتحقق من عدم وجود أخطاء

---

## 14. معلومات تقنية سريعة

| العنصر | القيمة |
|--------|--------|
| Laravel | 12.x |
| PHP | 8.2+ |
| MySQL | 8.0+ |
| Vue | 3.x (موجود لكن لا يُستخدم في dashboards) |
| Tailwind | 4.x (موجود لكن لا يُستخدم في public pages) |
| Build Tool | Vite 7 |
| QR Code | BaconQrCode |
| Email | Resend API |
| Font | Cairo (Google Fonts) |
| Icons | Font Awesome 6.5 |
| CSS Framework | لا يوجد (Hand-written CSS) |
| JS Framework | لا يوجد (Vanilla JS) |
