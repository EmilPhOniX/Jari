<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/vnd.icon" href="icon.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="center">
            <a href="index.php">
                <h1>JARI</h1>
            </a>
        </div>
        <div id="end">
        <?php
            include "config.php"; 
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true):
                // Vérifier si le pseudo et l'id de l'utilisateur sont définis dans la session
                $pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'Invité';
                $idUser = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 0;
            ?>
                <!--Afficher le pseudo de l'utilisateur et un lien vers son profil-->
                <a href="profil.php?idUser=<?php echo htmlspecialchars($idUser); ?>">Profil de <?php echo htmlspecialchars($pseudo); ?></a>
            <?php else: ?>
                <a href='connexion.php'>Connexion</a>   
            <?php endif; ?> 
        </div>
    </header>
</body>
</html>