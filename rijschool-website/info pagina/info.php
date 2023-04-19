<?php
// Include the Database class
include '../Database/db.php';

// Create a new Database object
$database = new Database();

// Fetch the instructors from the database
$stmt = $database->pdo->query("SELECT * FROM instructeur");
$instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Info</title>
    <link href="../Home/index.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="navbar">
            <img src="../IMG/L-logo-2.png" alt="Logo" width="70px">
            <div class="locations">
                <a href="../Home/home.php">Home</a>
                <a href="#">Informatie</a>
                <a href="../Registreren/registreren-form.php">Registreren</a>
                <a href="../Login-leerling/login-form.php">Inloggen</a>
                <a href="">Contact</a>
            </div>
        </div>
        <h2>Eigenaar rijschool: Dhr. Admin</h2>
        <br>
        <a href="#">Email: admin@hotmail.com</a>
        <div class="instructeur">
            <h1>Instructeurs</h1>
            <?php foreach ($instructors as $instructor): ?>
                <h2><?php echo $instructor['naam']; ?></h2>
                <br>
                <a href="#"><?php echo $instructor['email']; ?></a>
            <?php endforeach; ?>
        </div>
        <div>
            <p>Wij zijn een rijschool die vooral gefocust is op mensen met een beperking. Wij beschikken over speciale auto's die speciaal naar jouw instellingen zijn ingesteld. Wij hebben een van de hoogste slagingspercentages van Nederland en daar zijn we heel trots op. Schrijf je nu in voor een proefles voor maar €60. </p>
            <br>
            <a href="../Registreren/registreren-form.php"><button class="button-1">Meld je nu aan!</button></a>
            
        </div>
    </div>
</body>
</html>
