<?php

class Gebruiker {
    private $conn;
    private $table = 'Gebruikers';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registreren
    public function register($email, $wachtwoord, $rol) {
        $query = "INSERT INTO $this->table (email, wachtwoord, rol) VALUES (:email, :wachtwoord, :rol)";
        $stmt = $this->conn->prepare($query);

        // Versleutel wachtwoord
        $hashed_password = password_hash($wachtwoord, PASSWORD_BCRYPT);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':wachtwoord', $hashed_password);
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }

    // Inloggen
    public function login($email, $wachtwoord) {
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gebruiker && password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
            return $gebruiker;
        }
        return false;
    }
}
