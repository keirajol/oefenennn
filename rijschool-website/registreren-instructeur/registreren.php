

<?php
require '../Database/db.php';
$database = new Database();

if (isset($_POST['submit'])) {
    $username = $_POST['naam'];
    $email = $_POST['email'];
    $password = $_POST['wachtwoord'];

    $query = "INSERT INTO instructeur (naam, email, wachtwoord) VALUES (:naam, :email, :wachtwoord)";
    $stmt = $database->pdo->prepare($query);
    $stmt->bindParam(':naam', $username);
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


<html>
<body class="registreren">
    <h1>Registratie</h1>
    <form action="registreren.php" method="post" class="register-form">
        <label for="gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" name="naam" id="gebruikersnaam" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" id="wachtwoord" required><br><br>

        <input class="button" type="submit" name="submit" value="Registreren">
    </form>
</body>

</html>