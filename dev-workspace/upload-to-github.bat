@echo off
echo ========================================
echo    رفع المشروع على GitHub
echo ========================================
echo.

echo اختر طريقة رفع المشروع:
echo.
echo 1. باستخدام GitHub Desktop (الأسهل)
echo 2. باستخدام Git في Terminal
echo 3. دليل مفصل لجميع الطرق
echo.
set /p choice="اختر الطريقة (1-3): "

if "%choice%"=="1" (
    echo.
    echo ========================================
    echo    رفع المشروع بـ GitHub Desktop
    echo ========================================
    echo.
    echo خطوات رفع المشروع:
    echo.
    echo 1. حمل GitHub Desktop من:
    echo    https://desktop.github.com
    echo.
    echo 2. ثبت GitHub Desktop وسجل دخول
    echo.
    echo 3. في GitHub Desktop:
    echo    - انقر "Clone a repository"
    echo    - اختر المستودع الذي أنشأته
    echo    - اختر مكان حفظ المشروع
    echo    - انقر "Clone"
    echo.
    echo 4. انسخ جميع ملفات مشروعك إلى المجلد
    echo.
    echo 5. في GitHub Desktop:
    echo    - اكتب رسالة في Summary
    echo    - انقر "Commit to main"
    echo    - انقر "Push origin"
    echo.
    echo هل تريد فتح GitHub Desktop الآن؟
    set /p open_desktop="(y/n): "
    if /i "%open_desktop%"=="y" (
        start https://desktop.github.com
    )
) else if "%choice%"=="2" (
    echo.
    echo ========================================
    echo    رفع المشروع بـ Git Terminal
    echo ========================================
    echo.
    echo أولاً، تأكد من وجود Git:
    git --version
    echo.
    echo إذا لم يكن Git موجود، حمل من:
    echo https://git-scm.com
    echo.
    echo بعد تثبيت Git، شغّل هذه الأوامر:
    echo.
    echo 1. إعداد Git:
    echo    git config --global user.name "Your Name"
    echo    git config --global user.email "your.email@example.com"
    echo.
    echo 2. رفع المشروع:
    echo    git init
    echo    git add .
    echo    git commit -m "Initial commit"
    echo    git remote add origin https://github.com/yourusername/repo-name.git
    echo    git push -u origin main
    echo.
    echo هل تريد فتح Git الآن؟
    set /p open_git="(y/n): "
    if /i "%open_git%"=="y" (
        start https://git-scm.com
    )
) else if "%choice%"=="3" (
    echo.
    echo ========================================
    echo    دليل مفصل لرفع المشروع
    echo ========================================
    echo.
    echo فتح الدليل المفصل...
    start github-setup-guide.md
) else (
    echo.
    echo اختيار غير صحيح!
    echo.
)

echo.
echo ========================================
echo    خطوات إنشاء حساب GitHub
echo ========================================
echo.
echo 1. اذهب إلى: https://github.com
echo 2. انقر "Sign up"
echo 3. أدخل:
echo    - Username: اسم المستخدم
echo    - Email: بريدك الإلكتروني
echo    - Password: كلمة مرور قوية
echo 4. انقر "Create account"
echo 5. تأكد من بريدك الإلكتروني
echo.
echo هل تريد فتح GitHub الآن؟
set /p open_github="(y/n): "
if /i "%open_github%"=="y" (
    start https://github.com
)

echo.
echo ========================================
echo    إنشاء مستودع جديد
echo ========================================
echo.
echo بعد إنشاء الحساب:
echo 1. انقر "New" أو "+" ثم "New repository"
echo 2. أدخل:
echo    - Repository name: dev-workspace
echo    - Description: مساحة عمل التطوير الشاملة
echo    - Public (اختر Public)
echo    - ✅ Add a README file
echo    - ✅ Add .gitignore (اختر Node)
echo    - ✅ Choose a license (اختر MIT)
echo 3. انقر "Create repository"
echo.

echo ========================================
echo    نصائح مهمة
echo ========================================
echo.
echo 1. تأكد من وجود ملف .gitignore
echo 2. لا ترفع ملفات .env أو كلمات المرور
echo 3. اكتب رسائل واضحة في Commit
echo 4. اختر Public للنشر المجاني
echo 5. أضف README.md للمشروع
echo.

echo ========================================
echo    بعد رفع المشروع
echo ========================================
echo.
echo يمكنك الآن النشر على:
echo - Railway: https://railway.app
echo - Render: https://render.com
echo - Netlify: https://netlify.com
echo - Vercel: https://vercel.com
echo.

echo 🎉 جاهز لرفع المشروع على GitHub!

pause 