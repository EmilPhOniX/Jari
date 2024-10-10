<?php
// Inclure la configuration et démarrer la session
require_once 'config.php';
include 'config.php';
include 'header.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['IdU'])) {
    exit("Erreur : Vous devez être connecté pour accéder à cette page.");
}

// Récupérer les tâches à faire
$query_tasks = "SELECT IdT, TitreT, UserStoryT, VotePP FROM taches"; // Ici l'IdEq est à 1, à adapter à ton projet
$result_tasks = $mysqli->query($query_tasks);

if ($result_tasks->num_rows > 0) {
    echo '</br></br></br></br><h2>Liste des Tâches</h2>';
    echo '<table border="1">
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>User Story</th>
                <th>Vote en cours</th>
                <th>Action</th>
            </tr>';
    
    while ($row = $result_tasks->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['IdT'] . '</td>
                <td>' . $row['TitreT'] . '</td>
                <td>' . $row['UserStoryT'] . '</td>
                <td>' . ($row['VotePP'] ? 'Oui' : 'Non') . '</td>';
        
        if (!$row['VotePP']) {
            // Bouton pour démarrer le vote
            echo '<td>
                    <form method="POST" action="start_vote.php">
                        <input type="hidden" name="IdT" value="' . $row['IdT'] . '">
                        <button type="submit">Voter au PP</button>
                    </form>
                  </td>';
        } else {
            echo '<td>Vote en cours</td>';
        }

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'Aucune tâche disponible.';
}

// Fermer la connexion à la base de données
$mysqli->close();
?>

