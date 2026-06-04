<?php
session_start();
require_once '../config/db.php';
require_once '../includes/header.php';

$db = new Database();

$sql = "SELECT initiatives.*, users.name AS author, categories.name AS category 
        FROM initiatives 
        JOIN users ON initiatives.id_user = users.id_user
        JOIN categories ON initiatives.id_category = categories.id_category
        ORDER BY initiatives.created_at DESC";

$result = $db->fetchQuery($sql, []);
$initiatives = $result['status'] === 'success' ? $result['data'] : [];
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Initiatives </h2>
        <?php if (isset($_SESSION['id_user'])): ?>
            <a href="create.php" class="btn btn-primary">+ New initiative</a>
        <?php endif; ?>
    </div>

    <?php if (isset($_GET['res']) && $_GET['res'] === 'ok'): ?>
        <div class="alert alert-success">Initiative created successfully!</div>
    <?php endif; ?>

    <?php if (empty($initiatives)): ?>
        <p class="text-muted">No initiatives yet. Be the first to create one!</p>
    <?php else: ?>
        <?php foreach ($initiatives as $initiative): ?>
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <h5><?= htmlspecialchars($initiative->title) ?></h5>
                    <span class="badge-category"><?= htmlspecialchars($initiative->category) ?></span>
                </div>
                <p class="text-muted mb-1">Location <?= htmlspecialchars($initiative->location) ?></p>
                <p><?= htmlspecialchars($initiative->description) ?></p>
                <a href="detail.php?id=<?= $initiative->id_initiative ?>" class="btn btn-sm btn-primary">View</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>