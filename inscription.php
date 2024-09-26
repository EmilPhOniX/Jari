
<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $mdp = $_POST['mdp'] ?? null;

    if (empty($nom) || empty($mdp)) {
        $_SESSION['error_message'] = "Nom et mot de passe requis.";
        header("Location: connexion.php");
        exit();
    }

    // Vérifier si l'utilisateur existe et récupérer son mot de passe haché
    $query = $bdd->prepare('SELECT IdU, MotDePasseU FROM utilisateurs WHERE NomU = ?');
    $query->execute([$nom]);
    $user = $query->fetch();

    if ($user && password_verify($mdp, $user['MotDePasseU'])) {
        // Les informations sont correctes, connecter l'utilisateur
        $_SESSION['user_id'] = $user['IdU'];
        $_SESSION['user_name'] = $nom;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Nom ou mot de passe incorrect.";
        header("Location: connexion.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - LDB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required>

            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <input type="submit" name="envoyer" value="Se connecter">
        </form>
        <p class="message">Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </div>
</body>
</html>