<?php
session_start();
session_destroy(); //logout
header('Location: login.php');
exit;
?>