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

    // Requête pour récupérer les données du sprint backlog
    $query = "SELECT * FROM sprintbacklog";
    $result = $mysqli->query($query); // Utilisation de l'objet $mysqli pour exécuter la requête

    // Vérification si des résultats existent
    if ($result->num_rows > 0) {
        echo "<h2>Sprint Back Logs</h2>";
        echo "<table border='1'>";
        while ($histo = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $histo['IdT'] . "</td>";
            echo "<td>" . $histo['IdS'] . "</td>";
            echo "<td>" . $histo['IdU'] . "</td>";
            echo "<td>" . $histo['IdEtat'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun client enregistré pour le moment.</p>";
    }
    ?>

</body>
</html>