/**
 * ملف الأدوات المساعدة
 * يحتوي على دوال مفيدة للتطوير
 */

// دالة لتنسيق التاريخ
function formatDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        weekday: 'long'
    };
    return new Intl.DateTimeFormat('ar-SA', options).format(date);
}

// دالة لإنشاء معرف فريد
function generateId() {
    return Date.now().toString(36) + Math.random().toString(36).substr(2);
}

// دالة للتحقق من صحة البريد الإلكتروني
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// دالة لتخزين البيانات في localStorage
function saveToStorage(key, data) {
    try {
        localStorage.setItem(key, JSON.stringify(data));
        return true;
    } catch (error) {
        console.error('خطأ في حفظ البيانات:', error);
        return false;
    }
}

// دالة لاسترجاع البيانات من localStorage
function getFromStorage(key) {
    try {
        const data = localStorage.getItem(key);
        return data ? JSON.parse(data) : null;
    } catch (error) {
        console.error('خطأ في استرجاع البيانات:', error);
        return null;
    }
}

// دالة لإظهار رسائل التنبيه
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // إضافة الأنماط
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        z-index: 1000;
        animation: slideIn 0.3s ease;
        background: ${type === 'success' ? '#27ae60' : 
                    type === 'error' ? '#e74c3c' : 
                    type === 'warning' ? '#f39c12' : '#3498db'};
    `;
    
    document.body.appendChild(notification);
    
    // إزالة التنبيه بعد 3 ثوان
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// دالة لتحميل البيانات من API
async function fetchData(url, options = {}) {
    try {
        const response = await fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            },
            ...options
        });
        
        if (!response.ok) {
            throw new Error(`خطأ في الطلب: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('خطأ في جلب البيانات:', error);
        throw error;
    }
}

// دالة لتأخير تنفيذ الكود
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// دالة لتحويل النص إلى عنوان URL صالح
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

// دالة لتنسيق الأرقام
function formatNumber(num) {
    return new Intl.NumberFormat('ar-SA').format(num);
}

// دالة للتحقق من وجود العنصر في المصفوفة
function includes(array, item) {
    return Array.isArray(array) && array.includes(item);
}

// دالة لإنشاء عنصر HTML
function createElement(tag, attributes = {}, children = []) {
    const element = document.createElement(tag);
    
    // إضافة الخصائص
    Object.entries(attributes).forEach(([key, value]) => {
        if (key === 'className') {
            element.className = value;
        } else if (key === 'textContent') {
            element.textContent = value;
        } else {
            element.setAttribute(key, value);
        }
    });
    
    // إضافة العناصر الفرعية
    children.forEach(child => {
        if (typeof child === 'string') {
            element.appendChild(document.createTextNode(child));
        } else {
            element.appendChild(child);
        }
    });
    
    return element;
}

// إضافة أنماط CSS للتنبيهات
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// تصدير الدوال للاستخدام العام
window.helpers = {
    formatDate,
    generateId,
    isValidEmail,
    saveToStorage,
    getFromStorage,
    showNotification,
    fetchData,
    debounce,
    slugify,
    formatNumber,
    includes,
    createElement
}; 