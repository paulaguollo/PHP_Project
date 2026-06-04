<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/db.php';

$db = new Database();

if (!isset($_GET['id_initiative'])) {
    header('Location: ../initiatives/index.php');
    exit;
}

$id_initiative = $_GET['id_initiative'];
$id_user = $_SESSION['id_user'];

$sqlCheck = "SELECT * FROM initiatives WHERE id_initiative = :id_initiative AND id_user = :id_user";
$isOwner = $db->fetchQuery($sqlCheck, ['id_initiative' => $id_initiative, 'id_user' => $id_user]);

if ($isOwner['status'] === 'success' && !empty($isOwner['data'])) {
    header('Location: ../initiatives/detail.php?id=' . $id_initiative . '&res=owner');
    exit;
}

$sqlCheck = "SELECT * FROM participations WHERE id_user = :id_user AND id_initiative = :id_initiative";
$alreadyJoined = $db->fetchQuery($sqlCheck, ['id_user' => $id_user, 'id_initiative' => $id_initiative]);

if ($alreadyJoined['status'] === 'success' && !empty($alreadyJoined['data'])) {
    header('Location: ../initiatives/detail.php?id=' . $id_initiative . '&res=duplicate');
    exit;
}

$sql = "INSERT INTO participations (id_user, id_initiative) VALUES (:id_user, :id_initiative)";
$result = $db->executeQuery($sql, ['id_user' => $id_user, 'id_initiative' => $id_initiative]);

if ($result['status'] === 'success') {
    header('Location: ../initiatives/detail.php?id=' . $id_initiative . '&res=joined');
} else {
    header('Location: ../initiatives/detail.php?id=' . $id_initiative . '&res=error');
}
exit;
?>