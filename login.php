<?php
session_start();
require_once 'includes/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h2 class="card-title mb-4">Login</h2>

                <?php if (isset($_GET['res'])): ?>
                    <?php if ($_GET['res'] === 'error'): ?>
                        <div class="alert alert-danger">Invalid email or password.</div>
                    <?php elseif ($_GET['res'] === 'ok'): ?>
                        <div class="alert alert-success">Account created successfully! You can now login.</div>
                    <?php endif; ?>
                <?php endif; ?>

                <form action="doLogin.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>