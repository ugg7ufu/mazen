@echo off
echo ========================================
echo    مساحة عمل PHP
echo ========================================
echo.
echo بدء تشغيل خادم PHP المحلي...
echo.
echo يمكنك الوصول للتطبيق على:
echo http://localhost:8000/php/
echo.
echo تأكد من تثبيت PHP على جهازك
echo.
echo اضغط Ctrl+C لإيقاف الخادم
echo.
cd src\php
php -S localhost:8000
pause 