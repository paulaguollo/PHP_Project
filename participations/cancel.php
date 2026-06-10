<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

$db = new Database();

if (!isset($_POST['id_initiative'])) {
    header('Location: /pages/profile.php');
    exit;
}

$id_initiative = $_POST['id_initiative'];
$id_user = $_SESSION['id_user'];

$sql = "DELETE FROM participations 
        WHERE id_user = :id_user AND id_initiative = :id_initiative";

$result = $db->executeQuery($sql, [
    'id_user' => $id_user,
    'id_initiative' => $id_initiative
]);

if ($result['status'] === 'success') {
    header('Location: /pages/profile.php?res=cancelled');
} else {
    header('Location: /pages/profile.php?res=error');
}
exit;
?>