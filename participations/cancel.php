<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';

$db = new Database();

if (!isset($_GET['id_initiative'])) {
    header('Location: manage.php');
    exit;
}

$id_initiative = $_GET['id_initiative'];
$id_user = $_SESSION['id_user'];

$sql = "DELETE FROM participations 
        WHERE id_user = :id_user AND id_initiative = :id_initiative";

$result = $db->executeQuery($sql, [
    'id_user' => $id_user,
    'id_initiative' => $id_initiative
]);

if ($result['status'] === 'success') {
    header('Location: manage.php?res=cancelled');
} else {
    header('Location: manage.php?res=error');
}
exit;
?>