<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="dashboard-stats">
    <div class="row g-4">
        <!-- Total Users -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-primary">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number"><?= esc($totalUsers) ?></h3>
                        <p class="stat-label">Total Users</p>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="<?= base_url('users') ?>">
                        <span>View all users</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-success">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number"><?= esc($activeUsers) ?></h3>
                        <p class="stat-label">Active Users</p>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="<?= base_url('users?status=active') ?>">
                        <span>View active users</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Inactive Users -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-warning">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number"><?= esc($inactiveUsers) ?></h3>
                        <p class="stat-label">Inactive Users</p>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="<?= base_url('users?status=inactive') ?>">
                        <span>View inactive users</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- New This Month -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-info">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number"><?= esc($newThisMonth) ?></h3>
                        <p class="stat-label">New This Month</p>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="<?= base_url('users') ?>">
                        <span>View details</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Info Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card quick-info-card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-lightning-fill me-2 text-warning"></i>Quick Actions</h5>
                <div class="quick-actions">
                    <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill me-2"></i>Add New User
                    </a>
                    <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-table me-2"></i>View All Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
