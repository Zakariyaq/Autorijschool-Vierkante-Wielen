<?php

class Lespakket {
    private $conn;
    private $table = 'lespakketten';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create lespakket (alleen toegankelijk voor instructeurs)
    public function create($data) {
        $query = "INSERT INTO $this->table (voornaam, beschrijving, aantal_lessen, prijs, soort_les) 
                  VALUES (:voornaam, :beschrijving, :aantal_lessen, :prijs, :soort_les)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':voornaam', $data['voornaam']);
        $stmt->bindParam(':beschrijving', $data['beschrijving']);
        $stmt->bindParam(':aantal_lessen', $data['aantal_lessen']);
        $stmt->bindParam(':prijs', $data['prijs']);
        $stmt->bindParam(':soort_les', $data['soort_les']);

        return $stmt->execute();
    }

    // Lees alle lespakketten
    public function readAll() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
