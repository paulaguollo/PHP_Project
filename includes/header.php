<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grove</title>
    <link rel="icon" type="image/png" href="/assets/img/landing.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/index.php">Grove</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <?php if (isset($_SESSION['id_user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/initiatives/index.php">Discover</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profile.php">Profile</a></li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="/initiatives/create.php">
                            <i class="bi bi-plus-lg me-1"></i>New initiative
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary btn-sm" href="/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/initiatives/index.php">Discover</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login.php">Login</a></li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="/register.php">Join Grove</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>