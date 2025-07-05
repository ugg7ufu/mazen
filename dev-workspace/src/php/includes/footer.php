    </div> <!-- End Main Content -->

    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-code me-2"></i><?= APP_NAME ?></h5>
                    <p class="text-muted">بيئة تطوير متكاملة لـ PHP</p>
                </div>
                <div class="col-md-4">
                    <h6>روابط سريعة</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= createLink('') ?>" class="text-muted">الرئيسية</a></li>
                        <li><a href="<?= createLink('about') ?>" class="text-muted">عن التطبيق</a></li>
                        <li><a href="<?= createLink('contact') ?>" class="text-muted">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>معلومات النظام</h6>
                    <ul class="list-unstyled text-muted">
                        <li>PHP: <?= PHP_VERSION ?></li>
                        <li>الإصدار: <?= APP_VERSION ?></li>
                        <li>الوقت: <?= date('Y-m-d H:i:s') ?></li>
                    </ul>
                </div>
            </div>
            <hr class="my-3">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0">
                        &copy; <?= date('Y') ?> <?= APP_NAME ?>. جميع الحقوق محفوظة.
                        <span class="text-muted">|</span>
                        تم التطوير بـ <i class="fas fa-heart text-danger"></i> و PHP
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // إخفاء رسائل التنبيه تلقائياً
        document.addEventListener('DOMContentLoaded', function() {
            // إخفاء التنبيهات بعد 5 ثوان
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // تفعيل tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // تفعيل popovers
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });
        
        // دالة لإظهار رسائل التنبيه
        function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            const container = document.querySelector('.container');
            container.insertBefore(alertDiv, container.firstChild);
            
            // إخفاء التنبيه بعد 5 ثوان
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alertDiv);
                bsAlert.close();
            }, 5000);
        }
        
        // دالة لتحميل البيانات من API
        async function fetchAPI(url, options = {}) {
            try {
                const response = await fetch(url, {
                    headers: {
                        'Content-Type': 'application/json',
                        ...options.headers
                    },
                    ...options
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                return await response.json();
            } catch (error) {
                console.error('API Error:', error);
                showAlert('حدث خطأ في الاتصال بالخادم', 'danger');
                throw error;
            }
        }
        
        // دالة لإرسال نموذج عبر AJAX
        function submitForm(formElement, successCallback = null) {
            const formData = new FormData(formElement);
            
            fetch(formElement.action, {
                method: formElement.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    if (successCallback) {
                        successCallback(data);
                    }
                } else {
                    showAlert(data.error || 'حدث خطأ', 'danger');
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                showAlert('حدث خطأ في إرسال النموذج', 'danger');
            });
        }
        
        // تفعيل النماذج AJAX
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form[data-ajax="true"]');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitForm(this);
                });
            });
        });
    </script>
</body>
</html> 