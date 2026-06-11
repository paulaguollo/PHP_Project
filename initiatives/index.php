<?php
require_once '../config/db.php';
require_once '../includes/header.php';

$db = new Database();

$where = "WHERE 1=1"; //é sempre verdadeiro
$params = [];


//se o user escrever algo entao será buscado. 
//aqui é o filtro de pesquisa
if (!empty($_GET['search'])) {
    $where .= " AND (initiatives.title LIKE :search OR initiatives.description LIKE :search)";
    $params['search'] = '%' . $_GET['search'] . '%';
}

if (!empty($_GET['id_category'])) {
    $where .= " AND initiatives.id_category = :id_category";
    $params['id_category'] = $_GET['id_category'];
}

$sql = "SELECT initiatives.*, users.name AS author, categories.name AS category 
        FROM initiatives 
        JOIN users ON initiatives.id_user = users.id_user
        JOIN categories ON initiatives.id_category = categories.id_category
        $where
        ORDER BY initiatives.created_at DESC";

$result = $db->fetchQuery($sql, $params);
$initiatives = $result['status'] === 'success' ? $result['data'] : [];

$resultCategories = $db->fetchQuery("SELECT * FROM categories", []);
$categories = $resultCategories['status'] === 'success' ? $resultCategories['data'] : [];
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Initiatives</h2>
        <?php if (isset($_SESSION['id_user'])): ?>
            <a href="create.php" class="btn btn-primary">+ New initiative</a>
        <?php endif; ?>
    </div>

    <?php if (isset($_GET['res']) && $_GET['res'] === 'ok'): ?>
        <div class="alert alert-success">Initiative created successfully!</div>
    <?php endif; ?>

    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search initiatives..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="col-md-4">
                <select name="id_category" class="form-select">
                    <option value="">All categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id_category ?>" <?= (isset($_GET['id_category']) && $_GET['id_category'] == $category->id_category) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <?php if (empty($initiatives)): ?>
        <p class="text-muted">No initiatives found.</p>
    <?php else: ?>
        <?php foreach ($initiatives as $initiative): ?>
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <h5><?= htmlspecialchars($initiative->title) ?></h5>
                    <span class="badge-category"><?= htmlspecialchars($initiative->category) ?></span>
                </div>
                <p class="text-muted mb-1">📍 <?= htmlspecialchars($initiative->location) ?></p>
                <p><?= htmlspecialchars($initiative->description) ?></p>
                <a href="detail.php?id=<?= $initiative->id_initiative ?>" class="btn btn-sm btn-primary">View</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>