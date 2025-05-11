<?php
// Recupera l'ID dal parametro URL (esempio: ?id=1)
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Verifica se l'ID è valido (opzionale)
if ($id === null) {
    echo "ID non valido!";
    exit;
}

// Qui recupereresti i dettagli dal database o da un array in base all'ID
// Esempio di contenuti predefiniti
$contenuti = [
    1 => ['title' => 'Karate', 'description' => 'Dettagli sulla foto di Karate', 'image' => 'karate.jpg'],
    2 => ['title' => 'Veicoli', 'description' => 'Dettagli sulla foto dei veicoli', 'image' => 'veicoli.jpg'],
    3 => ['title' => 'Moda Vintage', 'description' => 'Dettagli sulla foto di moda vintage', 'image' => 'moda_vintage.jpg'],
    4 => ['title' => 'Esplorazioni', 'description' => 'Dettagli sulla foto di esplorazioni', 'image' => 'esplorazioni.jpg']
];

// Se l'ID esiste nell'array dei contenuti, mostra i dettagli
if (isset($contenuti[$id])) {
    $contenuto = $contenuti[$id];
} else {
    echo "Contenuto non trovato!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($contenuto['title']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($contenuto['title']); ?></h1>
</header>

<div class="content">
    <img src="media/<?php echo $contenuto['image']; ?>" alt="<?php echo htmlspecialchars($contenuto['title']); ?>">
    <p><?php echo htmlspecialchars($contenuto['description']); ?></p>
</div>

<footer>
    <p>&copy; 2025 FantaRicky</p>
</footer>

</body>
</html>

