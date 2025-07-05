# دليل PHP - مساحة عمل التطوير

## نظرة عامة
هذا الدليل يشرح كيفية استخدام بيئة PHP في مساحة العمل.

## المتطلبات
- PHP 7.4 أو أحدث
- MySQL 5.7 أو أحدث
- Apache/Nginx (اختياري)
- Composer (لإدارة التبعيات)

## البنية

```
src/php/
├── index.php              # نقطة الدخول الرئيسية
├── config/                # ملفات الإعدادات
│   ├── config.php         # الإعدادات العامة
│   └── database.php       # إعدادات قاعدة البيانات
├── includes/              # الملفات المشتركة
│   ├── functions.php      # الدوال المساعدة
│   ├── header.php         # الهيدر المشترك
│   └── footer.php         # الفوتر المشترك
├── pages/                 # صفحات التطبيق
│   └── home.php           # الصفحة الرئيسية
├── api/                   # واجهات API
├── classes/               # الكلاسات
└── .htaccess              # إعدادات Apache
```

## البدء السريع

### 1. تشغيل الخادم
```bash
# الطريقة الأولى: استخدام PHP المدمج
cd src/php
php -S localhost:8000

# الطريقة الثانية: استخدام ملف التشغيل
start-php.bat
```

### 2. إعداد قاعدة البيانات
1. أنشئ قاعدة بيانات جديدة باسم `dev_workspace`
2. عدّل إعدادات الاتصال في `config/database.php`
3. الجداول ستُنشأ تلقائياً عند أول تشغيل

### 3. الوصول للتطبيق
افتح المتصفح واذهب إلى: `http://localhost:8000`

## الميزات المتاحة

### 1. نظام المستخدمين
- تسجيل دخول آمن
- إدارة الجلسات
- تشفير كلمات المرور
- نظام الصلاحيات

### 2. قاعدة البيانات
- اتصال PDO آمن
- حماية من SQL Injection
- دوال مساعدة للاستعلامات
- إنشاء الجداول تلقائياً

### 3. API RESTful
- واجهات برمجة تطبيقات جاهزة
- استجابات JSON
- إدارة الأخطاء
- توثيق API

### 4. الأمان
- تنظيف المدخلات
- حماية من XSS
- إدارة الجلسات الآمنة
- تشفير البيانات الحساسة

## استخدام الدوال المساعدة

### تنظيف المدخلات
```php
$clean_input = sanitize($_POST['user_input']);
```

### التحقق من البريد الإلكتروني
```php
if (isValidEmail($email)) {
    // البريد صحيح
}
```

### تشفير كلمة المرور
```php
$hashed_password = hashPassword($password);
```

### التحقق من كلمة المرور
```php
if (verifyPassword($password, $hash)) {
    // كلمة المرور صحيحة
}
```

### إرجاع استجابة JSON
```php
successResponse($data, 'تم الحفظ بنجاح');
errorResponse('حدث خطأ', 400);
```

### رفع ملف
```php
$filename = uploadFile($_FILES['file'], 'uploads/');
if ($filename) {
    // تم رفع الملف بنجاح
}
```

## إدارة قاعدة البيانات

### إدراج بيانات
```php
$data = [
    'username' => 'user1',
    'email' => 'user1@example.com',
    'password' => hashPassword('password123')
];

$id = $db->insert('users', $data);
```

### جلب بيانات
```php
// جلب صف واحد
$user = $db->fetchOne("SELECT * FROM users WHERE id = :id", ['id' => 1]);

// جلب جميع الصفوف
$users = $db->fetchAll("SELECT * FROM users WHERE status = :status", ['status' => 'active']);
```

### تحديث بيانات
```php
$data = ['status' => 'inactive'];
$affected = $db->update('users', $data, 'id = :id', ['id' => 1]);
```

### حذف بيانات
```php
$affected = $db->delete('users', 'id = :id', ['id' => 1]);
```

## إنشاء API

