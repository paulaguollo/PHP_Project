## VAI ESTAR PRAS PAGINAS PRIVADAS
## TEM QUE TER SESSAO ATIVA

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_user'])) {
    header('Location: ../login.php');
    exit();
}
?>