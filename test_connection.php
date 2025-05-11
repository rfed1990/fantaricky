<?php
require_once 'config.php';
require_once 'db.php';

try {
    $db = Database::getInstance();
    $connection = $db->getConnection();
    echo "Connessione al database riuscita!<br>";
    echo "Versione MySQL: " . $connection->getAttribute(PDO::ATTR_SERVER_VERSION);
} catch (PDOException $e) {
    echo "<h3>Errore di connessione al database</h3>";
    echo "<p>Si è verificato un errore durante la connessione al database. Per favore verifica che:</p>";
    echo "<ul>";
    echo "<li>Il server MySQL (XAMPP) sia in esecuzione</li>";
    echo "<li>Le credenziali di accesso nel file di configurazione siano corrette</li>";
    echo "<li>Il database sia raggiungibile all'indirizzo e porta specificati</li>";
    echo "</ul>";
    echo "<p>Dettagli tecnici dell'errore: " . $e->getMessage() . "</p>";
}
?>