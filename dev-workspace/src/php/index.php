<?php
/**
 * الملف الرئيسي للتطبيق PHP
 * Main PHP Application File
 */

// تضمين ملف الإعدادات
require_once 'config/config.php';

// تضمين ملف الاتصال بقاعدة البيانات
require_once 'config/database.php';

// تضمين الدوال المساعدة
require_once 'includes/functions.php';

// بدء الجلسة
session_start();

// تعيين المنطقة الزمنية
date_default_timezone_set('Asia/Riyadh');

// معالجة الطلب
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// تنظيف الطلب
$request = trim($request, '/');
$request = explode('?', $request)[0];

// توجيه الطلبات
switch ($request) {
    case '':
    case 'home':
        include 'pages/home.php';
        break;
        
    case 'about':
        include 'pages/about.php';
        break;
        
    case 'contact':
        include 'pages/contact.php';
        break;
        
    case 'api/users':
        include 'api/users.php';
        break;
        
    case 'api/posts':
        include 'api/posts.php';
        break;
        
    default:
        // صفحة 404
        http_response_code(404);
        include 'pages/404.php';
        break;
}
?> 