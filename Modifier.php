<?php
include 'config.php';
$mysqli = new mysqli("localhost", "root", "", "projetsql");

if ($mysqli->connect_error) {
    die("Erreur de connexion: " . $mysqli->connect_error);
}

$query = "SELECT IdEq, NomEq FROM equipesprj";
$result = $mysqli->query($query);
?>

<form method="POST" action="">
    <label for="id_eq">Sélectionnez l'équipe à modifier :</label>
    <select name="id_eq" id="id_eq" required>
        <option value="">-- Sélectionnez une équipe --</option>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['IdEq'] . '">' . $row['NomEq'] . '</option>';
        }
        ?>
    </select>
    <input type="submit" name="select_eq" value="Choisir l'équipe">
</form>

<?php
if (isset($_POST['select_eq'])) {
    $id_eq = $_POST['id_eq'];

    $query = "SELECT NomEq, Description, NomClient, ProprietaireProduit FROM equipesprj WHERE IdEq = ?";

    echo "papa";
    $truc = $mysqli->prepare($query);
    $truc->bind_param("i", $id_eq);
    $truc->execute();
    $result = $truc->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom_eq = $row['NomEq'];
        $description = $row['Description'];
        $client = $row['NomClient']; // Assure-toi que la colonne NomClient existe dans ta table
        $product_owner = $row['ProprietaireProduit']; // Assure-toi que la colonne ProprietaireProduit existe dans ta table
    }
?>

<form method="POST" action="">
    <input type="hidden" name="id_eq" value="<?php echo $id_eq; ?>">

    <label for="nom_eq">Nom de l'équipe :</label>
    <input type="text" name="nom_eq" value="<?php echo $nom_eq; ?>" required>

    <label for="description">Description :</label>
    <textarea name="description" required><?php echo $description; ?></textarea>

    <label for="client">Client :</label>
    <input type="text" name="client" value="<?php echo $client; ?>" required>

    <label for="product_owner">Product Owner :</label>
    <input type="text" name="product_owner" value="<?php echo $product_owner; ?>" required>

    <input type="submit" name="modifier" value="Modifier">
</form>

<?php
}

// Mise à jour des informations de l'équipe si le formulaire de modification est soumis
if (isset($_POST['modifier'])) {
    $id_eq = $_POST['id_eq'];
    $nom_eq = $_POST['nom_eq'];
    $description = $_POST['description'];
    $client = $_POST['client'];
    $product_owner = $_POST['product_owner'];

    // Requête SQL pour mettre à jour les informations de l'équipe
    $query = "UPDATE equipesprj SET NomEq = ?, Description = ?, NomClient = ?, ProprietaireProduit = ? WHERE IdEq = ?";
    $truc = $mysqli->prepare($query);
    $truc->bind_param("ssssi", $nom_eq, $description, $client, $product_owner, $id_eq);
    $truc->execute();

    if ($truc->affected_rows > 0) {
        echo "Équipe mise à jour avec succès !";
    } else {
        echo "Erreur lors de la mise à jour de l'équipe.";
    }
}
?>
