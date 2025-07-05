@echo off
echo ========================================
echo    نشر المشروع على الاستضافة
echo ========================================
echo.

echo اختر نوع الاستضافة:
echo.
echo 1. استضافة مشتركة (cPanel)
echo 2. استضافة سحابية (Docker)
echo 3. Railway (مجاني)
echo 4. Render (مجاني)
echo 5. Heroku (مدفوع)
echo.
set /p hosting_type="اختر نوع الاستضافة (1-5): "

if "%hosting_type%"=="1" (
    echo.
    echo ========================================
    echo    نشر على استضافة مشتركة
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. ارفع محتويات مجلد src/php إلى public_html
    echo 2. ارفع ملف deploy/shared-hosting/htaccess إلى public_html/.htaccess
    echo 3. غيّر إعدادات قاعدة البيانات في config-production.php
    echo 4. أنشئ قاعدة البيانات في phpMyAdmin
    echo.
    echo هل تريد فتح مجلد الملفات الجاهزة؟
    set /p open_folder="(y/n): "
    if /i "%open_folder%"=="y" (
        explorer deploy\shared-hosting
    )
) else if "%hosting_type%"=="2" (
    echo.
    echo ========================================
    echo    نشر على استضافة سحابية
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. ارفع جميع الملفات إلى الخادم
    echo 2. شغّل: docker-compose -f deploy/cloud-hosting/docker-compose.prod.yml up -d
    echo 3. أضف شهادات SSL
    echo 4. غيّر إعدادات النطاق
    echo.
    echo هل تريد فتح مجلد الملفات الجاهزة؟
    set /p open_folder="(y/n): "
    if /i "%open_folder%"=="y" (
        explorer deploy\cloud-hosting
    )
) else if "%hosting_type%"=="3" (
    echo.
    echo ========================================
    echo    نشر على Railway
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. اذهب إلى https://railway.app
    echo 2. سجل دخول بـ GitHub
    echo 3. اربط المشروع بـ Git
    echo 4. Railway سينشر تلقائياً
    echo.
    echo هل تريد إنشاء ملف railway.json؟
    set /p create_railway="(y/n): "
    if /i "%create_railway%"=="y" (
        echo إنشاء ملف railway.json...
        echo { > railway.json
        echo   "build": { >> railway.json
        echo     "builder": "DOCKERFILE", >> railway.json
        echo     "dockerfilePath": "deploy/railway/Dockerfile" >> railway.json
        echo   } >> railway.json
        echo } >> railway.json
        echo تم إنشاء railway.json
    )
) else if "%hosting_type%"=="4" (
    echo.
    echo ========================================
    echo    نشر على Render
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. اذهب إلى https://render.com
    echo 2. سجل دخول بـ GitHub
    echo 3. اربط المشروع بـ Git
    echo 4. Render سينشر تلقائياً
    echo.
    echo هل تريد إنشاء ملف render.yaml؟
    set /p create_render="(y/n): "
    if /i "%create_render%"=="y" (
        echo إنشاء ملف render.yaml...
        echo services: > render.yaml
        echo   - type: web >> render.yaml
        echo     name: dev-workspace >> render.yaml
        echo     env: docker >> render.yaml
        echo     dockerfilePath: ./deploy/render/Dockerfile >> render.yaml
        echo     dockerContext: . >> render.yaml
        echo     plan: free >> render.yaml
        echo تم إنشاء render.yaml
    )
) else if "%hosting_type%"=="5" (
    echo.
    echo ========================================
    echo    نشر على Heroku
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. ثبت Heroku CLI
    echo 2. سجل دخول: heroku login
    echo 3. أنشئ تطبيق: heroku create your-app-name
    echo 4. ارفع الكود: git push heroku main
    echo.
    echo هل تريد إنشاء ملف Procfile؟
    set /p create_procfile="(y/n): "
    if /i "%create_procfile%"=="y" (
        echo web: gunicorn src.python.app:app > Procfile
        echo تم إنشاء Procfile
    )
) else (
    echo.
    echo اختيار غير صحيح!
    echo.
)

echo.
echo ========================================
echo    نصائح مهمة للنشر
echo ========================================
echo.
echo 1. غيّر كلمات المرور الافتراضية
echo 2. فعّل شهادة SSL
echo 3. أضف نسخ احتياطية تلقائية
echo 4. راقب أداء الموقع
echo 5. اختبر جميع الوظائف
echo.
echo هل تريد فتح دليل النشر الكامل؟
set /p open_guide="(y/n): "
if /i "%open_guide%"=="y" (
    start deploy\hosting-setup.md
)

pause 