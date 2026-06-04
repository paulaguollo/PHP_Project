<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';

$db = new Database();

if (!isset($_POST['title']) || !isset($_POST['id_category'])) {
    header('Location: create.php?res=error');
    exit;
}

$title = trim($_POST['title']);
$description = trim($_POST['description'] ?? '');
$location = trim($_POST['location'] ?? '');
$impact_description = trim($_POST['impact_description'] ?? '');
$id_category = $_POST['id_category'];
$id_user = $_SESSION['id_user'];

if (empty($title) || empty($id_category)) {
    header('Location: create.php?res=error');
    exit;
}

$sql = "INSERT INTO initiatives (title, description, location, impact_description, id_user, id_category) 
        VALUES (:title, :description, :location, :impact_description, :id_user, :id_category)";

$result = $db->executeQuery($sql, [
    'title' => $title,
    'description' => $description,
    'location' => $location,
    'impact_description' => $impact_description,
    'id_user' => $id_user,
    'id_category' => $id_category
]);

if ($result > 0) {
    header('Location: index.php?res=ok');
} else {
    header('Location: create.php?res=error');
}
exit;
?>