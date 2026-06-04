<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';

$db = new Database();

if (!isset($_POST['id_initiative'])) {
    header('Location: index.php');
    exit;
}

$id_initiative = $_POST['id_initiative'];
$id_user = $_SESSION['id_user'];

$sql = "DELETE FROM participations WHERE id_initiative = :id_initiative";
$db->executeQuery($sql, ['id_initiative' => $id_initiative]);

$sql = "DELETE FROM initiatives 
        WHERE id_initiative = :id_initiative AND id_user = :id_user";

$result = $db->executeQuery($sql, [
    'id_initiative' => $id_initiative,
    'id_user' => $id_user
]);

if ($result > 0) {
    header('Location: index.php?res=deleted');
} else {
    header('Location: index.php?res=error');
}
exit;
?>