<?php
    include 'config.php';
    include 'header.php';

    function getSprintBacklog($mysqli) {
        $query = "
        SELECT sb.IdT, t.TitreT, sb.IdEtat, e.DescEtat, u.PrenomU, u.NomU
        FROM sprintbacklog sb
        JOIN taches t ON sb.IdT = t.IdT
        JOIN etatstaches e ON sb.IdEtat = e.IdEtat
        JOIN utilisateurs u ON sb.IdU = u.IdU";
    
        $result = $mysqli->query($query);
        if (!$result) {
            die("Mal fait : " . $mysqli->error);
        }
        return $result; 
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
	<title>SprintBackLog</title>
</head>
<body>
<h1>Sprint Backlog</h1>
</br>
<table class="task-table">
    <thead>
        <tr>
            <th>Tâche</th>
            <th>Utilisateur</th>
            <th>État actuel</th>
            <th>Changer l'état</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Récupérer et afficher les tâches du sprint backlog
        $tasks = getSprintBacklog($mysqli);

        if (mysqli_num_rows($tasks) > 0) {
            while ($row = mysqli_fetch_assoc($tasks)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['TitreT']) . "</td>";
                echo "<td>" . htmlspecialchars($row['PrenomU']) . " " . htmlspecialchars($row['NomU']) . "</td>";
                echo "<td>" . htmlspecialchars($row['DescEtat']) . "</td>";
                echo "<td>
                        <form class='form-container' action='' method='POST'>
                            <input type='hidden' name='idT' value='" . htmlspecialchars($row['IdT']) . "'>
                            <select name='idEtat'>
                                <option value='1'>À faire</option>
                                <option value='2'>En cours</option>
                                <option value='3'>Terminé et Test Unitaire</option>
                                <option value='4'>Test Fonctionnel Réalisé</option>
                                <option value='5'>Intégré dans version prod</option>
                            </select>
                            <button type='submit'>Mettre à jour</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucune tâche dans le sprint backlog</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<style>
    .task-table {
        width: 100%;
        border-collapse: collapse;
    }
    .task-table th, .task-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .task-table th {
        background-color: #f2f2f2;
    }
    .task-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .task-table tr:hover {
        background-color: #f1f1f1;
    }
    .task-table .form-container {
        display: flex;
        align-items: center;
    }
    .task-table select {
        margin-right: 10px;
    }
</style>
