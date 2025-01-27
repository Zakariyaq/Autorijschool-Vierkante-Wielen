<?php
session_start();
if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: login.php');
    exit;
}

echo "<h1>Welkom, " . htmlspecialchars($_SESSION['naam']) . "</h1>";
echo "<p>Rol: " . htmlspecialchars($_SESSION['rol']) . "</p>";

if ($_SESSION['rol'] === 'leerling') {
    echo "<p>Bekijk je lessen en profiel.</p>";
} elseif ($_SESSION['rol'] === 'instructeur') {
    echo "<p>Beheer je lessen en meld je ziek.</p>";
} elseif ($_SESSION['rol'] === 'rijschoolhouder') {
    echo "<p>Beheer instructeurs, leerlingen en wagenpark.</p>";
}

echo '<a href="logout.php">Uitloggen</a>';
?>
