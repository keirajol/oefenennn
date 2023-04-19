<!DOCTYPE html>
<html>

<head>
    <title>Registratie</title>
    <style>
    .registreren {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .register-form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .button {
        background-color: #6b83b0;
        color: white;
        width: 100px;
        height: 25px;
        border-radius: 3px;
    }
    </style>
</head>

<body class="registreren">
    <h1>Registratie</h1>
    <form action="registreren.php" method="post" class="register-form">
        <label for="gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" name="gebruikersnaam" id="gebruikersnaam" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" id="wachtwoord" required><br><br>

        <input class="button" type="submit" name="submit" value="Registreren">
    </form>
</body>

</html>