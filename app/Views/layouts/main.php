<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="User Management System - CodeIgniter 4">
    <title><?= esc($pageTitle ?? 'Dashboard') ?> | User Management System</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>UMS Panel</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="<?= base_url('dashboard') ?>" class="<?= (url_is('dashboard*')) ? 'active' : '' ?>">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('users') ?>" class="<?= (url_is('users*')) ? 'active' : '' ?>">
                            <i class="bi bi-people-fill"></i>
                            <span>Users</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <div class="admin-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="admin-details">
                        <span class="admin-name"><?= esc(session()->get('admin_name') ?? 'Admin') ?></span>
                        <span class="admin-role">Administrator</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1 class="page-title"><?= esc($pageTitle ?? 'Dashboard') ?></h1>
                </div>
                <div class="navbar-right">
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle admin-dropdown" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= esc(session()->get('admin_name') ?? 'Admin') ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="content-area">
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="flashSuccess">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?= esc(session()->getFlashdata('success')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flashError">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= esc(session()->getFlashdata('error')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>



                <!-- Page-specific content rendered here -->
                <?= $this->renderSection('content') ?>
            </main>

            <!-- Footer -->
            <footer class="app-footer">
                <span>&copy; <?= date('Y') ?> User Management System. Built with CodeIgniter 4.</span>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>
