<?php
// Includi il file di configurazione
require_once 'config.php';

// Funzione per inviare una richiesta API a OpenAI
function inviaRichiestaOpenAI($prompt) {
    $apiKey = 'TUA_API_KEY'; // Sostituisci con la tua chiave API OpenAI
    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';

    $data = [
        'prompt' => $prompt,
        'max_tokens' => 100,
        'temperature' => 0.7,
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $apiKey\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        return 'Errore nella richiesta API';
    }

    $response = json_decode($result, true);
    return $response['choices'][0]['text'];
}

// Esempio di utilizzo della funzione
$prompt = "Scrivi una breve descrizione di un gatto.";
$risposta = inviaRichiestaOpenAI($prompt);
echo $risposta;
?>
