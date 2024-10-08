<?php
// Vérification si une session est déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérification si un message de succès est présent
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    // Supprimer le message après l'avoir affiché une fois
    unset($_SESSION['success_message']);
}

// Connexion à la base de données avec MySQLi
$mysqli = new mysqli('localhost', 'root', '', 'AgileTools');

// Vérification de la connexion
if ($mysqli->connect_error) {
    exit("Echec de la connexion : " . $mysqli->connect_error);
}

// Si vous souhaitez activer le mode rapport d'erreur
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>