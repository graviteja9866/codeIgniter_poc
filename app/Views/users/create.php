<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-person-plus-fill me-2"></i>Create New User
                </h5>
            </div>
            <div class="card-body">
                <!-- Validation Errors -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('users/store') ?>" method="POST" id="createUserForm" novalidate>
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="first_name"
                                   name="first_name"
                                   placeholder="Enter first name"
                                   value="<?= old('first_name') ?>"
                                   required
                                   minlength="2"
                                   maxlength="100">
                            <div class="invalid-feedback">First name is required (min 2 characters).</div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="last_name"
                                   name="last_name"
                                   placeholder="Enter last name"
                                   value="<?= old('last_name') ?>"
                                   required
                                   minlength="2"
                                   maxlength="100">
                            <div class="invalid-feedback">Last name is required (min 2 characters).</div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   placeholder="user@example.com"
                                   value="<?= old('email') ?>"
                                   required
                                   maxlength="100">
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">
                                Mobile Number <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="mobile"
                                   name="mobile"
                                   placeholder="9876543210"
                                   value="<?= old('mobile') ?>"
                                   required
                                   minlength="10"
                                   maxlength="15">
                            <div class="invalid-feedback">Mobile number is required (10-15 digits).</div>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6">
                            <label for="department" class="form-label">
                                Department <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="department"
                                   name="department"
                                   placeholder="e.g. Engineering, Marketing, HR"
                                   value="<?= old('department') ?>"
                                   required
                                   maxlength="100">
                            <div class="invalid-feedback">Department is required.</div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="status" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <div class="invalid-feedback">Please select a status.</div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions mt-4">
                        <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back to Users
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
