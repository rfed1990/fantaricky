<?php
// Includi il file di connessione al database
include('db.php');

// Controllo della connessione al database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query per recuperare i dati delle card
$sql = "SELECT title, image, description FROM passions";
$result = $conn->query($sql);

$passions = array();

if ($result->num_rows > 0) {
    // Recupera i dati e li salva in un array
    while($row = $result->fetch_assoc()) {
        $passions[] = $row;
    }
}

// Restituisci i dati in formato JSON
echo json_encode($passions);

// Chiudi la connessione al database
$conn->close();
?>
