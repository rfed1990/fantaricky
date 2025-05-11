<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "tuoindirizzoemail@example.com"; // Sostituisci con il tuo indirizzo email
    $subject = "Nuovo messaggio dal modulo di contatto";
    $body = "Nome: $name\nEmail: $email\n\nMessaggio:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Messaggio inviato con successo!";
    } else {
        echo "Errore nell'invio del messaggio.";
    }
}
?>
