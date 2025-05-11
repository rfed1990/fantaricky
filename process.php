<?php
// Configurazione della connessione al database
$host = 'localhost'; // O l'indirizzo del tuo server (es. '127.0.0.1' o un server remoto)
$dbname = 'nome_database'; // Sostituisci con il nome del tuo database
$username = 'nome_utente'; // Sostituisci con il nome utente del tuo database
$password = 'password'; // Sostituisci con la tua password del database

// Connessione al database con PDO
try {
    // PDO con eccezioni per errori
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Imposta il gestore di errori di PDO a "Eccezione"
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se la connessione ha successo, questa riga verrà eseguita
    echo "Connessione al database riuscita!";
} catch (PDOException $e) {
    // In caso di errore, verrà eseguito questo blocco
    // Mostra il messaggio dell'errore di connessione
    echo "Errore di connessione al database: " . $e->getMessage();
}
?>



