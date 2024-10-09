<?php
include 'config.php';

// Récupération de l'équipe de l'utilisateur connecté
$idU = $_SESSION['IdU'];  // On suppose que l'utilisateur est connecté et que son IdU est dans la session

// Contrôle si l'utilisateur est Scrum Master (désactivé pour test)
$isScrumMaster = true;  // Simuler que l'utilisateur est le Scrum Master

//Vérifier si le Scrum Master tente de démarrer le Planning Poker
$query = "SELECT IdR FROM rolesutilisateurprojet WHERE IdU = $idU AND IdR = 'SM'";
$result = $mysqli->query($query);
if ($result->num_rows == 0) {
    die("Erreur : Seul le Scrum Master peut démarrer une session de Planning Poker.");
}

// Marquer le Planning Poker comme actif pour l'équipe
$query = "UPDATE equipesprj SET PP = TRUE WHERE IdEq = (SELECT IdEq FROM rolesutilisateurprojet WHERE IdU = $idU LIMIT 1)";
$mysqli->query($query);

// Redirection vers la page de vote
header("Location: vote.php");
exit;
?>
