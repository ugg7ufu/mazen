# دليل النشر المجاني على Render 🎨

## ما هو Render؟
Render منصة نشر سحابية مجانية تدعم العديد من التقنيات.

## المميزات المجانية:
- ✅ **750 ساعة شهرياً مجانية**
- ✅ **نشر تلقائي من GitHub**
- ✅ **قاعدة بيانات PostgreSQL مجانية**
- ✅ **شهادة SSL مجانية**
- ✅ **نطاق فرعي مجاني**

## خطوات النشر:

### 1. إعداد المشروع
```bash
# تأكد من وجود ملف package.json أو requirements.txt
# أو استخدم ملف Dockerfile
```

### 2. رفع المشروع لـ GitHub
```bash
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/username/repo-name.git
git push -u origin main
```

### 3. النشر على Render
1. **اذهب إلى:** https://render.com
2. **سجل دخول بـ GitHub**
3. **انقر "New +"**
4. **اختر "Web Service"**
5. **اختر مشروعك من GitHub**
6. **أدخل الإعدادات:**
   - **Name:** اسم تطبيقك
   - **Environment:** Node, Python, Docker
   - **Build Command:** `npm install` أو `pip install -r requirements.txt`
   - **Start Command:** `npm start` أو `python app.py`
7. **انقر "Create Web Service"**

### 4. إعداد قاعدة البيانات (اختياري)
1. **انقر "New +"**
2. **اختر "PostgreSQL"**
3. **أدخل اسم قاعدة البيانات**
4. **انسخ بيانات الاتصال**

## ملفات مطلوبة:

### لـ Node.js:
```json
// package.json
{
  "name": "dev-workspace",
  "version": "1.0.0",
  "scripts": {
    "start": "node server.js"
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
psycopg2-binary==2.9.7
```

### لـ Docker:
```dockerfile
# Dockerfile
FROM python:3.11-slim
WORKDIR /app
COPY requirements.txt .
RUN pip install -r requirements.txt
COPY . .
EXPOSE 10000
CMD ["gunicorn", "--bind", "0.0.0.0:10000", "app:app"]
```

## متغيرات البيئة:
```bash
# في Render Dashboard
DATABASE_URL=postgresql://user:pass@host:port/db
NODE_ENV=production
PORT=10000
```

## نصائح مهمة:
- استخدم متغيرات البيئة للمعلومات الحساسة
- Render يستخدم المنفذ 10000 افتراضياً
- قاعدة البيانات PostgreSQL مجانية
- النسخ الاحتياطية تلقائية

## رابط النشر:
https://render.com 