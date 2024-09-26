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
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <h1 style="margin-left: 50px;">Scrum Master</h1>
        </div>
    </header>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Projets</a>
        <a href="#">Utilisateurs</a>
        <a href="#">Sprint</a>
        <a href="#">Tâches</a>
    </div>


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

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("mainContent").style.marginLeft = "250px";
            document.getElementById("mainHeader").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("mainContent").style.marginLeft = "0";
            document.getElementById("mainHeader").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
    </script>
</body>
</html>