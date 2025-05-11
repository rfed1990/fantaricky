$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.libero.it';
    $mail->SMTPAuth = true;
    $mail->Username = 'rfederico2010@libero.it';
    $mail->Password = 'Rfed1990!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    
    // Aggiungi il debug
    $mail->SMTPDebug = 2; // Modifica il livello di debug per avere più dettagli
    $mail->Debugoutput = 'html';

    $mail->setFrom('tuaemail@libero.it', 'Federico');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->send();
} catch (Exception $e) {
    echo 'Errore: ' . $mail->ErrorInfo;
}

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo di Contatto</title>
</head>
<body>
    <h2>Modulo di Contatto</h2>
    
    <form action="submit_contact.php" method="POST">
        <!-- Campo per l'email del destinatario -->
        <label for="to">Destinatario:</label>
        <input type="email" id="to" name="to" required placeholder="Inserisci l'email del destinatario">

        <br><br>

        <!-- Campo per l'oggetto dell'email -->
        <label for="subject">Oggetto:</label>
        <input type="text" id="subject" name="subject" required placeholder="Inserisci l'oggetto">

        <br><br>

        <!-- Campo per il corpo del messaggio -->
        <label for="body">Messaggio:</label>
        <textarea id="body" name="body" required placeholder="Inserisci il corpo del messaggio"></textarea>

        <br><br>

        <!-- Campo per l'email del mittente -->
        <label for="email">La tua email:</label>
        <input type="email" id="email" name="email" required placeholder="Inserisci la tua email">

        <br><br>

        <!-- Pulsante di invio -->
        <button type="submit">Invia</button>
    </form>

</body>
</html>









