<?php
session_start();
?>

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
        <a href="Projet.php">Projets</a>
        <a href="sprintbacklog.php">Sprintbacklog</a>
        <a href='deconnexion.php'>Déconnexion</a>
        <?php 
        if (isset($_SESSION['SpecialiteU']) && $_SESSION['SpecialiteU'] == "UI") {
            echo "<a href='inscription.php'>Inscription</a>";
        }
        ?>
        
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
        <a href="index.php"> 
            <h1>JARI</h1> 
            <img src="J_A_R_I_logo.png" id="logo"/> 
        </a>
    </div>
    <div id="end">
        <div id="user">
        <?php if (isset($_SESSION['PrenomU'])): ?>
            <p>Connecté en tant que <?php echo htmlspecialchars($_SESSION['PrenomU']); ?></p>
            <?php else: ?>
            <a href="Connexion.php">Connexion</a>
        <?php endif; 
        // on arrive pas à trouver nom et prénom, et je comprends pas pourquoi
        ?>
        </div>
    </div>    
    </header>
</body>
</html>
