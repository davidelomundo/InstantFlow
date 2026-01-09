-- Active: 1767691282934@@127.0.0.1@3306@instantflow

-- Table: films
CREATE TABLE IF NOT EXISTS films (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(100) UNIQUE NOT NULL,
    descrizione TEXT,
    data_uscita DATE NOT NULL
);

-- Table: utenti
CREATE TABLE IF NOT EXISTS utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARBINARY(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT 0
);

-- Table: categorie
CREATE TABLE IF NOT EXISTS categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) UNIQUE NOT NULL,
    prezzo DECIMAL(6,2) NOT NULL CHECK (prezzo >= 0)
);

-- Table: abbonamenti
CREATE TABLE IF NOT EXISTS abbonamenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_fine DATE NOT NULL,
    id_utente INT NOT NULL,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES utenti(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorie(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: attori
CREATE TABLE IF NOT EXISTS attori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL
);

-- Table: recita (relationship)
CREATE TABLE IF NOT EXISTS recita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_attore INT NOT NULL,
    id_film INT NOT NULL,
    FOREIGN KEY (id_attore) REFERENCES attori(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_film) REFERENCES films(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: generi
CREATE TABLE IF NOT EXISTS generi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL
);

-- Table: appartiene (relationship)
CREATE TABLE IF NOT EXISTS appartiene (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_genere INT NOT NULL,
    id_film INT NOT NULL,
    FOREIGN KEY (id_genere) REFERENCES generi(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_film) REFERENCES films(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: guarda
CREATE TABLE IF NOT EXISTS guarda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    id_film INT NOT NULL,
    data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    durata TIME NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES utenti(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_film) REFERENCES films(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);