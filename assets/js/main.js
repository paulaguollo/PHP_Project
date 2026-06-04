// Auto-hide alerts after 4 seconds
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 4000);
    });
});

// Confirm before deleting
document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('form[action="doDelete.php"]');
    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm('Are you sure you want to delete this initiative?')) {
                e.preventDefault();
            }
        });
    });
});