<?php
$servername = "localhost"; // Nome del server (usualmente "localhost" su XAMPP)
$username = "root";        // Nome utente (di default su XAMPP è "root")
$password = "";            // Password (di default in XAMPP è vuota)
$dbname = "fantaricky_db"; // Nome del database (modifica con il tuo nome del DB)

// Crea la connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// La query per creare la tabella
$sql = "CREATE TABLE `prova_fantaricky` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    `description` text NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Esegui la query
if ($conn->query($sql) === TRUE) {
    echo "Tabella `prova_fantaricky` creata con successo";
} else {
    echo "Errore nella creazione della tabella: " . $conn->error;
}

// Chiudi la connessione
$conn->close();
?>
