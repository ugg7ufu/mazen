<?php
/**
 * ملف إعدادات الإنتاج
 * Production Configuration File
 */

// منع الوصول المباشر
if (!defined('SECURE_ACCESS')) {
    die('الوصول المباشر ممنوع');
}

// إعدادات قاعدة البيانات للإنتاج
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_domain_db'); // غيّر هذا لاسم قاعدة البيانات الخاصة بك
define('DB_USER', 'your_db_user');   // غيّر هذا لاسم المستخدم
define('DB_PASS', 'your_db_password'); // غيّر هذا لكلمة المرور
define('DB_CHARSET', 'utf8mb4');

// إعدادات التطبيق
define('APP_NAME', 'اسم موقعك');
define('APP_URL', 'https://yourdomain.com'); // غيّر هذا لرابط موقعك
define('APP_VERSION', '1.0.0');
define('APP_DEBUG', false); // إيقاف وضع التطوير في الإنتاج

// إعدادات الأمان
define('SECRET_KEY', 'your-secret-key-here-change-this'); // غيّر هذا لمفتاح سري قوي
define('SESSION_SECURE', true);
define('SESSION_HTTP_ONLY', true);
define('SESSION_SAME_SITE', 'Strict');

// إعدادات البريد الإلكتروني
define('MAIL_HOST', 'smtp.yourdomain.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'noreply@yourdomain.com');
define('MAIL_PASSWORD', 'your-mail-password');
define('MAIL_ENCRYPTION', 'tls');
define('MAIL_FROM_NAME', APP_NAME);

// إعدادات الملفات
define('UPLOAD_PATH', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']);

// إعدادات الكاش
define('CACHE_ENABLED', true);
define('CACHE_PATH', __DIR__ . '/cache/');
define('CACHE_TIME', 3600); // ساعة واحدة

// إعدادات المنطقة الزمنية
date_default_timezone_set('Asia/Riyadh');

// إعدادات اللغة
define('DEFAULT_LANG', 'ar');
define('SUPPORTED_LANGS', ['ar', 'en']);

// إعدادات API
define('API_VERSION', 'v1');
define('API_RATE_LIMIT', 100); // 100 طلب في الساعة
define('API_KEY_REQUIRED', true);

// إعدادات النسخ الاحتياطية
define('BACKUP_ENABLED', true);
define('BACKUP_PATH', __DIR__ . '/backups/');
define('BACKUP_RETENTION', 30); // الاحتفاظ بـ 30 نسخة

// إعدادات المراقبة
define('LOG_ENABLED', true);
define('LOG_PATH', __DIR__ . '/logs/');
define('LOG_LEVEL', 'ERROR'); // ERROR, WARNING, INFO, DEBUG

// إعدادات CDN (اختياري)
define('CDN_ENABLED', false);
define('CDN_URL', 'https://cdn.yourdomain.com');

// إعدادات Redis (إذا كان متاحاً)
define('REDIS_ENABLED', false);
define('REDIS_HOST', 'localhost');
define('REDIS_PORT', 6379);
define('REDIS_PASSWORD', '');

// إعدادات Google Analytics
define('GA_TRACKING_ID', ''); // أضف معرف Google Analytics هنا

// إعدادات reCAPTCHA
define('RECAPTCHA_ENABLED', false);
define('RECAPTCHA_SITE_KEY', '');
define('RECAPTCHA_SECRET_KEY', '');

// إعدادات الدفع (إذا كان مطلوباً)
define('PAYMENT_ENABLED', false);
define('STRIPE_PUBLIC_KEY', '');
define('STRIPE_SECRET_KEY', '');

// دالة للتحقق من البيئة
function isProduction() {
    return !APP_DEBUG;
}

// دالة للحصول على رابط كامل
function getFullUrl($path = '') {
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

// دالة لتسجيل الأخطاء
function logError($message, $context = []) {
    if (LOG_ENABLED) {
        $logFile = LOG_PATH . 'error-' . date('Y-m-d') . '.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] ERROR: $message " . json_encode($context) . PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }
}

// دالة لتنظيف المدخلات
function sanitizeInput($input) {
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// دالة للتحقق من CSRF
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// إعدادات الجلسة الآمنة
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', SESSION_SECURE ? 1 : 0);
    ini_set('session.cookie_samesite', SESSION_SAME_SITE);
    ini_set('session.use_strict_mode', 1);
    session_start();
}

// إعدادات معالجة الأخطاء
if (isProduction()) {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', LOG_PATH . 'php-errors.log');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// دالة للتحقق من صحة الملف المرفوع
function validateUploadedFile($file) {
    $errors = [];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'خطأ في رفع الملف';
        return $errors;
    }
    
    if ($file['size'] > MAX_FILE_SIZE) {
        $errors[] = 'حجم الملف كبير جداً';
    }
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        $errors[] = 'نوع الملف غير مسموح به';
    }
    
    return $errors;
}

// دالة لإنشاء نسخة احتياطية
function createBackup() {
    if (!BACKUP_ENABLED) {
        return false;
    }
    
    $backupFile = BACKUP_PATH . 'backup-' . date('Y-m-d-H-i-s') . '.sql';
    
    // إنشاء نسخة من قاعدة البيانات
    $command = sprintf(
        'mysqldump -h %s -u %s -p%s %s > %s',
        DB_HOST,
        DB_USER,
        DB_PASS,
        DB_NAME,
        $backupFile
    );
    
    exec($command, $output, $returnCode);
    
    if ($returnCode === 0) {
        // حذف النسخ القديمة
        $files = glob(BACKUP_PATH . 'backup-*.sql');
        if (count($files) > BACKUP_RETENTION) {
            array_map('unlink', array_slice($files, 0, count($files) - BACKUP_RETENTION));
        }
        return true;
    }
    
    return false;
} 