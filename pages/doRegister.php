<?php
session_start();
require_once '../config/db.php';

$db = new Database();

if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) 
    //se nao existir (!isset) os dados passados pelo formulario (metodo POST)
    {
    header('Location: register.php?res=error');
    exit;  
}

$name = trim($_POST['name']); //o trim remove espaços antes da dado que pega do formulario (ex: name que vem do metodo POST)
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
//PASSWORD_DEFAULT usa o algoritmo de encriptação mais seguro recomendado atualmente. o hash é para encriptar a senha 
$birthdate = $_POST['birthdate'] ?? null; //como nao é obrigatório usa o ?? null para nao dar erro se nao tiver prenchido
$gender = $_POST['gender'] ?? null;

if (empty($name) || empty($email) || empty($_POST['password']) || strlen($_POST['password']) < 6) {
    header('Location: register.php?res=error');
    exit;
}

$sql = "INSERT INTO users (name, email, password, birthdate, gender) VALUES (:name, :email, :password, :birthdate, :gender)";
$result = $db->executeQuery($sql, [ //chamo a função e guardo na variavel result para usar
    'name' => $name,
    'email' => $email,
    'password' => $password,
    'birthdate' => $birthdate,
    'gender' => $gender
]);

if ($result['status'] === 'success') {
    header('Location: login.php?res=ok');
} else {
    header('Location: register.php?res=error');
}
exit;
?>