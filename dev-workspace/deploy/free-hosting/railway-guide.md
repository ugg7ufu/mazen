# دليل النشر المجاني على Railway 🚂

## ما هو Railway؟
Railway منصة نشر مجانية تتيح لك نشر تطبيقاتك بسهولة مع ربط GitHub.

## المميزات المجانية:
- ✅ **500 ساعة شهرياً مجانية**
- ✅ **نشر تلقائي من GitHub**
- ✅ **قاعدة بيانات مجانية**
- ✅ **شهادة SSL مجانية**
- ✅ **نطاق فرعي مجاني**

## خطوات النشر:

### 1. إعداد المشروع
```bash
# تأكد من وجود ملف package.json في المجلد الرئيسي
# أو استخدم ملف Dockerfile
```

### 2. رفع المشروع لـ GitHub
```bash
# إذا لم يكن المشروع على GitHub
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/username/repo-name.git
git push -u origin main
```

### 3. النشر على Railway
1. **اذهب إلى:** https://railway.app
2. **سجل دخول بـ GitHub**
3. **انقر "New Project"**
4. **اختر "Deploy from GitHub repo"**
5. **اختر مشروعك**
6. **Railway سينشر تلقائياً!**

### 4. إعداد النطاق
- Railway يعطيك نطاق فرعي مثل: `your-app.railway.app`
- يمكنك ربط دومين مخصص (اختياري)

## ملفات مطلوبة:

### لـ React/Node.js:
```json
// package.json
{
  "name": "dev-workspace",
  "version": "1.0.0",
  "scripts": {
    "start": "node server.js",
    "build": "npm run build"
  },
  "dependencies": {
    "express": "^4.18.2"
  }
}
```

### لـ Python:
```python
# requirements.txt
Flask==2.3.3
gunicorn==21.2.0
```

### لـ PHP:
```dockerfile
# Dockerfile
FROM php:8.1-apache
COPY . /var/www/html/
```

## نصائح مهمة:
- استخدم متغيرات البيئة للمعلومات الحساسة
- لا تضع كلمات المرور في الكود
- استخدم قاعدة بيانات Railway المجانية

## رابط النشر:
https://railway.app 