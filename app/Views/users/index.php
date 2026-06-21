<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Search & Filter Bar -->
<div class="card filter-card mb-4">
    <div class="card-body">
        <form action="<?= base_url('users') ?>" method="GET" id="filterForm">
            <div class="row g-3 align-items-end">
                <!-- Search -->
                <div class="col-md-4">
                    <label for="search" class="form-label">
                        <i class="bi bi-search me-1"></i>Search
                    </label>
                    <input type="text"
                           class="form-control"
                           id="search"
                           name="search"
                           placeholder="Search by name, email, or mobile..."
                           value="<?= esc($search ?? '') ?>">
                </div>

                <!-- Department Filter -->
                <div class="col-md-3">
                    <label for="department" class="form-label">
                        <i class="bi bi-building me-1"></i>Department
                    </label>
                    <select class="form-select" id="department" name="department">
                        <option value="">All Departments</option>
                        <?php if (! empty($departments)): ?>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= esc($dept['department']) ?>"
                                    <?= ($department ?? '') === $dept['department'] ? 'selected' : '' ?>>
                                    <?= esc($dept['department']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="col-md-2">
                    <label for="status" class="form-label">
                        <i class="bi bi-funnel me-1"></i>Status
                    </label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All Status</option>
                        <option value="active" <?= ($status ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($status ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i>Search
                        </button>
                        <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>Clear
                        </a>
                        <a href="<?= base_url('users/create') ?>" class="btn btn-success">
                            <i class="bi bi-plus-circle me-1"></i>Add User
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="card users-table-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-people-fill me-2"></i>User List
            <span class="badge bg-primary ms-2"><?= count($users) ?></span>
        </h5>
    </div>
    <div class="card-body p-0">
        <?php if (! empty($users)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><span class="fw-semibold text-muted">#<?= esc($user['id']) ?></span></td>
                                <td>
                                    <div class="user-name-cell">
                                        <div class="user-avatar">
                                            <?= strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1)) ?>
                                        </div>
                                        <span><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></span>
                                    </div>
                                </td>
                                <td><?= esc($user['email']) ?></td>
                                <td><?= esc($user['mobile']) ?></td>
                                <td>
                                    <span class="badge bg-light text-dark department-badge">
                                        <?= esc($user['department']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user['status'] === 'active'): ?>
                                        <span class="badge bg-success-subtle text-success status-badge">
                                            <i class="bi bi-check-circle-fill me-1"></i>Active
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning status-badge">
                                            <i class="bi bi-x-circle-fill me-1"></i>Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="<?= base_url('users/edit/' . $user['id']) ?>"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger delete-btn"
                                                data-id="<?= $user['id'] ?>"
                                                data-name="<?= esc($user['first_name'] . ' ' . $user['last_name']) ?>"
                                                title="Delete User">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h5>No users found</h5>
                <p>Try adjusting your search or filter criteria.</p>
                <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New User
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteUserName"></strong>?</p>
                <p class="text-muted small">This action will soft-delete the user. They can be restored later if needed.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x me-1"></i>Cancel
                </button>
                <form id="deleteForm" method="POST">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash3 me-1"></i>Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
