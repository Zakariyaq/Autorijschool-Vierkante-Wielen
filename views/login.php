<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/Gebruiker.php';

$db = (new Database())->connect();
$gebruiker = new Gebruiker($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $ingelogd_gebruiker = $gebruiker->login($email, $wachtwoord);

    if ($ingelogd_gebruiker) {
        $_SESSION['gebruiker_id'] = $ingelogd_gebruiker['gebruiker_id'];
        $_SESSION['rol'] = $ingelogd_gebruiker['rol'];
        $_SESSION['naam'] = $ingelogd_gebruiker['naam'];

        header('Location: dashboard.php');
        exit;
    } else {
        echo "Ongeldige inloggegevens. Probeer opnieuw.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h1>Inloggen</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br>
        <button type="submit">Inloggen</button>
    </form>
    <p>Geen account? <a href="registratie.php">Registreer hier</a>.</p>
</body>
</html>