### مثال API للمستخدمين
```php
// api/users.php
<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $users = $db->fetchAll("SELECT id, username, email FROM users");
        successResponse($users);
        break;
        
    case 'POST':
        $data = [
            'username' => sanitize(post('username')),
            'email' => sanitize(post('email')),
            'password' => hashPassword(post('password'))
        ];
        
        $id = $db->insert('users', $data);
        if ($id) {
            successResponse(['id' => $id], 'تم إنشاء المستخدم بنجاح');
        } else {
            errorResponse('فشل في إنشاء المستخدم');
        }
        break;
}
?>
```

## إدارة الجلسات

### تسجيل الدخول
```php
$user = $db->fetchOne("SELECT * FROM users WHERE username = :username", ['username' => $username]);

if ($user && verifyPassword($password, $user['password'])) {
    login($user);
    redirect('dashboard');
} else {
    errorResponse('بيانات غير صحيحة');
}
```

### التحقق من تسجيل الدخول
```php
if (isLoggedIn()) {
    $current_user = getCurrentUser();
    // المستخدم مسجل دخول
}
```

### تسجيل الخروج
```php
logout();
redirect('login');
```

## إدارة الأخطاء

### تسجيل الأخطاء
```php
try {
    // كود قد يسبب خطأ
} catch (Exception $e) {
    logError('حدث خطأ في العملية', [
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}
```

### عرض الأخطاء في التطوير
```php
if (DEBUG_MODE) {
    debug($variable);
}
```

## أفضل الممارسات

### 1. الأمان
- استخدم دوال `sanitize()` دائماً للمدخلات
- شفر كلمات المرور بـ `hashPassword()`
- تحقق من الصلاحيات قبل العمليات الحساسة
- استخدم HTTPS في الإنتاج

### 2. الأداء
- استخدم الاستعلامات المُحضرة
- قلل عدد الاستعلامات
- استخدم الكاش عند الحاجة
- ضغط الملفات الثابتة

### 3. الكود
- اتبع معايير PSR
- اكتب تعليقات واضحة
- قسم الكود إلى وحدات منطقية
- استخدم أسماء واضحة للمتغيرات والدوال

### 4. قاعدة البيانات
- استخدم الفهارس للعمود المطلوب البحث فيه
- تجنب الاستعلامات المُعقدة
- استخدم العلاقات بدلاً من JOIN المُعقد
- احذف البيانات غير المستخدمة

## استكشاف الأخطاء

### مشاكل شائعة

1. **خطأ في الاتصال بقاعدة البيانات**
   - تحقق من إعدادات الاتصال
   - تأكد من تشغيل MySQL
   - تحقق من اسم قاعدة البيانات

2. **خطأ في الصلاحيات**
   - تحقق من صلاحيات المجلدات
   - تأكد من إمكانية الكتابة في مجلد uploads

3. **خطأ في الجلسات**
   - تحقق من إعدادات PHP
   - تأكد من تفعيل mod_rewrite

### أدوات التطوير
- استخدم `debug()` لعرض المتغيرات
- راجع ملفات السجل في مجلد logs
- استخدم أدوات المطور في المتصفح

## الخطوات التالية

1. **تعلم إطار عمل**
   - Laravel (قوي ومتكامل)
   - Symfony (مؤسسي)
   - CodeIgniter (خفيف وسريع)

2. **تعلم Composer**
   - إدارة التبعيات
   - Autoloading
   - Packages

3. **تعلم اختبار الكود**
   - PHPUnit
   - Codeception
   - Pest

4. **تعلم DevOps**
   - Docker
   - CI/CD
   - Deployment

## الموارد المفيدة

- [PHP Manual](https://www.php.net/manual/)
- [Laravel Documentation](https://laravel.com/docs)
- [PHP The Right Way](https://phptherightway.com/)
- [PHPUnit Documentation](https://phpunit.de/)
- [Composer Documentation](https://getcomposer.org/doc/) 