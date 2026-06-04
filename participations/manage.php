<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$db = new Database();

$sql = "SELECT participations.*, initiatives.title, initiatives.location, categories.name AS category
        FROM participations
        JOIN initiatives ON participations.id_initiative = initiatives.id_initiative
        JOIN categories ON initiatives.id_category = categories.id_category
        WHERE participations.id_user = :id_user";

$result = $db->fetchQuery($sql, ['id_user' => $_SESSION['id_user']]);
$participations = $result['status'] === 'success' ? $result['data'] : [];
?>

<div class="container mt-5">
    <h2 class="mb-4">My participations</h2>

    <?php if (isset($_GET['res']) && $_GET['res'] === 'cancelled'): ?>
        <div class="alert alert-success">Participation cancelled successfully.</div>
    <?php endif; ?>

    <?php if (empty($participations)): ?>
        <p class="text-muted">You are not participating in any initiative yet. 
            <a href="../initiatives/index.php">Explore initiatives!</a>
        </p>
    <?php else: ?>
        <?php foreach ($participations as $participation): ?>
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5><?= htmlspecialchars($participation->title) ?></h5>
                        <p class="text-muted mb-1">Location <?= htmlspecialchars($participation->location) ?></p>
                        <span class="badge-category"><?= htmlspecialchars($participation->category) ?></span>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-secondary mb-2"><?= htmlspecialchars($participation->status) ?></span>
                        <br>
                        <a href="../initiatives/detail.php?id=<?= $participation->id_initiative ?>" class="btn btn-sm btn-primary">View</a>
                        <a href="cancel.php?id_initiative=<?= $participation->id_initiative ?>" class="btn btn-sm btn-outline-danger ms-1">Cancel</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>