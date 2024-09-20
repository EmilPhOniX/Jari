<!DOCTYPE html>
<html >
<head>
 <link href="style.css" rel="stylesheet" media="all" type="text/css">
 <meta charset="UTF-8">
 <title>Marmitez ! </title>
</head>
<body>
<h1>Connexion à la base de données</h1>

<?php
error_reporting(0); 
echo '<p>Connection à la base de données </p>';
// Connexion à la base de données
mysqli_report(MYSQLI_REPORT_OFF);
$mysqli = @new mysqli("localhost", "root", "", "projetsql");

if ( $mysqli->connect_errno ) {
    echo "Impossible de se connecter à MySQL: errNum=" . $mysqli->connect_errno .
    " errDesc=". $mysqli -> connect_error;
    exit();
    }
   $mysqli->close(); 
    echo '<p>Connexion réussie !</p>';   

?>
</body>
</html> 
