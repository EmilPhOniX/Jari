<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/vnd.icon" href="icon.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <div id="start">
    
        <div id="mainHeader" style="display: flex; align-items: right;">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

        <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Projets</a>
        <a href="#">Utilisateurs</a>
        <a href="#">Sprint</a>
        <a href="#">Tâches</a>
        <a href="Page_Scrum_master.php">Scum Master</a>
        <?php
            include "config.php"; 
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true):
                // Vérifier si le pseudo et l'id de l'utilisateur sont définis dans la session
                $pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'Invité';
                $idUser = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 0;
            ?>
                <a href='deconnexion.php'>Déconnexion</a>   
                <?php else: ?>
                <a href='connexion.php'>Connexion</a>   
            <?php endif; ?> 


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
        </div>
    </div>
    </div>
    
    <div id="center">
        <a href="index.php"> <h1 style=" margin-left: 50px;">JARI</h1> </a>
    </div>

        
    
    </header>
</body>
</html>