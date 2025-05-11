<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mio_database"; // Usa il nome del tuo database qui

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $mail = $_POST['mail'];
        $commento = $_POST['commento'];

        // Prepara la query per evitare l'iniezione SQL
        $stmt = $conn->prepare("INSERT INTO commenti (nome, mail, commento) VALUES (:nome, :mail, :commento)");

        // Associa i valori ai segnaposto
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':commento', $commento);

        // Esegui la query
        if ($stmt->execute()) {
            echo "<p>Commento inviato con successo!</p>";
        } else {
            echo "<p>Errore durante l'invio del commento.</p>";
        }
    }
} catch(PDOException $e) {
    echo "Connessione fallita: " . $e->getMessage();
}

// Chiudi la connessione
$conn = null;
?>
