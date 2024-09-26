<?php
session_start();
if(isset($_SESSION['user_id'])) {
    $_SESSION = [];
    session_destoy();
}
header("location: Connexion.php");
exist();
?>