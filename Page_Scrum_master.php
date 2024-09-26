<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Scrum master</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
    <header>
        <div id="mainHeader" style="display: flex; align-items: center;">
            <h1 style="margin-left: 50px;">Scrum Master</h1>
        </div>
    </header>

    <?php
    include "header.php";
    include "config.php";
    ?>


    <div id="mainContent">
        <h2>Projets</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Nom Projet</th>
                <th>Description</th>
                <th>Date de début</th>
                <th>Membres</th>
                <th>Product owner</th>
                <th>Equipe</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Projet 1</td>
                <td>Description 1</td>
                <td>Client 1</td>
                <td>Scrum master 1</td>
                <td>Product owner 1</td>
                <td>Equipe 1</td>
                <td><button>Modifier</button><button>Supprimer</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Projet 2</td>
                <td>Description 2</td>
                <td>Client 2</td>
                <td>Scrum master 2</td>
                <td>Product owner 2</td>
                <td>Equipe 2</td>
                <td><button>Modifier</button><button>Supprimer</button></td>
            </tr>
        </table>
    </div>

</body>
</html>
