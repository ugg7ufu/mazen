FROM python:3.11-slim

# تعيين مجلد العمل
WORKDIR /app

# تثبيت التبعيات النظامية
RUN apt-get update && apt-get install -y \
    gcc \
    && rm -rf /var/lib/apt/lists/*

# نسخ ملف التبعيات
COPY src/python/requirements.txt .

# تثبيت تبعيات Python
RUN pip install --no-cache-dir -r requirements.txt

# نسخ الكود
COPY src/python/ .

# إنشاء مجلدات مطلوبة
RUN mkdir -p logs uploads cache

# تعيين الصلاحيات
RUN chmod +x app.py

# فتح المنفذ
EXPOSE 10000

# تشغيل التطبيق
CMD ["gunicorn", "--bind", "0.0.0.0:10000", "--workers", "4", "app:app"] 