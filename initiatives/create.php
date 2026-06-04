# Formulário de criação

<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$db = new Database();

$categories = $db->fetchQuery("SELECT * FROM categories", []);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h2 class="card-title mb-4">New initiative</h2>

                <?php if (isset($_GET['res']) && $_GET['res'] === 'error'): ?>
                    <div class="alert alert-danger">Error creating initiative. Please try again.</div>
                <?php endif; ?>

                <form action="doCreate.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Impact description</label>
                        <input type="text" name="impact_description" class="form-control" placeholder="Ex: 30 families benefited">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select name="id_category" class="form-select" required>
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id_category ?>">
                                    <?= htmlspecialchars($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create initiative</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>