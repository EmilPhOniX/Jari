<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    
    if ($pseudo && $email && $mdp) {
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
        
        $stnt = $bdd->prepare('INSERT INTO USERS (pseudo, mail, mdp) VALUES (?, ?, ?)');
        $stnt->bindParam(1, $pseudo, PDO::PARAM_STR);
        $stnt->bindParam(2, $email, PDO::PARAM_STR);
        $stnt->bindParam(3, $mdp_hash, PDO::PARAM_STR);
        
        $stnt->execute();

        $_SESSION['success_message'] = "Enregistré avec succès !";
        header("Location: connexion.php");
        exit();
    } else {
        echo "Il manque des paramètres !"; 
    } 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - LDB</title>
    <link rel="icon" type="image/vnd.icon" href="icon.png">
    <link rel="stylesheet" href="style.css">
</head>  
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="" method="post">
            <input type="text" name="pseudo" placeholder="Pseudo" required>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <?php
				if (isset($_GET['error']) && $_GET['error'] == 'pseudo_used') {
		    		echo '<div id="erreur">Pseudo ou email dejà utilisé !</div>';
				}
			?>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <input type="submit" name="envoyer" value="S'inscrire">
        </form>
        <p class="message">Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
    </div>
</body>
</html>