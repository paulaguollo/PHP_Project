<?php
// "Guarda" de autenticação: incluir este ficheiro no topo de uma página torna-a privada
// Garante que existe sessão ativa (evita erro se ainda não foi iniciada noutro ficheiro)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se não houver utilizador autenticado na sessão, redireciona para o login e termina a execução
if (!isset($_SESSION['id_user'])) {
    header('Location: ../pages/login.php');
    exit();
}
?>