<?php
$host = 'localhost'; // Usa 'localhost' per la connessione locale
$dbname = 'mydatabase'; // Il nome corretto del tuo database
$username = 'nome_utente'; // Il nome utente configurato in phpMyAdmin
$password = 'password'; // La password per l'utente

try {
    // Connessione al database con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connessione riuscita!";
} catch (PDOException $e) {
    echo "Errore di connessione al database: " . $e->getMessage();
}
?>












































