<?php
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

<div class="container">

    <div class="grove-hero">
        <div>
            <h1>Impact grows together.</h1>
            <p>Grove is a platform for people and communities to publish, discover and join sustainable impact initiatives.</p>
            <div class="d-flex gap-2 flex-wrap">
                <a href="initiatives/index.php" class="btn btn-primary">
                    <i class="bi bi-compass me-1"></i> Discover initiatives
                </a>
                <?php if (!isset($_SESSION['id_user'])): ?>
                    <a href="register.php" class="btn btn-outline-primary">Join Grove</a>
                <?php else: ?>
                    <a href="initiatives/create.php" class="btn btn-outline-primary">
                        <i class="bi bi-plus-lg me-1"></i> Create initiative
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="d-none d-md-block text-center">
           <img src="/assets/img/landing.png" alt="Grove" class="img-fluid" style="max-width: 500px;">
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <h2>Recent initiatives</h2>
        <a href="initiatives/index.php" class="btn btn-outline-secondary btn-sm">See all</a>
    </div>

    <?php if (empty($initiatives)): ?>
        <div class="text-center py-5">
            <i class="bi bi-tree fs-1 text-muted"></i>
            <p class="text-muted mt-3">No initiatives yet. Be the first to create one.</p>
            <a href="register.php" class="btn btn-primary mt-2">Get started</a>
        </div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($initiatives as $initiative): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card p-4 h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge-category"><?= htmlspecialchars($initiative->category) ?></span>
                        </div>
                        <h5 class="card-initiative mb-2"><?= htmlspecialchars($initiative->title) ?></h5>
                        <p class="text-muted mb-1">
                            <i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($initiative->location) ?>
                        </p>
                        <p class="text-muted mb-3 flex-grow-1"><?= htmlspecialchars($initiative->description) ?></p>
                        <a href="initiatives/detail.php?id=<?= $initiative->id_initiative ?>" class="btn btn-outline-primary btn-sm mt-auto">
                            View initiative <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php require_once 'includes/footer.php'; ?>