<?php
session_start();
require_once 'includes/auth.php';
require_once 'config/db.php';
require_once 'includes/header.php';

$db = new Database();

$sql = "SELECT * FROM initiatives WHERE id_user = :id_user";
$resultInitiatives = $db->fetchQuery($sql, ['id_user' => $_SESSION['id_user']]);
$myInitiatives = $resultInitiatives['status'] === 'success' ? $resultInitiatives['data'] : [];

$sql = "SELECT participations.*, initiatives.title, initiatives.location, categories.name AS category
        FROM participations
        JOIN initiatives ON participations.id_initiative = initiatives.id_initiative
        JOIN categories ON initiatives.id_category = categories.id_category
        WHERE participations.id_user = :id_user";
$resultParticipations = $db->fetchQuery($sql, ['id_user' => $_SESSION['id_user']]);
$myParticipations = $resultParticipations['status'] === 'success' ? $resultParticipations['data'] : [];
?>

<div class="container mt-5">
    <h2 class="mb-4">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h3><?= count($myInitiatives) ?></h3>
                <p class="text-muted">My initiatives</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h3><?= count($myParticipations) ?></h3>
                <p class="text-muted">My participations</p>
            </div>
        </div>
    </div>

    <h4 class="mb-3">My initiatives</h4>
    <?php if (empty($myInitiatives)): ?>
        <p class="text-muted">No initiatives yet. <a href="initiatives/create.php">Create one!</a></p>
    <?php else: ?>
        <?php foreach ($myInitiatives as $initiative): ?>
            <div class="card p-3">
                <h5><?= htmlspecialchars($initiative->title) ?></h5>
                <p class="text-muted">📍 <?= htmlspecialchars($initiative->location) ?></p>
                <a href="initiatives/detail.php?id=<?= $initiative->id_initiative ?>" class="btn btn-sm btn-primary">View</a>
                <a href="initiatives/edit.php?id=<?= $initiative->id_initiative ?>" class="btn btn-sm btn-outline-secondary ms-1">Edit</a>
                <a href="initiatives/delete.php?id=<?= $initiative->id_initiative ?>" class="btn btn-sm btn-outline-danger ms-1">Delete</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h4 class="mt-5 mb-3">My participations</h4>
    <?php if (empty($myParticipations)): ?>
        <p class="text-muted">Not participating in any initiative yet. <a href="initiatives/index.php">Explore!</a></p>
    <?php else: ?>
        <?php foreach ($myParticipations as $participation): ?>
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5><?= htmlspecialchars($participation->title) ?></h5>
                        <p class="text-muted mb-0">📍 <?= htmlspecialchars($participation->location) ?></p>
                        <span class="badge-category"><?= htmlspecialchars($participation->category) ?></span>
                    </div>
                    <a href="participations/cancel.php?id_initiative=<?= $participation->id_initiative ?>" class="btn btn-sm btn-outline-danger">Cancel</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>