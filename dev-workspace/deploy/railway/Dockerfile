FROM node:18-alpine AS builder

# تعيين مجلد العمل
WORKDIR /app

# نسخ ملف التبعيات
COPY package*.json ./

# تثبيت التبعيات
RUN npm ci --only=production

# نسخ الكود
COPY . .

# بناء التطبيق
RUN npm run build

# مرحلة الإنتاج
FROM nginx:alpine

# نسخ الملفات المبنية
COPY --from=builder /app/build /usr/share/nginx/html

# نسخ إعدادات Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# فتح المنفذ
EXPOSE 80

# تشغيل Nginx
CMD ["nginx", "-g", "daemon off;"] 