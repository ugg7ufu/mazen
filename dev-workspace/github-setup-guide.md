# دليل رفع المشروع على GitHub 🐙

## الخطوة الأولى: إنشاء حساب GitHub

### 1. إنشاء الحساب
1. اذهب إلى: https://github.com
2. انقر "Sign up"
3. أدخل:
   - **Username:** اسم المستخدم (مثال: yourname)
   - **Email:** بريدك الإلكتروني
   - **Password:** كلمة مرور قوية
4. انقر "Create account"

### 2. تأكيد البريد الإلكتروني
- تحقق من بريدك الإلكتروني
- انقر على رابط التأكيد

---

## الخطوة الثانية: إنشاء مستودع جديد

### 1. إنشاء Repository
1. في GitHub، انقر **"New"** أو **"+"** ثم **"New repository"**
2. أدخل:
   - **Repository name:** `dev-workspace` (أو أي اسم تريده)
   - **Description:** `مساحة عمل التطوير الشاملة`
   - **Public** (اختر Public للنشر المجاني)
   - **✅ Add a README file**
   - **✅ Add .gitignore** (اختر Node)
   - **✅ Choose a license** (اختر MIT)
3. انقر **"Create repository"**

---

## الخطوة الثالثة: رفع المشروع

### الطريقة الأولى: باستخدام GitHub Desktop (الأسهل)

#### 1. تحميل GitHub Desktop
1. اذهب إلى: https://desktop.github.com
2. حمل وثبت GitHub Desktop
3. سجل دخول بحساب GitHub

#### 2. رفع المشروع
1. افتح GitHub Desktop
2. انقر **"Clone a repository from the Internet"**
3. اختر المستودع الذي أنشأته
4. اختر مكان حفظ المشروع
5. انقر **"Clone"**
6. انسخ جميع ملفات مشروعك إلى المجلد
7. في GitHub Desktop:
   - اكتب رسالة في **Summary** (مثال: "Initial commit")
   - انقر **"Commit to main"**
   - انقر **"Push origin"**

### الطريقة الثانية: باستخدام Git في Terminal

#### 1. تثبيت Git
```bash
# تحقق من وجود Git
git --version

# إذا لم يكن موجود، حمل من: https://git-scm.com
```

#### 2. إعداد Git
```bash
# تعيين اسم المستخدم
git config --global user.name "Your Name"

# تعيين البريد الإلكتروني
git config --global user.email "your.email@example.com"
```

#### 3. رفع المشروع
```bash
# انتقل لمجلد المشروع
cd "C:\Users\user\Downloads\CoreUI Vue.js Admin Template_files"

# تهيئة Git
git init

# إضافة جميع الملفات
git add .

# حفظ التغييرات
git commit -m "Initial commit: مساحة عمل التطوير الشاملة"

# ربط المشروع بـ GitHub
git remote add origin https://github.com/yourusername/dev-workspace.git

# رفع المشروع
git push -u origin main
```

---

## الخطوة الرابعة: التحقق من النشر

### 1. تحقق من GitHub
- اذهب إلى: https://github.com/yourusername/dev-workspace
- تأكد من ظهور جميع الملفات

### 2. تحديث المشروع
```bash
# عند إجراء تغييرات
git add .
git commit -m "تحديث: إضافة ميزات جديدة"
git push
```

---

## نصائح مهمة:

### 1. ملف .gitignore
تأكد من وجود ملف `.gitignore` يحتوي على:
```
node_modules/
.env
*.log
.DS_Store
Thumbs.db
```

### 2. README.md
أنشئ ملف README.md يحتوي على:
```markdown
# مساحة عمل التطوير الشاملة

مشروع تطوير شامل يدعم:
- HTML/CSS/JavaScript
- PHP
- Python Flask
- React

## النشر المجاني
يمكن نشر هذا المشروع مجاناً على:
- Railway
- Render
- Netlify
- Vercel
```

### 3. الأمان
- لا تضع كلمات المرور في الكود
- استخدم متغيرات البيئة
- لا ترفع ملفات .env

---

## روابط مفيدة:

- **GitHub:** https://github.com
- **GitHub Desktop:** https://desktop.github.com
- **Git:** https://git-scm.com
- **GitHub Pages:** https://pages.github.com

---

## بعد رفع المشروع:

### 1. النشر على Railway
1. اذهب إلى: https://railway.app
2. سجل دخول بـ GitHub
3. اختر مشروعك
4. سينشر تلقائياً!

### 2. النشر على Render
1. اذهب إلى: https://render.com
2. سجل دخول بـ GitHub
3. اختر مشروعك
4. أدخل الإعدادات

### 3. النشر على Netlify
1. اذهب إلى: https://netlify.com
2. سجل دخول بـ GitHub
3. اختر مشروعك
4. سينشر تلقائياً!

---

**🎉 تهانينا! مشروعك الآن على GitHub وجاهز للنشر!** 