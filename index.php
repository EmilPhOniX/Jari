<?php 
include "aside.php"; 
include "header.php";

if (!isset($_SESSION['idUser'])) {
    header("Location: connexion.php");
    exit();
}

?>