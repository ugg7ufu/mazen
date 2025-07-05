@echo off
echo ========================================
echo    مساحة عمل التطوير
echo ========================================
echo.
echo بدء تشغيل الخادم المحلي...
echo.
echo يمكنك الوصول للمشروع على:
echo http://localhost:8000
echo.
echo اضغط Ctrl+C لإيقاف الخادم
echo.
python -m http.server 8000
pause 