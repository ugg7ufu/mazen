<?php
/**
 * ملف الإعدادات الرئيسية
 * Main Configuration File
 */

// معلومات التطبيق
define('APP_NAME', 'مساحة عمل التطوير');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost:8000');
define('APP_ROOT', dirname(__DIR__));

// إعدادات قاعدة البيانات
define('DB_HOST', 'localhost');
define('DB_NAME', 'dev_workspace');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// إعدادات الأمان
define('SECRET_KEY', 'your-secret-key-here');
define('JWT_SECRET', 'your-jwt-secret-here');

// إعدادات الجلسة
define('SESSION_LIFETIME', 3600); // ساعة واحدة
define('SESSION_NAME', 'dev_workspace_session');

// إعدادات التطوير
define('DEBUG_MODE', true);
define('ERROR_REPORTING', E_ALL);

// إعدادات الملفات
define('UPLOAD_PATH', APP_ROOT . '/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5 ميجابايت
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']);

// إعدادات البريد الإلكتروني
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'your-password');

// إعدادات API
define('API_VERSION', 'v1');
define('API_RATE_LIMIT', 100); // طلب في الدقيقة

// تكوين الأخطاء
if (DEBUG_MODE) {
    error_reporting(ERROR_REPORTING);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// تكوين الجلسة
ini_set('session.cookie_lifetime', SESSION_LIFETIME);
ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
ini_set('session.name', SESSION_NAME);

// دوال مساعدة للإعدادات
function getConfig($key, $default = null) {
    return defined($key) ? constant($key) : $default;
}

function isDebugMode() {
    return DEBUG_MODE;
}

function getAppUrl($path = '') {
    return APP_URL . '/' . ltrim($path, '/');
}

function getUploadPath($filename = '') {
    return UPLOAD_PATH . ltrim($filename, '/');
}

// دالة لتحميل المتغيرات البيئية
function loadEnv($file = '.env') {
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                if (!defined($key)) {
                    define($key, $value);
                }
            }
        }
    }
}

// تحميل ملف البيئة إذا وجد
loadEnv();
?> 