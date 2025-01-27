<?php
require_once '../classes/Database.php';
require_once '../classes/Gebruiker.php';

$db = (new Database())->connect();
$gebruiker = new Gebruiker($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];

    if ($gebruiker->register($email, $wachtwoord, $rol)) {
        echo "Registratie succesvol! <a href='login.php'>Inloggen</a>";
    } else {
        echo "Registratie mislukt. Probeer opnieuw.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>
    <h1>Registreren</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br>
        <select name="rol">
            <option value="leerling">Leerling</option>
            <option value="instructeur">Instructeur</option>
            <option value="rijschoolhouder">Rijschoolhouder</option>
        </select><br>
        <button type="submit">Registreren</button>
    </form>
</body>
</html>
