@echo off
echo ========================================
echo    مساحة عمل التطوير الشاملة
echo ========================================
echo.
echo اختر البيئة التي تريد تشغيلها:
echo.
echo 1. JavaScript (HTML/CSS/JS)
echo 2. PHP
echo 3. Python Flask
echo 4. React
echo 5. Docker (جميع البيئات)
echo 6. تشغيل جميع الخوادم المحلية
echo.
set /p choice="اختر رقم البيئة (1-6): "

if "%choice%"=="1" (
    echo.
    echo تشغيل بيئة JavaScript...
    echo يمكنك الوصول على: http://localhost:8000
    echo.
    python -m http.server 8000
) else if "%choice%"=="2" (
    echo.
    echo تشغيل بيئة PHP...
    echo يمكنك الوصول على: http://localhost:8000
    echo.
    cd src\php
    php -S localhost:8000
) else if "%choice%"=="3" (
    echo.
    echo تشغيل بيئة Python Flask...
    echo يمكنك الوصول على: http://localhost:5000
    echo.
    cd src\python
    python app.py
) else if "%choice%"=="4" (
    echo.
    echo تشغيل بيئة React...
    echo يمكنك الوصول على: http://localhost:3000
    echo.
    cd src\react
    npm start
) else if "%choice%"=="5" (
    echo.
    echo تشغيل جميع البيئات بـ Docker...
    echo PHP: http://localhost:8000
    echo Python: http://localhost:5000
    echo React: http://localhost:3000
    echo MySQL: localhost:3306
    echo phpMyAdmin: http://localhost:8080
    echo.
    docker-compose up -d
    echo.
    echo تم تشغيل جميع الخدمات!
    echo اضغط أي مفتاح لإيقاف الخدمات...
    pause
    docker-compose down
) else if "%choice%"=="6" (
    echo.
    echo تشغيل جميع الخوادم المحلية...
    echo.
    echo JavaScript: http://localhost:8000
    echo PHP: http://localhost:8001
    echo Python: http://localhost:5000
    echo.
    start "JavaScript Server" cmd /k "python -m http.server 8000"
    start "PHP Server" cmd /k "cd src\php && php -S localhost:8001"
    start "Python Server" cmd /k "cd src\python && python app.py"
    echo.
    echo تم تشغيل جميع الخوادم!
    echo أغلق النوافذ لإيقاف الخوادم.
) else (
    echo.
    echo اختيار غير صحيح!
    echo.
)

pause 