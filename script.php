<?php
$filename = "karate.php";  // Nome del file da leggere
$line_number = 4;  // Riga da cercare
$search_phrase = "include(header.php)";  // Frase da cercare

// Legge il file in un array (ogni riga diventa un elemento)
$file_lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Controlla se la riga esiste
if (isset($file_lines[$line_number - 1])) {
    $line_content = $file_lines[$line_number - 1]; // Ottieni la riga 4
    if (strpos($line_content, $search_phrase) !== false) {
        echo "La frase '$search_phrase' è presente sulla riga $line_number!";
    } else {
        echo "La frase '$search_phrase' NON è presente sulla riga $line_number.";
    }
} else {
    echo "La riga $line_number non esiste nel file!";
}
?>
