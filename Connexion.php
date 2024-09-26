<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>

<?php
include "config.php";

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenomU = $_POST['PrenomU'];
    $motDePasseU = $_POST['MotDePasseU'];

    // Check if the user exists in the database
    $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE PrenomU = :prenomU AND MotDePasseU = :motDePasseU");
    $mdp_hash = password_hash($motDePasseU, PASSWORD_DEFAULT);
    $stmt->bindParam(':prenomU', $prenomU);
    $stmt->bindParam(':motDePasseU', $mdp_hash);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login
        $_SESSION['user_id'] = $user['idU'];
        $_SESSION['PrenomU'] = $user['PrenomU'];
        $_SESSION['PrenomU'] = $user['PrenomU'];
        header("Location: index.php"); 
        exit();
    } else {
        // Invalid login
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
        </ul>
    </nav>
    <!-- <div>
        <?php if (isset($_SESSION['PrenomU'])): ?>
            <p>Connecté en tant que <?php echo htmlspecialchars($_SESSION['PrenomU']); ?></p>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="Connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
        <?php endif; ?>
    </div> -->
</header>

<h1>Connexion</h1>

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="Connexion.php" method="POST">
    <label for="PrenomU">Prénom d'utilisateur :</label>
    <input type="text" name="PrenomU" required>
    
    <label for="MotDePasseU">Mot de passe :</label>
    <input type="password" name="MotDePasseU" required>
    
    <button type="submit">Se connecter</button>
</form>

<p>Pas encore inscrit ? <a href="inscription.php">S'inscrire ici</a></p>

</body>
</html>
