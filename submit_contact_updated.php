use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.libero.it';
    $mail->SMTPAuth = true;
    $mail->Username = 'rfederico2010@libero.it';
    $mail->Password = 'Rfed1990!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usa ENCRYPTION_STARTTLS se la porta è 587
    $mail->Port = 465;

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal modulo
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Imposta l'indirizzo email a cui inviare il messaggio
    $to = "rfederico2010@libero.it.com"; // Sostituisci con il tuo indirizzo email
    $subject = "Nuovo messaggio dal modulo di contatto";
    $body = "Nome: $name\nEmail: $email\n\nMessaggio:\n$message";
    $headers = "From: $email";

    // Invia l'email
    $mail->setFrom('rfederico2010@libero.it', 'Federico');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    if ($mail->send()) {
        echo "Email inviata con successo!";
    } else {
        echo "Errore nell'invio della mail.";
    }
        echo "Messaggio inviato con successo.";
    } else {
        // Segnala l'errore al webmaster
        $webmaster_email = "webmaster@example.com"; // Sostituisci con l'indirizzo email del webmaster
        $error_subject = "Errore nell'invio del messaggio dal modulo di contatto";
        $error_body = "Errore nell'invio del messaggio a $to con soggetto $subject e corpo $body";
    $mail->clearAddresses(); // Pulisce gli indirizzi precedenti
    $mail->addAddress($webmaster_email);
    $mail->Subject = $error_subject;
    $mail->Body    = $error_body;
    $mail->setFrom($email);
    $mail->send();

        echo "Errore nell'invio del messaggio. Si prega di riprovare più tardi.";
    }
?>







} catch (Exception $e) {
    echo 'Errore: ' . $mail->ErrorInfo;
}
