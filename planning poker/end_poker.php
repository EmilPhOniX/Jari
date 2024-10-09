<?php
include 'config.php';

// Récupérer l'utilisateur et l'équipe en cours
$idU = $_SESSION['IdU'];
$idEq = 1;  // On suppose que l'utilisateur appartient à l'équipe 1

// Contrôle si l'utilisateur est Scrum Master (désactivé pour test)
$isScrumMaster = true;  // Simuler que l'utilisateur est le Scrum Master

// Vérifier si le Scrum Master clôture le Planning Poker (code en commentaire)
// $query = "SELECT IdR FROM rolesutilisateurprojet WHERE IdU = $idU AND IdR = 'SM'";
// $result = $mysqli->query($query);
// if ($result->num_rows == 0) {
//     die("Erreur : Seul le Scrum Master peut clôturer une session de Planning Poker.");
// }

// Mettre à jour l'état du Planning Poker à 'inactif'
$query = "UPDATE equipesprj SET PP = FALSE WHERE IdEq = $idEq";
$mysqli->query($query);

// Clôturer le vote pour toutes les tâches
$query = "UPDATE taches SET VotePP = FALSE WHERE IdEq = $idEq";
$mysqli->query($query);

// Redirection vers la page d'accueil
header("Location: index.php");
exit;
?>
