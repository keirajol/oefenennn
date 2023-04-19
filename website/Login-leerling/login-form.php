<html>

<head>
    <title>login</title>
    <style>
    .login-page {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .login-form {
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

<body>
    <div class="login-page">
        <h2>Inloggen leerlingen</h2>
        <form method="post" action="login.php" class="login-form">
            <label for="email">Email:</label>
            <input class="input" type="text" id="username" name="email" required><br><br>
            <label for="wachtwoord">Wachtwoord:</label>
            <input class="input" type="password" id="password" name="wachtwoord" required><br><br>
            <input class="button" type="submit" name="submit" value="Inloggen">
        </form>
    </div>
</body>

</html>