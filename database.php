// database.php
<?php
$servername = "localhost";
$username = "root";  // Default di XAMPP
$password = "";
$dbname = "mio_database"; // Sostituisci con il nome del tuo database

// Crea connessione
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verifica la connessione
if ($mysqli->connect_error) {
    die("Connessione fallita: " . $mysqli->connect_error);
}
?>
