<?php
$host = 'localhost';
$dbname = 'nome_database';
$username = 'nome_utente';
$password = 'password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connessione al database riuscita!";
} catch (PDOException $e) {
    echo "Errore di connessione: " . $e->getMessage();
}
?>
