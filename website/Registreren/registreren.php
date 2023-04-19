<?php
require '../Database/db.php';
$database = new Database();

if (isset($_POST['submit'])) {
    $username = $_POST['gebruikersnaam'];
    $email = $_POST['email'];
    $password = $_POST['wachtwoord'];

    $query = "INSERT INTO leerlingen (gebruikersnaam, email, wachtwoord) VALUES (:gebruikersnaam, :email, :wachtwoord)";
    $stmt = $database->pdo->prepare($query);
    $stmt->bindParam(':gebruikersnaam', $username);
    $stmt->bindParam(':email', $email);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':wachtwoord', $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../Home/home.php");
        exit();
    } else {
        echo "Er is iets fout gegaan bij het registreren";
    }
}
?>