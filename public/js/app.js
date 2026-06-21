/**
 * User Management System - Client-Side JavaScript
 * Handles: form validation, delete modal, sidebar toggle, password toggle
 */

document.addEventListener('DOMContentLoaded', function () {

    // ============================================
    // SIDEBAR TOGGLE
    // ============================================
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    if (sidebarToggle && sidebar) {
        // Create overlay for mobile
        let overlay = document.querySelector('.sidebar-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.classList.add('sidebar-overlay');
            document.body.appendChild(overlay);
        }

        sidebarToggle.addEventListener('click', function () {
            if (window.innerWidth <= 991) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

    // ============================================
    // PASSWORD TOGGLE (Login Page)
    // ============================================
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    }

    // ============================================
    // FORM VALIDATION (Bootstrap 5 style)
    // ============================================
    const forms = document.querySelectorAll('#loginForm, #createUserForm, #editUserForm');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // ============================================
    // DELETE CONFIRMATION MODAL
    // ============================================
    const deleteModal = document.getElementById('deleteModal');
    const deleteButtons = document.querySelectorAll('.delete-btn');

    if (deleteModal && deleteButtons.length > 0) {
        const bsDeleteModal = new bootstrap.Modal(deleteModal);
        const deleteUserName = document.getElementById('deleteUserName');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');

                deleteUserName.textContent = userName;
                deleteForm.setAttribute('action', window.location.origin + '/users/delete/' + userId);

                bsDeleteModal.show();
            });
        });
    }

    // ============================================
    // AUTO-DISMISS FLASH ALERTS (after 5 seconds)
    // ============================================
    const flashAlerts = document.querySelectorAll('#flashSuccess, #flashError, #flashErrors');

    flashAlerts.forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }, 5000);
    });

});
