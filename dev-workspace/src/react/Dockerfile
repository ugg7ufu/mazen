FROM node:18-alpine

# تعيين مجلد العمل
WORKDIR /app

# نسخ ملف التبعيات
COPY package*.json ./

# تثبيت التبعيات
RUN npm install

# نسخ الكود
COPY . .

# فتح المنفذ 3000
EXPOSE 3000

# تشغيل التطبيق
CMD ["npm", "start"] 