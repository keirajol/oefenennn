<?php
session_start();
require '../Database/db.php';
$database = new Database();


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['wachtwoord'];

    $query = "SELECT * FROM leerlingen WHERE email = :email";
    $stmt = $database->pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['wachtwoord'])) {
        // Login geslaagd
        
        $_SESSION['username'] = $user['gebruikersnaam'];
        $_SESSION['gebruikers_id'] = $user['gebruikers_id'];
        $_SESSION['instructeur_id'] = $user['instructeur_id'];
  
        
        header("Location: ../leerling-page/leerling.php");
        exit();
    } else {
        // Login mislukt
        echo "email of wachtwoord is onjuist.";
    }
}
?>
