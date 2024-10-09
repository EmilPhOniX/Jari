<?php
// Inclure le fichier config.php qui contient la connexion à la base de données
include'config.php';

// Démarrer la session
session_start();

// Récupérer l'ID utilisateur et le rôle de l'utilisateur connecté (exemple)
$userId = $_SESSION['IdU']; // L'ID de l'utilisateur connecté
$userRole = $_SESSION['IdR']; // Le rôle de l'utilisateur connecté (ex: 'UI' ou autre)

// Vérifier si l'utilisateur a le rôle "UI" (admin)
$isAdmin = ($userRole === 'UI');

// Requête pour récupérer les projets auxquels l'utilisateur est affecté, ou tous les projets si c'est un admin
$query = "
    SELECT
        p.IdEq AS Id, 
        p.NomEq AS Nom,
        'Description placeholder' AS Description, -- Remplacez par la colonne de description réelle si elle existe
        u.NomU AS ScrumMaster,
        u2.NomU AS ProductOwner,
        p.NomEq AS Equipe
    FROM equipesprj p
    LEFT JOIN rolesutilisateurprojet rup1 ON rup1.IdEq = p.IdEq AND rup1.IdR = 'SM'
    LEFT JOIN utilisateurs u ON u.IdU = rup1.IdU
    LEFT JOIN rolesutilisateurprojet rup2 ON rup2.IdEq = p.IdEq AND rup2.IdR = 'PO'
    LEFT JOIN utilisateurs u2 ON u2.IdU = rup2.IdU
";

// Si l'utilisateur n'est pas un admin, filtrer pour ne récupérer que les projets auxquels il est affecté
if (!$isAdmin) {
    $query .= "
        JOIN rolesutilisateurprojet rup3 ON rup3.IdEq = p.IdEq AND rup3.IdU = ?
    ";
}

// Préparer la requête
$stmt = $mysqli->prepare($query);

// Si l'utilisateur n'est pas admin, lier l'ID utilisateur au paramètre de la requête
if (!$isAdmin) {
    $stmt->bind_param("i", $userId);
}

// Exécuter la requête
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si la requête a retourné des résultats
if ($result->num_rows > 0) {
    // Récupération des projets sous forme de tableau
    $projects = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $projects = [];
}

// Fermer la connexion
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Projets</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
        }
        th {
            background-color: #181414;
            color: #818181;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 5px 10px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-delete {
            background-color: red;
        }
    </style>
</head>
<body>
<h2>Projets</h2>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom Projet</th>
            <th>Description</th>
            <th>Client</th>
            <th>Scrum master</th>
            <th>Product owner</th>
            <th>Nom Equipe</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($projects) > 0): ?>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= htmlspecialchars($project['Id']) ?></td>
                    <td><?= htmlspecialchars($project['Nom']) ?></td>
                    <td><?= htmlspecialchars($project['Description']) ?></td>
                    <td>Client Placeholder</td> <!-- Remplacez cela par les données réelles du client si disponible -->
                    <td><?= htmlspecialchars($project['ScrumMaster']) ?></td>
                    <td><?= htmlspecialchars($project['ProductOwner']) ?></td>
                    <td><?= htmlspecialchars($project['Equipe']) ?></td>
                    <td class="action-buttons">
                        <a href="Modifier.php?id=<?= $project['Id'] ?>" class="btn">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Aucun projet trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
