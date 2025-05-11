<?php
include 'db.php';  // Connessione al database

// Verifica se l'ID è passato tramite GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ottieni i dati esistenti
    $sql = "SELECT title, image, description FROM prova_fantaricky WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Passione non trovata!";
        exit;
    }
} else {
    echo "ID non specificato!";
    exit;
}

// Verifica se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    // Query per aggiornare i dati nella tabella
    $update_sql = "UPDATE prova_fantaricky SET title = '$title', image = '$image', description = '$description' WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        echo "Dati aggiornati con successo!";
        header("Location: index.php");  // Redirect alla pagina principale dopo l'aggiornamento
    } else {
        echo "Errore nell'aggiornamento dei dati: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Passione</title>
</head>
<body>
    <h1>Modifica Passione</h1>
    <form action="edit_data.php?id=<?php echo $id; ?>" method="POST">
        <label for="title">Titolo:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>

        <label for="image">Immagine:</label>
        <input type="text" name="image" id="image" value="<?php echo htmlspecialchars($row['image']); ?>" required><br><br>

        <label for="description">Descrizione:</label>
        <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>

        <input type="submit" value="Aggiorna">
    </form>
</body>
</html>
