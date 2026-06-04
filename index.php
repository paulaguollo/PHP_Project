<?php
session_start();
require_once 'config/db.php';
require_once 'includes/header.php';

$db = new Database();

$sql = "SELECT initiatives.*, users.name AS author, categories.name AS category
        FROM initiatives
        JOIN users ON initiatives.id_user = users.id_user
        JOIN categories ON initiatives.id_category = categories.id_category
        ORDER BY initiatives.created_at DESC
        LIMIT 6";

$result = $db->fetchQuery($sql, []);
$initiatives = $result['status'] === 'success' ? $result['data'] : [];
?>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h1>🌿 Grove</h1>
        <p class="lead text-muted">Where impact grows.</p>
        <?php if (!isset($_SESSION['id_user'])): ?>
            <a href="register.php" class="btn btn-primary me-2">Join Grove</a>
            <a href="login.php" class="btn btn-outline-secondary">Login</a>
        <?php else: ?>
            <a href="initiatives/create.php" class="btn btn-primary me-2">+ New initiative</a>
            <a href="dashboard.php" class="btn btn-outline-secondary">Dashboard</a>
        <?php endif; ?>
    </div>

    <h4 class="mb-4">Recent initiatives</h4>

    <?php if (empty($initiatives)): ?>
        <p class="text-muted text-center">No initiatives yet. Be the first to create one!</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($initiatives as $initiative): ?>
                <div class="col-md-6 mb-3">
                    <div class="card p-3 h-100">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="mb-0"><?= htmlspecialchars($initiative->title) ?></h5>
                            <span class="badge-category"><?= htmlspecialchars($initiative->category) ?></span>
                        </div>
                        <p class="text-muted mb-1">📍 <?= htmlspecialchars($initiative->location) ?></p>
                        <p class="mb-3"><?= htmlspecialchars($initiative->description) ?></p>
                        <a href="initiatives/detail.php?id=<?= $initiative->id_initiative ?>" class="btn btn-sm btn-primary mt-auto">View</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="initiatives/index.php" class="btn btn-outline-secondary">See all initiatives</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>