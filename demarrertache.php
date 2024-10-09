<?php
// Inclure la configuration et démarrer la session
require_once 'config.php';
include "header.php";

// Vérifier que l'utilisateur est connecté et récupérer son Id
if (!isset($_SESSION['IdU'])) {
    exit("Erreur : Vous devez être connecté pour accéder à cette page.");
}

$IdU = $_SESSION['IdU'];
$IdT = $_POST['IdT']; // L'Id de la tâche à évaluer vient du formulaire

// Vérifier que l'utilisateur est Scrum Master de l'équipe de la tâche
// $query_check_sm = "SELECT IdR FROM rolesutilisateurprojet 
//                    WHERE IdU = ? AND IdEq = (SELECT IdEq FROM taches WHERE IdT = ?) AND IdR = 'SM'";
// $stmt_check_sm = $mysqli->prepare($query_check_sm);
// $stmt_check_sm->bind_param("ii", $IdU, $IdT);
// $stmt_check_sm->execute();
// $result_check_sm = $stmt_check_sm->get_result();

// if ($result_check_sm->num_rows == 0) {
//     exit("Erreur : Seul le Scrum Master peut démarrer le vote pour cette tâche.");
// }

// Fermer le statement
//$stmt_check_sm->close();

// Mettre à jour la table taches : désactiver VotePP pour toutes les autres tâches de l'équipe
$query_reset_vote = "UPDATE taches SET VotePP = false WHERE IdEq = (SELECT IdEq FROM taches WHERE IdT = ?)";
$stmt_reset_vote = $mysqli->prepare($query_reset_vote);
$stmt_reset_vote->bind_param("i", $IdT);
$stmt_reset_vote->execute();
$stmt_reset_vote->close();

// Activer VotePP pour la tâche sélectionnée
$query_start_vote = "UPDATE taches SET VotePP = true WHERE IdT = ?";
$stmt_start_vote = $mysqli->prepare($query_start_vote);
$stmt_start_vote->bind_param("i", $IdT);

if ($stmt_start_vote->execute()) {
    echo "Le vote pour la tâche a été démarré avec succès.";
} else {
    echo "Erreur lors du démarrage du vote.";
}

// Fermer le statement et la connexion
$stmt_start_vote->close();
$mysqli->close();
?>


<form method="POST" action="start_vote.php">
    <input type="hidden" name="IdT" value="1"> <!-- l'Id de la tâche -->
    <button type="submit">Démarrer le vote</button>
</form>