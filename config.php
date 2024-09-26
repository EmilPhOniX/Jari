
<?php
error_reporting(0);
// Vérification si une session est déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérification si un message de succès est présent
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    // Supprimer le message après l'avoir affiché une fois
    unset($_SESSION['success_message']);
}

error_reporting(0); 
// echo '<p>Connection à la base de données </p>';
// Connexion à la base de données
mysqli_report(MYSQLI_REPORT_OFF);
$mysqli = @new mysqli("localhost", "root", "", "projetsql");

if ( $mysqli->connect_errno ) {
    echo "Impossible de se connecter à MySQL: errNum=" . $mysqli->connect_errno .
    " errDesc=". $mysqli -> connect_error;
    $mysqli->close(); 

    exit();
    }
    // echo '<p>Connexion réussie !</p>';  
?>


