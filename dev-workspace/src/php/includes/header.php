<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - مساحة عمل PHP</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        
        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .btn {
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .jumbotron {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 3rem;
        }
        
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        
        .nav-link {
            color: #34495e !important;
            font-weight: 600;
            margin: 0 0.5rem;
            border-radius: 25px;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: #667eea !important;
            color: white !important;
            transform: translateY(-2px);
        }
        
        .dropdown-menu {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .dropdown-item {
            border-radius: 10px;
            margin: 0.2rem;
        }
        
        .dropdown-item:hover {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= createLink('') ?>">
                <i class="fas fa-code me-2"></i>
                <?= APP_NAME ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= createLink('') ?>">
                            <i class="fas fa-home me-1"></i>
                            الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= createLink('about') ?>">
                            <i class="fas fa-info-circle me-1"></i>
                            عن التطبيق
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= createLink('contact') ?>">
                            <i class="fas fa-envelope me-1"></i>
                            اتصل بنا
                        </a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>
                            <?= htmlspecialchars($_SESSION['username']) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= createLink('profile') ?>">
                                <i class="fas fa-user-edit me-2"></i>الملف الشخصي
                            </a></li>
                            <li><a class="dropdown-item" href="<?= createLink('dashboard') ?>">
                                <i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= createLink('auth/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                            </a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= createLink('api/docs') ?>">
                            <i class="fas fa-book me-1"></i>
                            API Docs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div style="margin-top: 80px;">
        <!-- Flash Messages -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?= $_SESSION['flash_type'] ?? 'info' ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash_message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php 
            unset($_SESSION['flash_message']);
            unset($_SESSION['flash_type']);
            ?>
        <?php endif; ?> 