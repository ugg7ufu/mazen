FROM python:3.11-slim

# تعيين مجلد العمل
WORKDIR /app

# نسخ ملف التبعيات
COPY requirements.txt .

# تثبيت التبعيات
RUN pip install --no-cache-dir -r requirements.txt

# نسخ الكود
COPY . .

# فتح المنفذ 5000
EXPOSE 5000

# تشغيل التطبيق
CMD ["python", "app.py"] 