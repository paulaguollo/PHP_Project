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
$initiative = ($result['status'] === 'success' && !empty($result['data'])) ? $result['data'][0] : null;

if (!$initiative) {
    header('Location: index.php');
    exit;
}

$resultCategories = $db->fetchQuery("SELECT * FROM categories", []);
$categories = $resultCategories['status'] === 'success' ? $resultCategories['data'] : [];
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h2 class="card-title mb-4">Edit initiative</h2>

                <?php if (isset($_GET['res']) && $_GET['res'] === 'error'): ?>
                    <div class="alert alert-danger">Error updating initiative. Please try again.</div>
                <?php endif; ?>

                <form action="doEdit.php" method="POST">
                    <input type="hidden" name="id_initiative" value="<?= $initiative->id_initiative ?>">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($initiative->title) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($initiative->description) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($initiative->location) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Impact description</label>
                        <input type="text" name="impact_description" class="form-control" value="<?= htmlspecialchars($initiative->impact_description) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select name="id_category" class="form-select" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id_category ?>" 
                                    <?= $category->id_category == $initiative->id_category ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>