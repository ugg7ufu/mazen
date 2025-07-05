# دليل النشر المجاني على Netlify 🌐

## ما هو Netlify؟
Netlify منصة نشر مجانية مخصصة للمواقع الثابتة (HTML/CSS/JS) وتطبيقات React/Vue.

## المميزات المجانية:
- ✅ **100GB شهرياً مجاني**
- ✅ **نشر تلقائي من GitHub**
- ✅ **شهادة SSL مجانية**
- ✅ **نطاق فرعي مجاني**
- ✅ **CDN عالمي**
- ✅ **نماذج مجانية**

## خطوات النشر:

### 1. إعداد المشروع
```bash
# تأكد من وجود ملف index.html في المجلد الرئيسي
# أو ملف build/ لـ React
```

### 2. رفع المشروع لـ GitHub
```bash
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/username/repo-name.git
git push -u origin main
```

### 3. النشر على Netlify
1. **اذهب إلى:** https://netlify.com
2. **سجل دخول بـ GitHub**
3. **انقر "New site from Git"**
4. **اختر GitHub**
5. **اختر مشروعك**
6. **أدخل الإعدادات:**
   - **Build command:** `npm run build` (لـ React)
   - **Publish directory:** `build` أو `dist` أو `.`
7. **انقر "Deploy site"**

### 4. إعداد النطاق
- Netlify يعطيك نطاق فرعي مثل: `your-app.netlify.app`
- يمكنك ربط دومين مخصص

## ملفات مطلوبة:

### لـ HTML/CSS/JS:
```
project/
├── index.html
├── styles/
├── scripts/
└── images/
```

### لـ React:
```json
// package.json
{
  "name": "dev-workspace",
  "version": "1.0.0",
  "scripts": {
    "start": "react-scripts start",
    "build": "react-scripts build"
  },
  "dependencies": {
    "react": "^18.2.0",
    "react-dom": "^18.2.0"
  }
}
```

### لـ Vue.js:
```json
// package.json
{
  "name": "dev-workspace",
  "version": "1.0.0",
  "scripts": {
    "serve": "vue-cli-service serve",
    "build": "vue-cli-service build"
  }
}
```

## إعدادات خاصة:

### ملف _redirects (لـ SPA):
```
/*    /index.html   200
```

### ملف _headers:
```
/*
  X-Frame-Options: DENY
  X-XSS-Protection: 1; mode=block
  X-Content-Type-Options: nosniff
```

### ملف netlify.toml:
```toml
[build]
  publish = "build"
  command = "npm run build"

[[redirects]]
  from = "/*"
  to = "/index.html"
  status = 200
```

## ميزات إضافية:

### النماذج المجانية:
```html
<form name="contact" netlify>
  <input type="text" name="name" />
  <input type="email" name="email" />
  <button type="submit">إرسال</button>
</form>
```

### الدوال الخادمية:
```javascript
// functions/hello.js
exports.handler = async (event) => {
  return {
    statusCode: 200,
    body: JSON.stringify({ message: "مرحباً!" })
  };
};
```

## نصائح مهمة:
- استخدم ملف _redirects للصفحات المفردة
- فعّل الكاش لتحسين الأداء
- استخدم CDN لتحسين السرعة
- النماذج مجانية ومؤمنة

## رابط النشر:
https://netlify.com 