<?php
include 'config.php';

// Récupérer l'utilisateur et l'équipe en cours
$idU = $_SESSION['IdU'];  // Simuler que l'utilisateur est connecté
$idEq = 1;  // On suppose que l'utilisateur appartient à l'équipe 1

// Récupérer la tâche en cours de vote
$query = "SELECT * FROM taches WHERE VotePP = TRUE AND IdEq = $idEq LIMIT 1";
$result = $mysqli->query($query);
$tache = $result->fetch_assoc();

if (!$tache) {
    die("Aucune tâche n'est actuellement en cours de vote.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estimation = $_POST['estimation'];

    // Enregistrer le vote de l'utilisateur
    $query = "INSERT INTO VoterPP (IdU, IdT, estimationCout) VALUES ($idU, {$tache['IdT']}, '$estimation')
              ON DUPLICATE KEY UPDATE estimationCout = '$estimation'";
    $mysqli->query($query);

    // Message de succès
    $_SESSION['success_message'] = "Votre vote a bien été enregistré.";

    // Redirection pour éviter de renvoyer le formulaire lors du rafraîchissement
    header("Location: vote.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vote Planning Poker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Vote pour la tâche : <?php echo $tache['TitreT']; ?></h1>
    <p><?php echo $tache['UserStoryT']; ?></p>

    <form method="post">
        <label for="estimation">Estimation du coût :</label>
        <select name="estimation" id="estimation">
            <option value="1">1</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="25">25</option>
            <option value="999">999 (Complexité maximale)</option>
        </select>
        <button type="submit">Envoyer le vote</button>
    </form>

    <?php if (isset($success_message)) : ?>
        <p><?php echo $success_message; ?></p>
    <?php endif; ?>
</body>
</html>
