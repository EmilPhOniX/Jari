<?php
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $mdp = $_POST['mdp'] ?? null;
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    // echo  "ajout bdd ";


    // l'autoincrement est pas dans la base (yes) donc j'incrémente comme un porc
    $lastIdQuery = $mysqli->query('SELECT MAX(IdU) AS max_id FROM utilisateurs');
    if ($lastIdQuery) echo "req effectuée"; 
    // else echo "pb req select";
    $row =$lastIdQuery->fetch_assoc() ; 
    //$lastIdResult = $lastIdQuery->fetch();
    // echo "fetch  effectuée" ; 
    $newId = $row['max_id'] + 1;


    // echo  $newId;

    // On prépare la requête  en vérifiant que les champs sont remplis et que le pseudo n'existe pas déjà
    $checkUser = $mysqli->prepare('SELECT * FROM utilisateurs WHERE NomU = ? OR PrenomU = ?');
    $checkUser->execute([$nom, $prenom]);
    // echo "passe";
    $userExists = $checkUser->fetch(); // on a la ligne problème  I C I
    // echo "passe pas";


    

    if ($userExists) {
        header("Location: inscription.php?error=pseudo_used");
        $_SESSION['error_message'] = "Nom ou prénom déjà utilisé !";
        exit();
    } else {
        $insertUser = $mysqli->prepare('INSERT INTO utilisateurs (IdU, NomU, PrenomU, MotDePAsseU) VALUES (?, ?, ?, ?)');
        $insertUser->execute([$newId, $nom, $prenom, $mdp_hash]);

        $_SESSION['success_message'] = "Enregistré avec succès !";
        header("Location: index.php");
        exit();
    }
}
// else echo "hjkhkjhkj";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription </title>
    <link rel="icon" type="image/vnd.icon" href="icon.png">
    <link rel="stylesheet" href="style.css">
</head>  
<body>
        

    <div class="container">
        <h1>Inscription</h1>
        <form action="" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }

            if (isset($_SESSION['success_message'])) {
                echo '<div class="success">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }

            ?>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <input type="submit" name="envoyer" value="S'inscrire">
        </form>
        <p class="message">Retour à la page  <a href="index.php">d'accueil</a></p>
    </div>
</body>
</html>
