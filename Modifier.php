<?php
// Fichier config.php pour la connexion à la base de données
include "config.php";

// Vérification de la connexion
// Récupération de l'action
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Traitement des actions

// Ajouter un membre au projet
if ($action == 'ajouter_membre') {
    $IdU = $_POST['IdU'];
    $IdR = $_POST['IdR'];
    $IdEq = $_POST['IdEq'];
    $sql = "INSERT INTO affectation (IdU, IdR, IdEq) VALUES ('$IdU', '$IdR', '$IdEq')";
    if ($conn->query($sql) === TRUE) {
        echo "Membre ajouté avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Affecter un rôle à un membre
if ($action == 'affecter_role') {
    $IdU = $_POST['IdU'];
    $IdR = $_POST['IdR'];
    $IdEq = $_POST['IdEq'];
    $sql = "UPDATE affectation SET IdR='$IdR' WHERE IdU='$IdU' AND IdEq='$IdEq'";
    if ($conn->query($sql) === TRUE) {
        echo "Rôle affecté avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Ajouter une tâche au Product Backlog
if ($action == 'ajouter_tache') {
    $TitreT = $_POST['TitreT'];
    $UserStoryT = $_POST['UserStoryT'];
    $IdEq = $_POST['IdEq'];
    $CoutT = $_POST['CoutT'];
    $IdPriorite = $_POST['IdPriorite'];
    $sql = "INSERT INTO tache (TitreT, UserStoryT, IdEq, CoutT, IdPriorite) VALUES ('$TitreT', '$UserStoryT', '$IdEq', '$CoutT', '$IdPriorite')";
    if ($conn->query($sql) === TRUE) {
        echo "Tâche ajoutée au Product Backlog avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Créer un sprint
if ($action == 'creer_sprint') {
    $DateDebS = $_POST['DateDebS'];
    $DateFinS = $_POST['DateFinS'];
    $IdEq = $_POST['IdEq'];
    $VelociteEq = $_POST['VelociteEq'];
    $sql = "INSERT INTO sprint (DateDebS, DateFinS, IdEq, VelociteEq) VALUES ('$DateDebS', '$DateFinS', '$IdEq', '$VelociteEq')";
    if ($conn->query($sql) === TRUE) {
        echo "Sprint créé avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Affecter une tâche à un sprint
if ($action == 'affecter_tache_sprint') {
    $IdT = $_POST['IdT'];
    $IdS = $_POST['IdS'];
    $IdU = $_POST['IdU'];
    $sql = "INSERT INTO sprint_tache (IdT, IdS, IdU) VALUES ('$IdT', '$IdS', '$IdU')";
    if ($conn->query($sql) === TRUE) {
        echo "Tâche affectée au sprint avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Lancer une session de Planning Poker
if ($action == 'lancer_planning_poker') {
    $IdEq = $_POST['IdEq'];
    // Implémentation de la logique de planning poker ici
    echo "Session de Planning Poker lancée pour l'équipe $IdEq.";
}

// Saisir un vote dans Planning Poker
if ($action == 'vote_planning_poker') {
    $IdU = $_POST['IdU'];
    $IdT = $_POST['IdT'];
    $estimationCout = $_POST['estimationCout'];
    $sql = "INSERT INTO planning_poker (IdU, IdT, estimationCout) VALUES ('$IdU', '$IdT', '$estimationCout')";
    if ($conn->query($sql) === TRUE) {
        echo "Vote enregistré avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Saisie des rapports de sprint
if ($action == 'saisie_rapport_sprint') {
    $IdS = $_POST['IdS'];
    $RevueS = $_POST['RevueS'];
    $RetrospectiveS = $_POST['RetrospectiveS'];
    $sql = "INSERT INTO rapport_sprint (IdS, RevueS, RetrospectiveS) VALUES ('$IdS', '$RevueS', '$RetrospectiveS')";
    if ($conn->query($sql) === TRUE) {
        echo "Rapports de sprint saisis avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Projet - Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion de Projet</h1>

    <!-- Formulaire d'ajout de membre au projet -->
    <h2>Ajouter un membre au projet</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="ajouter_membre">
        ID Utilisateur: <input type="text" name="IdU" required><br>
        Rôle (PO, SM, MA): <input type="text" name="IdR" required><br>
        ID Équipe: <input type="text" name="IdEq" required><br>
        <input type="submit" value="Ajouter Membre">
    </form>

    <!-- Formulaire pour affecter un rôle -->
    <h2>Affecter un rôle à un membre</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="affecter_role">
        ID Utilisateur: <input type="text" name="IdU" required><br>
        Nouveau Rôle: <input type="text" name="IdR" required><br>
        ID Équipe: <input type="text" name="IdEq" required><br>
        <input type="submit" value="Affecter Rôle">
    </form>

    <!-- Formulaire pour ajouter une tâche au Product Backlog -->
    <h2>Ajouter une tâche au Product Backlog</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="ajouter_tache">
        Titre de la Tâche: <input type="text" name="TitreT" required><br>
        User Story: <input type="text" name="UserStoryT" required><br>
        ID Équipe: <input type="text" name="IdEq" required><br>
        Coût de la Tâche: <input type="number" name="CoutT" required><br>
        Priorité (1: Haute, 2: Moyenne, 3: Basse): <input type="number" name="IdPriorite" required><br>
        <input type="submit" value="Ajouter Tâche">
    </form>

    <!-- Formulaire pour créer un sprint -->
    <h2>Créer un sprint</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="creer_sprint">
        Date de Début: <input type="date" name="DateDebS" required><br>
        Date de Fin: <input type="date" name="DateFinS" required><br>
        ID Équipe: <input type="text" name="IdEq" required><br>
        Vélocité de l'équipe: <input type="number" name="VelociteEq" required><br>
        <input type="submit" value="Créer Sprint">
    </form>

    <!-- Formulaire pour affecter une tâche à un sprint -->
    <h2>Affecter une tâche à un sprint</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="affecter_tache_sprint">
        ID Tâche: <input type="text" name="IdT" required><br>
        ID Sprint: <input type="text" name="IdS" required><br>
        ID Utilisateur: <input type="text" name="IdU" required><br>
        <input type="submit" value="Affecter Tâche">
    </form>

    <!-- Formulaire pour lancer une session de Planning Poker -->
    <h2>Lancer une session de Planning Poker</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="lancer_planning_poker">
        ID Équipe: <input type="text" name="IdEq" required><br>
        <input type="submit" value="Lancer Planning Poker">
    </form>

    <!-- Formulaire pour saisir un vote dans Planning Poker -->
    <h2>Saisir un vote de Planning Poker</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="vote_planning_poker">
        ID Utilisateur: <input type="text" name="IdU" required><br>
        ID Tâche: <input type="text" name="IdT" required><br>
        Estimation du Coût: <input type="number" name="estimationCout" required><br>
        <input type="submit" value="Enregistrer Vote">
    </form>

    <!-- Formulaire pour saisir les rapports d'activité d'un sprint -->
    <h2>Saisie des rapports de sprint (Mêlées, Rétrospective)</h2>
    <form action="modifier.php" method="POST">
        <input type="hidden" name="action" value="saisie_rapport_sprint">
        ID Sprint: <input type="text" name="IdS" required><br>
        Revue Sprint: <textarea name="RevueS" required></textarea><br>
        Rétrospective Sprint: <textarea name="RetrospectiveS" required></textarea><br>
        <input type="submit" value="Saisir Rapports">
    </form>
</body>
</html>
