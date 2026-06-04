<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$db = new Database();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM initiatives WHERE id_initiative = :id AND id_user = :id_user";
$result = $db->fetchQuery($sql, ['id' => $id, 'id_user' => $_SESSION['id_user']]);

if (empty($result)) {
    header('Location: index.php');
    exit;
}

$initiative = $result[0];
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 text-center">
                <h4 class="mb-3">Delete initiative</h4>
                <p>Are you sure you want to delete <strong><?= htmlspecialchars($initiative->title) ?></strong>?</p>
                <p class="text-muted">This action cannot be undone.</p>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <a href="detail.php?id=<?= $initiative->id_initiative ?>" class="btn btn-outline-secondary">Cancel</a>
                    <form action="doDelete.php" method="POST">
                        <input type="hidden" name="id_initiative" value="<?= $initiative->id_initiative ?>">
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>