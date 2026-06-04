<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';

$db = new Database();

if (!isset($_POST['id_initiative']) || !isset($_POST['title'])) {
    header('Location: index.php');
    exit;
}

$id_initiative = $_POST['id_initiative'];
$title = trim($_POST['title']);
$description = trim($_POST['description'] ?? '');
$location = trim($_POST['location'] ?? '');
$impact_description = trim($_POST['impact_description'] ?? '');
$id_category = $_POST['id_category'];
$id_user = $_SESSION['id_user'];

if (empty($title) || empty($id_category)) {
    header('Location: edit.php?id=' . $id_initiative . '&res=error');
    exit;
}

$sql = "UPDATE initiatives 
        SET title = :title, description = :description, location = :location, 
            impact_description = :impact_description, id_category = :id_category
        WHERE id_initiative = :id_initiative AND id_user = :id_user";

$result = $db->executeQuery($sql, [
    'title' => $title,
    'description' => $description,
    'location' => $location,
    'impact_description' => $impact_description,
    'id_category' => $id_category,
    'id_initiative' => $id_initiative,
    'id_user' => $id_user
]);

if ($result['status'] === 'success') {
    header('Location: detail.php?id=' . $id_initiative);
} else {
    header('Location: edit.php?id=' . $id_initiative . '&res=error');
}
exit;
?>