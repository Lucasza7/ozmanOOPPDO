<?php
include 'db.php';

// Functie om inloggegevens te controleren
function checkLogin($conn, $username, $password) {
    // Voorkomen van SQL-injectie door het gebruik van prepared statements
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $dbPassword);
    $stmt->fetch();
    $stmt->close();

    // Controleer of de gebruiker bestaat en het wachtwoord overeenkomt
    if ($dbUsername == $username && password_verify($password, $dbPassword)) {
        return $userId;
    } else {
        return false;
    }
}

// Verwerken van inkomende POST-verzoeken
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Controleren op lege velden
    if (empty($username) || empty($password)) {
        echo "Vul alle velden in.";
    } else {
        // Controleren van inloggegevens
        $userId = checkLogin($conn, $username, $password);

        if ($userId !== false) {
            echo "Inloggen gelukt. Gebruiker ID: " . $userId;
            // Voer hier verdere acties uit na succesvol inloggen, bijv. doorsturen naar de welkomstpagina.
        } else {
            echo "Ongeldige inloggegevens.";
        }
    }
}



?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Formulier</title>
</head>
<body>

<h2>Inloggen</h2>

<form action="login.php" method="post">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Wachtwoord:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Inloggen">
</form>

</body>

