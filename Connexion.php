<?php
include "config.php";


// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenomU = $_POST['PrenomU'];
    $motDePasseU = $_POST['MotDePasseU'];
    // Check if the user exists in the database
    //$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE PrenomU = :prenomU AND MotDePasseU = :motDePasseU");
    //$stmt = $mysqli->prepare("SELECT count(*) as nb FROM utilisateurs WHERE PrenomU = 1 AND MotDePasseU = 1");
    
    $mdp_hash = password_hash($motDePasseU, PASSWORD_DEFAULT);
    $req = "SELECT count(*) as nb FROM utilisateurs WHERE PrenomU = '$prenomU' AND MotDePasseU = '$mdp_hash'";
    $resreq= $mysqli->query($req);
    $user = $resreq->fetch_array(MYSQLI_NUM);
    echo "nb";
 echo $user[0];

    if ($user) {
        echo "jhjkhkjhkj"
;        // Successful login
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
<header>
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
    
        <button type="submit">Se connecter</button>
        </form>
</div>


</body>
</html>
