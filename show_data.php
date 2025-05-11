<?php
include 'db.php';  // Connessione al database

// Query per ottenere tutti i dati dalla tabella
$sql = "SELECT id, title, image, description FROM prova_fantaricky";
$result = $conn->query($sql);

echo '<div class="container">';
if ($result->num_rows > 0) {
    // Ciclo attraverso i risultati
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
        echo '<img src="media/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" class="image">';
        echo '<p>' . nl2br(htmlspecialchars($row['description'])) . '</p>';
        echo '<a href="edit_data.php?id=' . $row['id'] . '">Modifica</a>';  // Bottone di modifica
        echo '</div>';
    }
} else {
    echo "Nessun risultato trovato!";
}
echo '</div>';

$conn->close();
?>
