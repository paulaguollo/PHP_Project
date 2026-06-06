<?php
session_start();
require_once '../config/db.php';
require_once '../includes/header.php';

$db = new Database();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

$sql = "SELECT initiatives.*, users.name AS author, categories.name AS category 
        FROM initiatives 
        JOIN users ON initiatives.id_user = users.id_user
        JOIN categories ON initiatives.id_category = categories.id_category
        WHERE initiatives.id_initiative = :id";

$result = $db->fetchQuery($sql, ['id' => $id]);
$initiative = ($result['status'] === 'success' && !empty($result['data'])) ? $result['data'][0] : null;

if (!$initiative) {
    header('Location: index.php');
    exit;
}

$alreadyParticipating = false;
if (isset($_SESSION['id_user'])) {
    $sql = "SELECT * FROM participations 
            WHERE id_user = :id_user AND id_initiative = :id_initiative";
    $participationResult = $db->fetchQuery($sql, [
        'id_user' => $_SESSION['id_user'],
        'id_initiative' => $id
    ]);
    $alreadyParticipating = $participationResult['status'] === 'success' && !empty($participationResult['data']);
}

if (empty($result)) {
    header('Location: index.php');
    exit;
}

$initiative = $result[0];

$alreadyParticipating = false;
if (isset($_SESSION['id_user'])) {
    $sql = "SELECT * FROM participations 
            WHERE id_user = :id_user AND id_initiative = :id_initiative";
    $participation = $db->fetchQuery($sql, [
        'id_user' => $_SESSION['id_user'],
        'id_initiative' => $id
    ]);
    $alreadyParticipating = !empty($participation);
}
?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-sm btn-outline-secondary mb-4">← Back</a>

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h2><?= htmlspecialchars($initiative->title) ?></h2>
            <span class="badge-category"><?= htmlspecialchars($initiative->category) ?></span>
        </div>

        <p class="text-muted">Location<?= htmlspecialchars($initiative->location) ?></p>
        <p class="text-muted">User <?= htmlspecialchars($initiative->author) ?></p>
        <p class="text-muted">Date<?= $initiative->created_at ?></p>

        <hr>
        <p><?= htmlspecialchars($initiative->description) ?></p>

        <?php if ($initiative->impact_description): ?>
            <div class="alert alert-success mt-3">
                🌱 Impact: <?= htmlspecialchars($initiative->impact_description) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['id_user'])): ?>
            <hr>
            <?php if ($initiative->id_user == $_SESSION['id_user']): ?>
                <a href="edit.php?id=<?= $initiative->id_initiative ?>" class="btn btn-primary">Edit</a>
                <a href="delete.php?id=<?= $initiative->id_initiative ?>" class="btn btn-danger ms-2">Delete</a>
            <?php elseif ($alreadyParticipating): ?>
                <p class="text-success">You are already participating in this initiative.</p>
                <a href="../participations/cancel.php?id_initiative=<?= $initiative->id_initiative ?>" class="btn btn-outline-danger">Cancel participation</a>
            <?php else: ?>
                <a href="../participations/join.php?id_initiative=<?= $initiative->id_initiative ?>" class="btn btn-primary">Join initiative</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>