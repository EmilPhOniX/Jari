

<!-- 


 A GARDER ABSOLUMENT ICI POUR LA PAGE SCRUMMASTER  







 

if (!$equipes) {
     die("Vous n'êtes Scrum Master dans aucune équipe.");
}

// Traitement des modifications
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour d'un sprint
    if (isset($_POST['update_sprint'])) {
        $idS = $_POST['sprint_id'];
        $retrospective = $_POST['retrospective'];
        $revue = $_POST['revue'];
        $dateDeb = $_POST['date_debut'];
        $dateFin = $_POST['date_fin'];
        $velocite = $_POST['velocite'];

        $query = $pdo->prepare("
            UPDATE sprints 
            SET RetrospectiveS = :retrospective, RevueS = :revue, DateDebS = :dateDeb, DateFinS = :dateFin, VelociteEq = :velocite 
            WHERE IdS = :idS
        ");
        $query->execute([
            'retrospective' => $retrospective,
            'revue' => $revue,
            'dateDeb' => $dateDeb,
            'dateFin' => $dateFin,
            'velocite' => $velocite,
            'idS' => $idS
        ]);
        echo "<p>Sprint mis à jour avec succès !</p>";
    }

    // Mise à jour de l'état d'une tâche
    if (isset($_POST['update_task'])) {
        $idT = $_POST['task_id'];
        $idEtat = $_POST['etat'];

        $query = $pdo->prepare("UPDATE sprintbacklog SET IdEtat = :idEtat WHERE IdT = :idT");
        $query->execute(['idEtat' => $idEtat, 'idT' => $idT]);
        echo "<p>Tâche mise à jour avec succès !</p>";
    }

    // Suppression d'un sprint
    if (isset($_POST['delete_sprint'])) {
        $idS = $_POST['sprint_id'];

        // Supprimer les tâches associées dans le backlog
        $query = $pdo->prepare("DELETE FROM sprintbacklog WHERE IdS = :idS");
        $query->execute(['idS' => $idS]);

        // Supprimer le sprint
        $query = $pdo->prepare("DELETE FROM sprints WHERE IdS = :idS");
        $query->execute(['idS' => $idS]);

        echo "<p>Sprint supprimé avec succès !</p>";
    }

    // Suppression d'une tâche
    if (isset($_POST['delete_task'])) {
        $idT = $_POST['task_id'];

        $query = $pdo->prepare("DELETE FROM sprintbacklog WHERE IdT = :idT");
        $query->execute(['idT' => $idT]);

        $query = $pdo->prepare("DELETE FROM taches WHERE IdT = :idT");
        $query->execute(['idT' => $idT]);

        echo "<p>Tâche supprimée avec succès !</p>";
    }
}

// Afficher les équipes supervisées par le Scrum Master
echo "<h1>Page du Scrum Master</h1>";
echo "<h2>Équipes gérées</h2>";

foreach ($equipes as $equipe) {
    $idEq = $equipe['IdEq'];
    $nomEq = $equipe['NomEq'];

    echo "<h3>Équipe : $nomEq</h3>";

    // Récupérer les sprints de l'équipe
    $query = $pdo->prepare("
        SELECT * 
        FROM sprints 
        WHERE IdEq = :idEq
    ");
    $query->execute(['idEq' => $idEq]);
    $sprints = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($sprints) {
        echo "<h4>Sprints de l'équipe $nomEq</h4>";
        foreach ($sprints as $sprint) {
            $idS = $sprint['IdS'];
            $dateDebut = $sprint['DateDebS'];
            $dateFin = $sprint['DateFinS'];
            $velocite = $sprint['VelociteEq'];
            $retrospective = $sprint['RetrospectiveS'];
            $revue = $sprint['RevueS'];

            echo "<form method='POST'>";
            echo "<p>Sprint #$idS - Du <input type='date' name='date_debut' value='$dateDebut'> au <input type='date' name='date_fin' value='$dateFin'> (Vélocité : <input type='number' name='velocite' value='$velocite'>)</p>";
            echo "<p>Rétrospective : <textarea name='retrospective'>$retrospective</textarea></p>";
            echo "<p>Revue : <textarea name='revue'>$revue</textarea></p>";
            echo "<input type='hidden' name='sprint_id' value='$idS'>";
            echo "<input type='submit' name='update_sprint' value='Mettre à jour le sprint'>";
            echo "<input type='submit' name='delete_sprint' value='Supprimer le sprint' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce sprint ?\")'>";
            echo "</form>";

            // Récupérer les tâches du sprint
            $query = $pdo->prepare("
                SELECT taches.IdT, taches.TitreT, taches.UserStoryT, etatstaches.IdEtat, etatstaches.DescEtat 
                FROM sprintbacklog
                JOIN taches ON sprintbacklog.IdT = taches.IdT
                JOIN etatstaches ON sprintbacklog.IdEtat = etatstaches.IdEtat
                WHERE sprintbacklog.IdS = :idS
            ");
            $query->execute(['idS' => $idS]);
            $taches = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($taches) {
                echo "<table border='1'>";
                echo "<tr><th>Tâche</th><th>User Story</th><th>État</th><th>Actions</th></tr>";
                foreach ($taches as $tache) {
                    $idT = $tache['IdT'];
                    $titre = $tache['TitreT'];
                    $userStory = $tache['UserStoryT'];
                    $etat = $tache['IdEtat'];

                    echo "<tr>";
                    echo "<td>$titre</td><td>$userStory</td>";
                    echo "<td>";
                    echo "<form method='POST'>";
                    echo "<select name='etat'>";
                    
                    // Afficher les différents états disponibles pour la tâche
                    $queryEtat = $pdo->query("SELECT * FROM etatstaches");
                    $etats = $queryEtat->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($etats as $option) {
                        $selected = $option['IdEtat'] == $etat ? 'selected' : '';
                        echo "<option value='{$option['IdEtat']}' $selected>{$option['DescEtat']}</option>";
                    }

                    echo "</select>";
                    echo "<input type='hidden' name='task_id' value='$idT'>";
                    echo "<input type='submit' name='update_task' value='Modifier'>";
                    echo "<input type='submit' name='delete_task' value='Supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette tâche ?\")'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Aucune tâche pour ce sprint.</p>";
            }
        }
    } else {
        echo "<p>Aucun sprint trouvé pour cette équipe.</p>";
    }
}
?> -->
