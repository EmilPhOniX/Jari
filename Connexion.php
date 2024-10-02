<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenomU = $_POST['PrenomU'];
    $motDePasseU = $_POST['MotDePasseU'];
    
    // Requête SQL avec une requête préparée pour éviter les injections SQL
    $stmt = $mysqli->prepare("SELECT idU, PrenomU, MotDePasseU FROM utilisateurs WHERE PrenomU = ?");
    $stmt->bind_param("s", $prenomU);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    

    var_dump($user);



    // Vérifier si l'utilisateur existe et que le mot de passe est correct
    if ($user && password_verify($motDePasseU, $user['MotDePasseU'])) {
        // CETTE LIGNE PUE LA MERDE



        // Connexion réussie
        $_SESSION['user_id'] = $user['idU'];
        $_SESSION['PrenomU'] = $user['PrenomU'];
        
        // Redirection vers la page d'accueil après la connexion
        header("Location: index.php"); 
        exit();
    } else {
        // Invalid login
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
    var_dump($motDePasseU); // Mot de passe saisi
    var_dump(password_verify($motDePasseU, $user['MotDePasseU']));
    var_dump($user['MotDePasseU']); // Mot de passe hashé
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
