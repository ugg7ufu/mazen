/**
 * الملف الرئيسي للتطبيق
 * يحتوي على منطق التطبيق الأساسي
 */

// انتظار تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    console.log('تم تحميل مساحة عمل التطوير بنجاح!');
    
    // تهيئة التطبيق
    initApp();
    
    // إضافة مستمعي الأحداث
    addEventListeners();
    
    // عرض رسالة ترحيب
    if (window.helpers) {
        window.helpers.showNotification('مرحباً بك في مساحة عمل التطوير!', 'success');
    }
});

/**
 * تهيئة التطبيق
 */
function initApp() {
    // حفظ تاريخ آخر زيارة
    const lastVisit = new Date();
    if (window.helpers) {
        window.helpers.saveToStorage('lastVisit', lastVisit.toISOString());
    }
    
    // تحديث التاريخ في الصفحة
    updateDateTime();
    
    // تحميل الإعدادات المحفوظة
    loadSettings();
}

/**
 * إضافة مستمعي الأحداث
 */
function addEventListeners() {
    // التنقل السلس
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // تفاعل مع بطاقات التقنيات
    const techCards = document.querySelectorAll('.tech-card');
    techCards.forEach(card => {
        card.addEventListener('click', function() {
            const techName = this.querySelector('h3').textContent;
            showTechDetails(techName);
        });
    });
    
    // إضافة تأثيرات التمرير
    window.addEventListener('scroll', debounce(handleScroll, 10));
}

/**
 * تحديث التاريخ والوقت
 */
function updateDateTime() {
    const now = new Date();
    const dateTimeElement = document.querySelector('.date-time');
    
    if (dateTimeElement && window.helpers) {
        const formattedDate = window.helpers.formatDate(now);
        dateTimeElement.textContent = formattedDate;
    }
}

/**
 * تحميل الإعدادات المحفوظة
 */
function loadSettings() {
    if (window.helpers) {
        const settings = window.helpers.getFromStorage('appSettings');
        if (settings) {
            // تطبيق الإعدادات المحفوظة
            console.log('تم تحميل الإعدادات:', settings);
        }
    }
}

/**
 * عرض تفاصيل التقنية المختارة
 */
function showTechDetails(techName) {
    const techInfo = {
        'Frontend': {
            description: 'تطوير واجهات المستخدم التفاعلية',
            tools: ['HTML5', 'CSS3', 'JavaScript', 'React', 'Vue.js', 'Angular'],
            resources: ['MDN Web Docs', 'W3Schools', 'CSS-Tricks']
        },
        'Backend': {
            description: 'تطوير الخوادم وقواعد البيانات',
            tools: ['Node.js', 'Python', 'PHP', 'Java', 'C#', 'Go'],
            resources: ['Node.js Docs', 'Python Docs', 'PHP Manual']
        },
        'أدوات': {
            description: 'أدوات مساعدة في التطوير',
            tools: ['Git', 'VS Code', 'Docker', 'Webpack', 'Postman'],
            resources: ['Git Docs', 'VS Code Docs', 'Docker Docs']
        }
    };
    
    const info = techInfo[techName];
    if (info && window.helpers) {
        const message = `${techName}: ${info.description}`;
        window.helpers.showNotification(message, 'info');
        
        // يمكن إضافة المزيد من التفاصيل هنا
        console.log(`تفاصيل ${techName}:`, info);
    }
}

/**
 * معالجة التمرير
 */
function handleScroll() {
    const scrollTop = window.pageYOffset;
    const header = document.querySelector('header');
    
    if (header) {
        if (scrollTop > 100) {
            header.style.background = 'rgba(255, 255, 255, 0.98)';
            header.style.boxShadow = '0 2px 30px rgba(0, 0, 0, 0.15)';
        } else {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
        }
    }
}

/**
 * دالة debounce محسنة
 */
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

/**
 * دالة لإنشاء مشروع جديد
 */
function createNewProject(projectType) {
    const projectId = window.helpers ? window.helpers.generateId() : Date.now();
    const project = {
        id: projectId,
        name: `مشروع ${projectType} جديد`,
        type: projectType,
        createdAt: new Date().toISOString(),
        status: 'قيد التطوير'
    };
    
    // حفظ المشروع
    if (window.helpers) {
        const projects = window.helpers.getFromStorage('projects') || [];
        projects.push(project);
        window.helpers.saveToStorage('projects', projects);
        
        window.helpers.showNotification('تم إنشاء المشروع بنجاح!', 'success');
    }
    
    return project;
}

/**
 * دالة لتصدير المشروع
 */
function exportProject(projectId) {
    if (window.helpers) {
        const projects = window.helpers.getFromStorage('projects') || [];
        const project = projects.find(p => p.id === projectId);
        
        if (project) {
            const dataStr = JSON.stringify(project, null, 2);
            const dataBlob = new Blob([dataStr], {type: 'application/json'});
            
            const link = document.createElement('a');
            link.href = URL.createObjectURL(dataBlob);
            link.download = `${project.name}.json`;
            link.click();
            
            window.helpers.showNotification('تم تصدير المشروع بنجاح!', 'success');
        }
    }
}

// تصدير الدوال للاستخدام العام
window.app = {
    createNewProject,
    exportProject,
    showTechDetails
};

// تحديث التاريخ كل دقيقة
setInterval(updateDateTime, 60000); 