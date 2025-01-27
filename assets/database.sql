-- Tabel voor gebruikers (instructeurs en leerlingen)
CREATE TABLE gebruikers (
    gebruiker_id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    wachtwoord VARCHAR(255) NOT NULL,
    voornaam VARCHAR(255) NOT NULL,
    tussenvoegsel VARCHAR(20) NOT NULL,
    achternaam VARCHAR(255) NOT NULL,
    rol ENUM('instructeur', 'leerling', 'eigenaar') NOT NULL,
    exameninformatie TEXT NOT NULL,
    actief INT(1) NOT NULL,
    geslaagd INT(1)
  
);

-- Tabel voor lespakketten
CREATE TABLE lespakketten (
    pakket_id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    beschrijving TEXT,
    aantal_lessen INT NOT NULL,
    prijs DECIMAL(10, 2) NOT NULL,
    soort_les VARCHAR(255) NOT NULL
  
);

-- Tabel voor lessen
CREATE TABLE lessen (
    les_id INT AUTO_INCREMENT PRIMARY KEY,
    Les_tijd VARCHAR(10) NOT NULL,
    doel VARCHAR(255) NOT NULL,
    redenen_annuleren TEXT NOT NULL,
    soort_les ENUM('B', 'B+E', 'C', 'D', 'A1', 'A') NOT NULL,
    te_behandelen_onderwerpen TEXT,
    FOREIGN KEY (auto_id) REFERENCES auto(auto_id),
    FOREIGN KEY (ophaallocatie) REFERENCES gebruikers(gebruiker_id)
);

-- Tabel voor het bijhouden van wijzigingen in het rooster
CREATE TABLE roosterWijzigingen (
    wijziging_id INT AUTO_INCREMENT PRIMARY KEY,
    les_id INT NOT NULL,
    gewijzigde_datum DATE,
    gewijzigde_tijd VARCHAR(10),
    reden_wijziging TEXT,
    aangebracht_door INT NOT NULL,
    FOREIGN KEY (les_id) REFERENCES Lessen(les_id),
    FOREIGN KEY (aangebracht_door) REFERENCES gebruikers(gebruiker_id)
);

-- Tabel voor ziekmeldingen
CREATE TABLE ziekmeldingen (
    ziekmelding_id INT AUTO_INCREMENT PRIMARY KEY,
    instructeur_id INT NOT NULL,
    van TIMESTAMP NOT NULL,
    tot TIMESTAMP NOT NULL,
    toelichting TEXT,
    FOREIGN KEY (instructeur_id) REFERENCES gebruikers(gebruiker_id)
);

-- Tabel voor lesannuleringen
CREATE TABLE lesAnnuleringen (
    annulering_id INT AUTO_INCREMENT PRIMARY KEY,
    les_id INT NOT NULL,
    leerling_id INT NOT NULL,
    reden TEXT NOT NULL,
    annulering_datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (les_id) REFERENCES Lessen(les_id),
    FOREIGN KEY (leerling_id) REFERENCES gebruikers(gebruiker_id)
);

-- Tabel voor koppeling tussen gebruikers en lespakketten
CREATE TABLE gebruikerLespakketten (
    gebruiker_lespakket_id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    FOREIGN KEY (gebruiker_id) REFERENCES gebruikers(gebruiker_id),
    FOREIGN KEY (pakket_id) REFERENCES lespakketten(pakket_id)
);

CREATE TABLE auto(
    auto_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    merk VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    kenteken VARCHAR(10) NOT NULL,
    FOREIGN KEY (soort_id) REFERENCES soort(soort_id)
);

CREATE TABLE ophaalLocatie(
    adres VARCHAR(255) NOT NULL,
    postcode VARCHAR(7) NOT NULL,
    plaats VARCHAR(255) NOT NULL
);

CREATE TABLE les_onderwerp (
 
    FOREIGN KEY (les_id) REFERENCES les(les_id),
    FOREIGN KEY (onderwerp_ontwerp_id) REFERENCES onderwerp(ontwerp_id)
);

CREATE TABLE onderwerp(
    ontwerp_id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    onderwerp  VARCHAR(7) NOT NULL,
    omschrijving TEXT NOT NULL
);

CREATE TABLE soort(
    soort_id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    type VARCHAR(255) NOT NULL
);


