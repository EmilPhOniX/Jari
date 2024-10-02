<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $prenom = isset($_POST['PrenomU']) ? $_POST['PrenomU'] : null;
    $mdp = isset($_POST['MotDePasseU']) ? $_POST['MotDePasseU'] : null;


    // Vérification si les champs sont remplis
    if ($prenom && $mdp) {
        // Préparer une requête pour récupérer l'utilisateur
        $stmt = $mysqli->prepare('SELECT * FROM utilisateurs WHERE PrenomU = ?');
        $stmt->bind_param('s', $prenom);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        var_dump($mdp); // Mot de passe saisi
        var_dump(password_verify($mdp, $user['MotDePasseU']));
        var_dump($user['MotDePasseU']); // Mot de passe hashé

        if ($user) {
            // Vérifier le mot de passe
            if (password_verify($mdp, $user['MotDePasseU'])) {
                // Démarrer la session utilisateur et rediriger vers la page d'accueil
                $_SESSION['PrenomU'] = $user['PrenomU'];
                $_SESSION['IdU'] = $user['IdU'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Mot de passe incorrect";
            }
        } else {
            $error = "Utilisateur introuvable";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
<!-- <header>
     <div>
        <?php if (isset($_SESSION['PrenomU'])): ?>
            <p>Connecté en tant que <?php echo htmlspecialchars($_SESSION['PrenomU']); ?></p>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="Connexion.php">Connexion</a>
        <?php endif; ?>
    </div> 
</header> -->

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>



<div class="container">
        <h1>Connexion</h1>
        <form action="Connexion.php" method="POST">
            <label for="PrenomU">Prénom d'utilisateur :</label>
            <input type="text" name="PrenomU" required>
    
            <label for="MotDePasseU">Mot de passe :</label>
            <input type="password" name="MotDePasseU" required>
    
            <input type="submit" name="envoyer" value="Se connecter">
        </form>
</div>


</body>
</html>
