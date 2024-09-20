
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PrenomU = $_POST['PrenomU'];
    $MotDePAsseU = $_POST['MotDePAsseU'];

    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE PrenomU = :PrenomU');
    $stmt->execute(['PrenomU' => $PrenomU]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($MotDePAsseU, $user['MotDePAsseU'])) {
        session_start();
        $_SESSION['PrenomU'] = $user['PrenomU'];
        $_SESSION['user_id'] = $user['id'];
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<header>
        <nav>
            <ul>
                <li><a href="Connexion.php">Accueil</a></li>
            </ul>
        </nav>
        <div>
            <?php if (isset($_SESSION['PrenomU'])): ?>
                <p>Connecté en tant que <?php echo htmlspecialchars($_SESSION['PrenomU']); ?></p>
                <a href="Déconnexion.php">Déconnexion</a>
            <?php else: ?>
                <a href="Connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
            <?php endif; ?>
        </div>
    </header>
    <h1>Connexion</h1>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="Connexion.php" method="POST">
        <label for="PrenomU">Nom d'utilisateur :</label>
        <input type="text" name="PrenomU" required>
        <label for="MotDePAsseU">Mot de passe :</label>
        <input type="MotDePAsseU" name="MotDePAsseU" required>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore inscrit ? <a href="inscription.php">S'inscrire ici</a></p>
</body>
</html>