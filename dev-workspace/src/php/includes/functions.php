<?php
/**
 * الدوال المساعدة
 * Helper Functions
 */

/**
 * تنظيف المدخلات
 */
function sanitize($input) {
    if (is_array($input)) {
        return array_map('sanitize', $input);
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * التحقق من صحة البريد الإلكتروني
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * تشفير كلمة المرور
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * التحقق من كلمة المرور
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * إنشاء رمز عشوائي
 */
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

/**
 * إنشاء معرف فريد
 */
function generateId() {
    return uniqid() . '_' . time();
}

/**
 * تنسيق التاريخ
 */
function formatDate($date, $format = 'Y-m-d H:i:s') {
    if (is_string($date)) {
        $date = new DateTime($date);
    }
    return $date->format($format);
}

/**
 * تحويل التاريخ إلى نص نسبي
 */
function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) {
        return 'الآن';
    } elseif ($time < 3600) {
        $minutes = floor($time / 60);
        return "منذ {$minutes} دقيقة";
    } elseif ($time < 86400) {
        $hours = floor($time / 3600);
        return "منذ {$hours} ساعة";
    } elseif ($time < 2592000) {
        $days = floor($time / 86400);
        return "منذ {$days} يوم";
    } else {
        return formatDate($datetime, 'Y-m-d');
    }
}

/**
 * إعادة توجيه
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * إرجاع استجابة JSON
 */
function jsonResponse($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/**
 * إرجاع استجابة خطأ
 */
function errorResponse($message, $status = 400) {
    jsonResponse(['error' => $message], $status);
}

/**
 * إرجاع استجابة نجاح
 */
function successResponse($data = null, $message = 'تم بنجاح') {
    $response = ['success' => true, 'message' => $message];
    if ($data !== null) {
        $response['data'] = $data;
    }
    jsonResponse($response);
}

/**
 * التحقق من طلب AJAX
 */
function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * الحصول على IP المستخدم
 */
function getClientIP() {
    $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($ipKeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

/**
 * رفع ملف
 */
function uploadFile($file, $destination, $allowedTypes = null) {
    if ($allowedTypes === null) {
        $allowedTypes = ALLOWED_EXTENSIONS;
    }
    
    // التحقق من وجود أخطاء
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    
    // التحقق من حجم الملف
    if ($file['size'] > MAX_FILE_SIZE) {
        return false;
    }
    
    // التحقق من نوع الملف
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedTypes)) {
        return false;
    }
    
    // إنشاء اسم فريد للملف
    $filename = generateId() . '.' . $extension;
    $filepath = $destination . '/' . $filename;
    
    // إنشاء المجلد إذا لم يكن موجوداً
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    // نقل الملف
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return $filename;
    }
    
    return false;
}

/**
 * حذف ملف
 */
function deleteFile($filename, $directory) {
    $filepath = $directory . '/' . $filename;
    if (file_exists($filepath)) {
        return unlink($filepath);
    }
    return false;
}

/**
 * إرسال بريد إلكتروني
 */
function sendEmail($to, $subject, $message, $headers = '') {
    $defaultHeaders = "From: " . SMTP_USER . "\r\n";
    $defaultHeaders .= "Reply-To: " . SMTP_USER . "\r\n";
    $defaultHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $headers = $headers ? $headers . "\r\n" . $defaultHeaders : $defaultHeaders;
    
    return mail($to, $subject, $message, $headers);
}

/**
 * تسجيل الدخول
 */
function login($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['logged_in'] = true;
    $_SESSION['login_time'] = time();
}

/**
 * تسجيل الخروج
 */
function logout() {
    session_destroy();
    session_start();
}

/**
 * التحقق من تسجيل الدخول
 */
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * الحصول على معلومات المستخدم الحالي
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    global $db;
    $sql = "SELECT id, username, email, full_name, role FROM users WHERE id = :id";
    return $db->fetchOne($sql, ['id' => $_SESSION['user_id']]);
}

/**
 * التحقق من الصلاحيات
 */
function hasPermission($permission) {
    if (!isLoggedIn()) {
        return false;
    }
    
    $user = getCurrentUser();
    if ($user['role'] === 'admin') {
        return true;
    }
    
    // يمكن إضافة المزيد من الصلاحيات هنا
    return false;
}

/**
 * إنشاء رابط
 */
function createLink($path) {
    return APP_URL . '/' . ltrim($path, '/');
}

/**
 * الحصول على قيمة POST
 */
function post($key, $default = '') {
    return $_POST[$key] ?? $default;
}

/**
 * الحصول على قيمة GET
 */
function get($key, $default = '') {
    return $_GET[$key] ?? $default;
}

/**
 * الحصول على قيمة SESSION
 */
function session($key, $default = '') {
    return $_SESSION[$key] ?? $default;
}

/**
 * تعيين قيمة SESSION
 */
function setSession($key, $value) {
    $_SESSION[$key] = $value;
}

/**
 * حذف قيمة SESSION
 */
function unsetSession($key) {
    unset($_SESSION[$key]);
}

/**
 * طباعة متغير للتطوير
 */
function debug($var) {
    if (DEBUG_MODE) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}

/**
 * تسجيل خطأ
 */
function logError($message, $context = []) {
    $logEntry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'message' => $message,
        'context' => $context,
        'ip' => getClientIP(),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
    ];
    
    $logFile = APP_ROOT . '/logs/error.log';
    $logDir = dirname($logFile);
    
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    file_put_contents($logFile, json_encode($logEntry) . "\n", FILE_APPEND | LOCK_EX);
}
?> 