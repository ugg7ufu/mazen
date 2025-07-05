@echo off
echo ========================================
echo    النشر المجاني على الإنترنت
echo ========================================
echo.

echo اختر منصة النشر المجانية:
echo.
echo 1. Railway (الأسهل - يدعم كل شيء)
echo 2. Render (ممتاز - قاعدة بيانات مجانية)
echo 3. Netlify (للأمامية - HTML/CSS/JS/React)
echo 4. Vercel (للأمامية - React/Vue/Next.js)
echo 5. GitHub Pages (للأمامية - مجاني 100%)
echo 6. دليل شامل لجميع المنصات
echo.
set /p choice="اختر المنصة (1-6): "

if "%choice%"=="1" (
    echo.
    echo ========================================
    echo    النشر على Railway
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. اذهب إلى: https://railway.app
    echo 2. سجل دخول بـ GitHub
    echo 3. انقر "New Project"
    echo 4. اختر "Deploy from GitHub repo"
    echo 5. اختر مشروعك
    echo 6. Railway سينشر تلقائياً!
    echo.
    echo المميزات المجانية:
    echo - 500 ساعة شهرياً
    echo - قاعدة بيانات مجانية
    echo - شهادة SSL مجانية
    echo - نطاق فرعي مجاني
    echo.
    echo هل تريد فتح Railway الآن؟
    set /p open_railway="(y/n): "
    if /i "%open_railway%"=="y" (
        start https://railway.app
    )
) else if "%choice%"=="2" (
    echo.
    echo ========================================
    echo    النشر على Render
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. اذهب إلى: https://render.com
    echo 2. سجل دخول بـ GitHub
    echo 3. انقر "New +"
    echo 4. اختر "Web Service"
    echo 5. اختر مشروعك من GitHub
    echo 6. أدخل الإعدادات وانقر "Create"
    echo.
    echo المميزات المجانية:
    echo - 750 ساعة شهرياً
    echo - قاعدة بيانات PostgreSQL مجانية
    echo - شهادة SSL مجانية
    echo - نطاق فرعي مجاني
    echo.
    echo هل تريد فتح Render الآن؟
    set /p open_render="(y/n): "
    if /i "%open_render%"=="y" (
        start https://render.com
    )
) else if "%choice%"=="3" (
    echo.
    echo ========================================
    echo    النشر على Netlify
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. اذهب إلى: https://netlify.com
    echo 2. سجل دخول بـ GitHub
    echo 3. انقر "New site from Git"
    echo 4. اختر GitHub
    echo 5. اختر مشروعك
    echo 6. أدخل الإعدادات وانقر "Deploy"
    echo.
    echo المميزات المجانية:
    echo - 100GB شهرياً
    echo - شهادة SSL مجانية
    echo - CDN عالمي
    echo - نماذج مجانية
    echo.
    echo هل تريد فتح Netlify الآن؟
    set /p open_netlify="(y/n): "
    if /i "%open_netlify%"=="y" (
        start https://netlify.com
    )
) else if "%choice%"=="4" (
    echo.
    echo ========================================
    echo    النشر على Vercel
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. اذهب إلى: https://vercel.com
    echo 2. سجل دخول بـ GitHub
    echo 3. انقر "New Project"
    echo 4. اختر مشروعك من GitHub
    echo 5. Vercel سينشر تلقائياً!
    echo.
    echo المميزات المجانية:
    echo - نشر غير محدود
    echo - شهادة SSL مجانية
    echo - CDN عالمي
    echo - دعم React/Vue/Next.js
    echo.
    echo هل تريد فتح Vercel الآن؟
    set /p open_vercel="(y/n): "
    if /i "%open_vercel%"=="y" (
        start https://vercel.com
    )
) else if "%choice%"=="5" (
    echo.
    echo ========================================
    echo    النشر على GitHub Pages
    echo ========================================
    echo.
    echo خطوات النشر:
    echo 1. ارفع مشروعك إلى GitHub
    echo 2. اذهب إلى Settings في المشروع
    echo 3. اختر Pages من القائمة
    echo 4. اختر Source: Deploy from a branch
    echo 5. اختر Branch: main
    echo 6. انقر Save
    echo.
    echo المميزات المجانية:
    echo - مجاني 100%
    echo - شهادة SSL مجانية
    echo - نطاق فرعي: username.github.io/repo
    echo - نشر تلقائي
    echo.
    echo هل تريد فتح GitHub الآن؟
    set /p open_github="(y/n): "
    if /i "%open_github%"=="y" (
        start https://github.com
    )
) else if "%choice%"=="6" (
    echo.
    echo ========================================
    echo    دليل شامل للنشر المجاني
    echo ========================================
    echo.
    echo فتح الدليل الشامل...
    start deploy\free-hosting\railway-guide.md
    start deploy\free-hosting\render-guide.md
    start deploy\free-hosting\netlify-guide.md
) else (
    echo.
    echo اختيار غير صحيح!
    echo.
)

echo.
echo ========================================
echo    نصائح مهمة للنشر المجاني
echo ========================================
echo.
echo 1. تأكد من رفع المشروع لـ GitHub أولاً
echo 2. استخدم متغيرات البيئة للمعلومات الحساسة
echo 3. لا تضع كلمات المرور في الكود
echo 4. اختبر الموقع بعد النشر
echo 5. احتفظ بنسخة من الكود محلياً
echo.
echo هل تريد إنشاء ملف package.json للمشروع؟
set /p create_package="(y/n): "
if /i "%create_package%"=="y" (
    echo إنشاء package.json...
    echo { > package.json
    echo   "name": "dev-workspace", >> package.json
    echo   "version": "1.0.0", >> package.json
    echo   "description": "مساحة عمل التطوير", >> package.json
    echo   "main": "index.js", >> package.json
    echo   "scripts": { >> package.json
    echo     "start": "node index.js", >> package.json
    echo     "build": "echo 'Build completed'" >> package.json
    echo   }, >> package.json
    echo   "keywords": ["development", "workspace"], >> package.json
    echo   "author": "Your Name", >> package.json
    echo   "license": "MIT" >> package.json
    echo } >> package.json
    echo تم إنشاء package.json
)

echo.
echo هل تريد إنشاء ملف README للمشروع؟
set /p create_readme="(y/n): "
if /i "%create_readme%"=="y" (
    echo إنشاء README.md...
    echo # مساحة عمل التطوير > README.md
    echo. >> README.md
    echo مشروع تطوير شامل يدعم: >> README.md
    echo - HTML/CSS/JavaScript >> README.md
    echo - PHP >> README.md
    echo - Python Flask >> README.md
    echo - React >> README.md
    echo. >> README.md
    echo ## النشر المجاني >> README.md
    echo يمكن نشر هذا المشروع مجاناً على: >> README.md
    echo - Railway >> README.md
    echo - Render >> README.md
    echo - Netlify >> README.md
    echo - Vercel >> README.md
    echo تم إنشاء README.md
)

echo.
echo ========================================
echo    روابط النشر المجاني
echo ========================================
echo.
echo Railway: https://railway.app
echo Render: https://render.com
echo Netlify: https://netlify.com
echo Vercel: https://vercel.com
echo GitHub Pages: https://pages.github.com
echo.
echo 🎉 جاهز للنشر المجاني!

pause 