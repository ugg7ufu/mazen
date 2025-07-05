<?php
// تضمين الهيدر
include_once 'includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">مرحباً بك في مساحة عمل PHP</h1>
                <p class="lead">بيئة تطوير متكاملة لـ PHP مع قاعدة بيانات MySQL</p>
                <hr class="my-4">
                <p>ابدأ بتطوير تطبيقات PHP قوية وآمنة</p>
                <a class="btn btn-primary btn-lg" href="<?= createLink('about') ?>" role="button">تعرف علينا</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">قاعدة البيانات</h5>
                    <p class="card-text">اتصال آمن بقاعدة بيانات MySQL مع PDO</p>
                    <a href="#" class="btn btn-outline-primary">استكشف</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">نظام المستخدمين</h5>
                    <p class="card-text">نظام تسجيل دخول آمن مع إدارة الجلسات</p>
                    <a href="#" class="btn btn-outline-primary">جرب</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">API RESTful</h5>
                    <p class="card-text">واجهات برمجة تطبيقات RESTful جاهزة</p>
                    <a href="#" class="btn btn-outline-primary">استخدم</a>
                </div>
            </div>
        </div>
    </div>

    <?php if (isLoggedIn()): ?>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="alert alert-success">
                <h6>مرحباً <?= htmlspecialchars($_SESSION['username']) ?>!</h6>
                <p>أنت مسجل دخول بنجاح. يمكنك الآن استخدام جميع الميزات.</p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>تسجيل الدخول</h5>
                </div>
                <div class="card-body">
                    <form action="<?= createLink('auth/login') ?>" method="POST">
                        <div class="form-group">
                            <label for="username">اسم المستخدم</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>إنشاء حساب جديد</h5>
                </div>
                <div class="card-body">
                    <form action="<?= createLink('auth/register') ?>" method="POST">
                        <div class="form-group">
                            <label for="reg_username">اسم المستخدم</label>
                            <input type="text" class="form-control" id="reg_username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_email">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="reg_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_password">كلمة المرور</label>
                            <input type="password" class="form-control" id="reg_password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success">إنشاء حساب</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row mt-4">
        <div class="col-md-12">
            <h3>معلومات النظام</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><strong>إصدار PHP:</strong></td>
                            <td><?= PHP_VERSION ?></td>
                        </tr>
                        <tr>
                            <td><strong>إصدار التطبيق:</strong></td>
                            <td><?= APP_VERSION ?></td>
                        </tr>
                        <tr>
                            <td><strong>وضع التطوير:</strong></td>
                            <td><?= DEBUG_MODE ? 'مفعل' : 'معطل' ?></td>
                        </tr>
                        <tr>
                            <td><strong>المنطقة الزمنية:</strong></td>
                            <td><?= date_default_timezone_get() ?></td>
                        </tr>
                        <tr>
                            <td><strong>IP المستخدم:</strong></td>
                            <td><?= getClientIP() ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// تضمين الفوتر
include_once 'includes/footer.php';
?> 