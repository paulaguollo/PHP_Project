<?php
session_start();
require_once 'config/db.php';

$db = new Database();

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header('Location: login.php?res=error');
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    header('Location: login.php?res=error');
    exit;
}

$sql = "SELECT * FROM users WHERE email = :email";
$result = $db->fetchQuery($sql, ['email' => $email]);

if (!empty($result) && password_verify($password, $result[0]->password)) {
    $_SESSION['id_user'] = $result[0]->id_user;
    $_SESSION['name'] = $result[0]->name;
    header('Location: dashboard.php');
} else {
    header('Location: login.php?res=error');
}
exit;
?>