<?php
ini_set('display_errors', 0);
require_once './PHPMailer/src/Exception.php';
require_once './PHPMailer/src/PHPMailer.php';
require_once './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])) {
$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0; // Mostra errori dettagliati
    $mail->Debugoutput = 'html'; // Formatta l'output

    $mail->isSMTP();
    $mail->Host = 'smtp.libero.it'; // Modifica con il tuo host SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'rfederico2010@libero.it'; // Inserisci il tuo username SMTP
    $mail->Password = 'Rfed1990!'; // Inserisci la tua password SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('rfederico2010@libero.it', 'Federico');
    $mail->addAddress($_POST['email'], $_POST['name']);

    $mail->isHTML(true);
    $mail->Subject = 'Messaggi ricevuto dal sito';
    $mail->Body = $_POST['message'];
    $mail->CharSet = 'UTF-8';

    $mail->send();
    $response = 'Messaggio inviato con successo';
} catch (Exception $e) {
   $response = 'Errore nell\'invio del messaggio:' . $mail->ErrorInfo;
}
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatti</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
<main class="main-content">
    <section>
        <h2 class="section-title">Contattami</h2>
        <p class="section-text">Se hai domande, suggerimenti o vuoi semplicemente metterti in contatto con me, compila il modulo sottostante. Sarò lieto di risponderti il prima possibile.</p>
        
        <?php if(isset($response)) { ?>
            <div class="email-response">
                <div><?php echo $response; ?></div>
            </div>
        <?php } ?>

        <form class="contact-form" method="post" action="">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Messaggio:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" name="submit">Invia</button>
        </form>
    </section>
</main>

<div class="back-to-home">
    <a href="index.php" class="back-link">Torna alla homepage</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>



