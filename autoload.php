<?php
// Verifica se il file vendor/autoload.php esiste
$vendorAutoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($vendorAutoloadPath)) {
    die('Errore: il file vendor/autoload.php non esiste. Assicurati di aver installato le dipendenze tramite Composer.');
}

require $vendorAutoloadPath; // Assicurati di avere PHPMailer installato tramite Composer

// Includi il file di configurazione
require_once 'config.php';

// Includi il file delle funzioni
require_once 'functions.php';

// Aggiungi altre classi o file necessari qui
?>
