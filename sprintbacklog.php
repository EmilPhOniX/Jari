<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
	<title>Document</title>
</head>
<body>

    <?php
    include 'config.php';

    $query = "SELECT T.TitreT, S.idS, U.NomU, E.DescEtat
        FROM sprintbacklog
        NATURAL JOIN taches AS T
        NATURAL JOIN sprints AS S
        NATURAL JOIN utilisateurs AS U 
        NATURAL JOIN etatstaches AS E";

    $result = $mysqli->query($query); // Utilisation de l'objet $mysqli pour exécuter la requête

    // Vérification si des résultats existent
    if ($result->num_rows > 0) {
        echo "<h2>Sprint Back Logs</h2>";
        echo "<table border='1'>";
        while ($histo = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $histo['T'] . "</td>";
            echo "<td>" . $histo['S'] . "</td>";
            echo "<td>" . $histo['U'] . "</td>";
            echo "<td>" . $histo['E'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun aucune log.</p>";
    }
    ?>

</body>
</html>