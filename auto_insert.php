<?php
include 'db.php';

// Funzione per validare i dati
function validateData($data) {
    return !empty($data['title']) && !empty($data['image']) && !empty($data['description']);
}

// Funzione per registrare le operazioni in un file di log
function logOperation($message) {
    $logFile = 'auto_insert.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// Array di dati di esempio da inserire
$dataToInsert = [
    [
        'title' => 'Nuova Passione 1',
        'image' => 'default-image-1.jpg',
        'description' => 'Descrizione della nuova passione 1'
    ],
    [
        'title' => 'Nuova Passione 2',
        'image' => 'default-image-2.jpg',
        'description' => 'Descrizione della nuova passione 2'
    ]
];

// Contatori per il monitoraggio
$successCount = 0;
$errorCount = 0;

// Inserimento automatico dei dati
foreach ($dataToInsert as $data) {
    if (validateData($data)) {
        $title = $conn->real_escape_string($data['title']);
        $image = $conn->real_escape_string($data['image']);
        $description = $conn->real_escape_string($data['description']);

        $sql = "INSERT INTO prova_fantaricky (title, image, description) VALUES ('$title', '$image', '$description')";

        if ($conn->query($sql) === TRUE) {
            $successCount++;
            logOperation("Inserimento riuscito: {$data['title']}");
        } else {
            $errorCount++;
            logOperation("Errore nell'inserimento: {$data['title']} - " . $conn->error);
        }
    } else {
        $errorCount++;
        logOperation("Dati non validi per: {$data['title']}");
    }
}

// Chiudi la connessione al database
$conn->close();

// Restituisci il risultato in formato JSON
header('Content-Type: application/json');
echo json_encode([
    'success' => $successCount,
    'errors' => $errorCount,
    'message' => "Inserimento completato: $successCount successi, $errorCount errori"
]);
?>