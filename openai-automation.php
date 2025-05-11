<?php
// Includi il file di configurazione
require_once 'config.php';
require_once 'openai-api.php';

// Esempio di utilizzo della funzione per automatizzare una richiesta
$prompt = "Genera un'idea per un progetto PHP.";
$risposta = inviaRichiestaOpenAI($prompt);
echo "<h1>Risposta da OpenAI:</h1>";
echo "<p>$risposta</p>";
?>
