<?php
include 'db.php';  // Connessione al database

// Dati da inserire
$title1 = 'Veicoli';
$image1 = 'veicoli.jpg';
$description1 = 'Veicoli futuristici per esplorazioni spaziali.';

$title2 = 'Moda';
$image2 = 'moda_vintage.jpg';
$description2 = 'La moda vintage è sempre in tendenza.';

// Query per inserire i dati
$sql1 = "INSERT INTO prova_fantaricky (title, image, description) VALUES ('$title1', '$image1', '$description1')";
$sql2 = "INSERT INTO prova_fantaricky (title, image, description) VALUES ('$title2', '$image2', '$description2')";

// Esegui le query
if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    echo "Nuovi dati aggiunti con successo!";
} else {
    echo "Errore nell'inserimento: " . $conn->error;
}

$conn->close();  // Chiudi la connessione
?>
