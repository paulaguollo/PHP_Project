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
//buscado da sessao. nao é enviado pelo cliente por isso nao tem a variavel POST

if (empty($title) || empty($id_category)) {
    header('Location: edit.php?id=' . $id_initiative . '&res=error');
    exit;
}

//o SET diz em qual lugar/coluna deve ter o update da tabela 
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

//o . serve como concatenação. ex: $id_initiative for 5, o resultado é 'detail.php?id=5' no browser
if ($result['status'] === 'success') {
    header('Location: detail.php?id=' . $id_initiative);
} else {
    header('Location: edit.php?id=' . $id_initiative . '&res=error');
}
exit;
?>