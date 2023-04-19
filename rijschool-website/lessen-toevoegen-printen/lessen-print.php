<?php 

require '../Database/db.php';
$database = new Database();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $query = "INSERT INTO lessen (lestijd_start, lestijd_eind, doel_van_les, ophaal_locatie, gebruikers_id, instructeur_id, datum) 
                  VALUES (:lestijd_start,:lestijd_eind, :doel_van_les, :ophaal_locatie, :gebruikers_id, :instructeur_id, 
                  :datum)";

        $data = [];
        if (isset($_POST['datum']) && !empty($_POST['datum'])) {
            $data['datum'] = htmlspecialchars($_POST['datum']);
        } else {
            header("location: lessen-print.php");
            echo "Vul een datum in.";
        }
        
        
        if (isset($_POST['lestijd_start']) && !empty($_POST['lestijd_start'])) {
            $lestijd_start = htmlspecialchars($_POST['lestijd_start']);
            if ($lestijd_start >= '09:00' && $lestijd_start <= '17:00') {
                $data['lestijd_start'] = $lestijd_start;
            } else {
                header("location: lessen-print.php");
                echo "Geef een correcte starttijd, deze moet tussen 09:00 en 17:00 zijn";
                die();
            }
        } else {
            header("location: lessen-print.php");
            echo "Vul een starttijd in.";
            die();
        }
        
        if (isset($_POST['lestijd_eind']) && !empty($_POST['lestijd_eind'])) {
            $lestijd_eind = htmlspecialchars($_POST['lestijd_eind']);
            if ($lestijd_eind > $lestijd_start && $lestijd_eind <= '18:00') {
                $data['lestijd_eind'] = $lestijd_eind;
            } else {
                header("location: lessen-print.php");
                echo "Geef een correcte eindtijd deze moet na de starttijd zijn en voor 18:00";
                die();
            }
        } else {
            header("location: lessen-print.php");
            echo "Vul een eindtijd in.";
            die();
        }
        

        
        if (isset($_POST['doel_van_les']) && !empty($_POST['doel_van_les'])) {
            $data['doel_van_les'] = htmlspecialchars($_POST['doel_van_les']);
        } else {
            header("location: lessen-print.php");
            echo "Vul een soort les in.";
        }
        if (isset($_POST['ophaal_locatie']) && !empty($_POST['ophaal_locatie'])) {
            $data['ophaal_locatie'] = htmlspecialchars($_POST['ophaal_locatie']);
        } else {
            header("location: lessen-print.php");
            echo "Vul een ophaallocatie in.";
        }

        if (isset($_SESSION['gebruikers_id'])) {
            $data['gebruikers_id'] = $_SESSION['gebruikers_id'];
        } else {
            header("location: lessen-print.php");
            echo "Gebruikers_id niet gevonden in sessie.";
        }
        if (isset($_POST['instructeur_id'])) {
            $data['instructeur_id'] = $_POST['instructeur_id'];
        } else {
            header("location: lessen-print.php");
            echo "Selecteer een instructeur.";
        }

        $stmt = $database->pdo->prepare($query);
        $stmt->execute($data);
    } catch (\Exception $e) {
        error_log($e->getMessage());
        echo "Er is een fout opgetreden bij het inplannen van de les.";
    }
} 

$sql = "SELECT * FROM instructeur";
$stmt = $database->pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT l.*, i.naam AS naam FROM lessen l JOIN instructeur i ON l.instructeur_id = i.instructeur_id WHERE l.gebruikers_id = :gebruikers_id";
$stmt = $database->pdo->prepare($sql);
$stmt->execute(['gebruikers_id' => $_SESSION['gebruikers_id']]);
$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lessen inplannen</title>
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    
}

h2 {
    font-size: 24px;
    margin: 16px 0;
}


form {
    margin: 16px 0;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="date"],
input[type="time"],
input[type="text"],
select {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    margin-bottom: 16px;
    font-size: 16px;
    width: 200px;
}

input[type="submit"] {
    background-color: #0062cc;
    color: #fff;
    padding: 8px 16px;
    border-radius: 4px;
    border: none;
    font-size: 16px;
    cursor: pointer;
}


table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}
    </style>
</head>
<body>
    <h2>Plan een les in</h2>

    <form method="POST">
        <label for="datum">Dag:</label>
        <input type="date" name="datum" required min="<?php echo date('Y-m-d'); ?>">

        <label for="lestijd_start">Begintijd:</label>
        <input type="time" name="lestijd_start" required>

        <label for="lestijd_eind">Eindtijd:</label>
        <input type="time" name="lestijd_eind" required>

        <label for="doel_van_les">Soort les:</label>
        <select name="doel_van_les" required>
            <option value="" selected disabled>Kies een soort les</option>
            <option value="proefles">Proefles</option>
            <option value="rijles">Rijles</option>
            <option value="herexamen">Herexamen</option>
            <option value="tussentijdsetoets">Tussentijdse toets</option>
        </select>

        <label for="ophaal_locatie">Ophaallocatie:</label>
        <input type="text" name="ophaal_locatie" required>

        <label for="instructeur_id">Instructeur:</label>
        <select name="instructeur_id" required>
            <option value="" selected disabled>Kies een instructeur</option>
            <?php foreach ($result as $row) { ?>
                <option value="<?php echo $row['instructeur_id']; ?>"><?php echo $row['naam']; ?></option>
            <?php } ?>
        </select><br><br>  
    <input class="submit-btn" type="submit" name="submit" value="submit">
</form>

    <h2>Mijn lessen</h2>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Dag</th>
                <th>Begintijd</th>
                <th>Eindtijd</th>
                <th>Soort les</th>
                <th>Ophaal locatie</th>
                <th>Instructeur</th>
                <th>Lessen wijzigen</th>
                <th>Lessen annuleren</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessen as $les) { ?>
                <tr>
                   <td><?php  $les['les_id']; ?></td>
                    <td><?php echo $les['datum']; ?></td>
                    <td><?php echo $les['lestijd_start']; ?></td>
                    <td><?php echo $les['lestijd_eind']; ?></td>
                    <td><?php echo $les['doel_van_les']; ?></td>
                    <td><?php echo $les['ophaal_locatie']; ?></td>
                    <td><?php echo $les['naam']; ?></td>

                    <td><a class="wijzigen-btn" href="../wijzig-les/les-wijzigen.php?les_id=
                <?php echo trim($les['les_id']);?>
                &datum=<?php echo trim($les['datum']);?>
                &lestijd_start=<?php echo trim($les['lestijd_start']);?>
                &lestijd_eind=<?php echo trim($les['lestijd_eind']);?>
                &doel_van_les=<?php echo trim($les['doel_van_les']);?>
                &ophaal_locatie=<?php echo trim($les['ophaal_locatie']);?>
                &naam=<?php echo trim($les['naam']);?>
                ">Wijzigen</a></td>


                    <td><a class="annuleer-btn" href="../Delete-les/delete-les.php?les_id=<?php echo $les['les_id']; ?>">Annuleren</a></td>

                </tr>
            <?php } ?>

        </tbody>
    </table>

   