# دليل نشر المشروع على الاستضافة والدومين 🚀

## نظرة عامة
هذا الدليل يوضح كيفية رفع مشروعك على استضافة ويب ودومين.

## أنواع الاستضافة المتاحة

### 1. 🌐 الاستضافة المشتركة (Shared Hosting)
**مثال:** cPanel, Plesk, DirectAdmin
- **مناسبة لـ:** PHP, HTML/CSS/JS
- **السعر:** 5-20$ شهرياً
- **المميزات:** سهولة الاستخدام، دعم فني

### 2. ☁️ الاستضافة السحابية (Cloud Hosting)
**مثال:** AWS, Google Cloud, DigitalOcean
- **مناسبة لـ:** جميع التقنيات
- **السعر:** 10-100$ شهرياً
- **المميزات:** مرونة عالية، أداء ممتاز

### 3. 🐳 استضافة Docker
**مثال:** Railway, Render, Heroku
- **مناسبة لـ:** تطبيقات Docker
- **السعر:** 5-50$ شهرياً
- **المميزات:** نشر سريع، إدارة سهلة

## خطوات النشر

### الخطوة 1: اختيار الاستضافة

#### للاستضافة المشتركة (PHP):
1. **Namecheap** - https://www.namecheap.com/
2. **Hostinger** - https://www.hostinger.com/
3. **Bluehost** - https://www.bluehost.com/

#### للاستضافة السحابية:
1. **DigitalOcean** - https://www.digitalocean.com/
2. **AWS** - https://aws.amazon.com/
3. **Google Cloud** - https://cloud.google.com/

#### لاستضافة Docker:
1. **Railway** - https://railway.app/
2. **Render** - https://render.com/
3. **Heroku** - https://heroku.com/

### الخطوة 2: شراء الدومين

#### مواقع شراء الدومين:
1. **Namecheap** - أسعار مناسبة
2. **GoDaddy** - عروض كثيرة
3. **Google Domains** - بسيط وسهل

#### نصائح اختيار الدومين:
- اختر اسم قصير وسهل التذكر
- تجنب الأرقام والشرطات
- استخدم نطاق .com أو .net
- تأكد من عدم وجود علامات تجارية

### الخطوة 3: إعداد قاعدة البيانات

#### للاستضافة المشتركة:
```sql
-- إنشاء قاعدة البيانات
CREATE DATABASE your_domain_db;

-- إنشاء مستخدم
CREATE USER 'your_user'@'localhost' IDENTIFIED BY 'strong_password';

-- منح الصلاحيات
GRANT ALL PRIVILEGES ON your_domain_db.* TO 'your_user'@'localhost';
FLUSH PRIVILEGES;
```

#### للاستضافة السحابية:
- استخدم خدمات قاعدة البيانات المدارة
- AWS RDS, Google Cloud SQL, DigitalOcean Managed Databases

### الخطوة 4: رفع الملفات

#### للاستضافة المشتركة:
1. استخدم File Manager في cPanel
2. أو استخدم FTP/SFTP
3. ارفع ملفات `src/php/` إلى `public_html/`

#### للاستضافة السحابية:
1. استخدم Git للرفع
2. أو استخدم SCP/SFTP
3. أو استخدم أدوات النشر التلقائي

### الخطوة 5: إعداد النطاق

#### ربط الدومين بالاستضافة:
1. غيّر DNS records في موقع شراء الدومين
2. أضف A record يشير إلى IP الاستضافة
3. أضف CNAME record للـ www

#### مثال DNS Records:
```
Type    Name    Value
A       @       192.168.1.1
CNAME   www     yourdomain.com
```

## ملفات النشر الجاهزة

### 1. ملف .htaccess للاستضافة المشتركة
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

# حماية الملفات الحساسة
<Files "config.php">
    Order allow,deny
    Deny from all
</Files>

# تفعيل Gzip
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
```

### 2. ملف إعداد قاعدة البيانات للإنتاج
```php
<?php
// config/production.php
return [
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'name' => $_ENV['DB_NAME'] ?? 'your_domain_db',
        'user' => $_ENV['DB_USER'] ?? 'your_user',
        'pass' => $_ENV['DB_PASS'] ?? 'your_password',
        'charset' => 'utf8mb4'
    ],
    'app' => [
        'url' => 'https://yourdomain.com',
        'name' => 'اسم موقعك',
        'debug' => false,
        'timezone' => 'Asia/Riyadh'
    ]
];
```

### 3. ملف .env للإنتاج
```env
# Production Environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_HOST=localhost
DB_NAME=your_domain_db
DB_USER=your_user
DB_PASS=your_strong_password

# Security
APP_KEY=your-secret-key-here
SESSION_SECURE=true
```

## نصائح الأمان للإنتاج

### 1. حماية قاعدة البيانات
- استخدم كلمات مرور قوية
- قلل صلاحيات المستخدم
- احتفظ بنسخ احتياطية

### 2. حماية الملفات
- احمِ ملفات التكوين
- استخدم HTTPS
- فعّل جدار الحماية

### 3. مراقبة الأداء
- استخدم أدوات المراقبة
- راقب استهلاك الموارد
- احتفظ بسجلات الأخطاء

## خطوات ما بعد النشر

### 1. اختبار الموقع
- تأكد من عمل جميع الصفحات
- اختبر النماذج والوظائف
- تحقق من الأمان

### 2. تحسين الأداء
- فعّل الكاش
- اضغط الصور
- استخدم CDN

### 3. النسخ الاحتياطية
- أضف نسخ احتياطية تلقائية
- احتفظ بنسخ من قاعدة البيانات
- اختبر استعادة النسخ

## استكشاف المشاكل

### مشاكل شائعة:
1. **خطأ 500** - تحقق من ملفات .htaccess
2. **خطأ قاعدة البيانات** - تحقق من بيانات الاتصال
3. **خطأ SSL** - تأكد من شهادة SSL
4. **بطء الموقع** - تحقق من استهلاك الموارد

### أدوات المساعدة:
- **GTmetrix** - لتحليل الأداء
- **Google PageSpeed** - لتحسين السرعة
- **SSL Labs** - لفحص الأمان

## التكلفة التقريبية

### الاستضافة المشتركة:
- الدومين: 10-15$ سنوياً
- الاستضافة: 5-20$ شهرياً
- **المجموع:** 70-255$ سنوياً

### الاستضافة السحابية:
- الدومين: 10-15$ سنوياً
- الاستضافة: 10-100$ شهرياً
- **المجموع:** 130-1215$ سنوياً

### استضافة Docker:
- الدومين: 10-15$ سنوياً
- الاستضافة: 5-50$ شهرياً
- **المجموع:** 70-615$ سنوياً

## الخلاصة

1. **اختر الاستضافة** المناسبة لميزانيتك واحتياجاتك
2. **اشترِ دومين** قصير وسهل التذكر
3. **أعد قاعدة البيانات** بشكل آمن
4. **ارفع الملفات** باستخدام الطريقة المناسبة
5. **اختبر الموقع** قبل الإطلاق
6. **حافظ على الأمان** والأداء

**🎉 تهانينا! موقعك جاهز للعالم!** 