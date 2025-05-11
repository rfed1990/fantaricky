<?php
// Funzione per salutare
function sayHello($name) {
    return "Hello, " . $name . "!";
}

// Funzione per connettersi al database
function connectToDatabase() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    return $conn;
}

// Funzione per ottenere i commenti dal database
function getComments() {
    $conn = connectToDatabase();
    $sql = "SELECT name, email, comment FROM commenti";
    $result = $conn->query($sql);

    $comments = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }

    $conn->close();
    return $comments;
}

// Aggiungi altre funzioni necessarie
?>








