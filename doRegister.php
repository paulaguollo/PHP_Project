<?php
session_start();
require_once 'config/db.php';

$db = new Database();

if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
    header('Location: register.php?res=error');
    exit;
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$birthdate = $_POST['birthdate'] ?? null;
$gender = $_POST['gender'] ?? null;

if (empty($name) || empty($email) || empty($_POST['password'])) {
    header('Location: register.php?res=error');
    exit;
}

$sql = "INSERT INTO users (name, email, password, birthdate, gender) VALUES (:name, :email, :password, :birthdate, :gender)";
$result = $db->executeQuery($sql, [
    'name' => $name,
    'email' => $email,
    'password' => $password,
    'birthdate' => $birthdate,
    'gender' => $gender
]);

if ($result > 0) {
    header('Location: login.php?res=ok');
} else {
    header('Location: register.php?res=error');
}
exit;
?>