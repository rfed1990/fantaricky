<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Automatico Dati</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .status { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .button { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .button:hover { background-color: #0056b3; }
        #result { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inserimento Automatico Dati</h1>
        <p>Usa questo pannello per gestire l'inserimento automatico dei dati nel database.</p>
        
        <button id="startInsert" class="button">Avvia Inserimento Automatico</button>
        
        <div id="result"></div>
    </div>

    <script>
    document.getElementById('startInsert').addEventListener('click', function() {
        this.disabled = true;
        this.textContent = 'Inserimento in corso...';
        
        fetch('auto_insert.php')
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                const statusClass = data.errors === 0 ? 'success' : 'error';
                
                resultDiv.innerHTML = `
                    <div class="status ${statusClass}">
                        <h3>Risultato dell'inserimento:</h3>
                        <p>${data.message}</p>
                        <p>Inserimenti riusciti: ${data.success}</p>
                        <p>Errori: ${data.errors}</p>
                    </div>
                `;
                
                this.disabled = false;
                this.textContent = 'Avvia Inserimento Automatico';
            })
            .catch(error => {
                const resultDiv = document.getElementById('result');
                resultDiv.innerHTML = `
                    <div class="status error">
                        <h3>Errore</h3>
                        <p>Si è verificato un errore durante l'inserimento: ${error.message}</p>
                    </div>
                `;
                
                this.disabled = false;
                this.textContent = 'Avvia Inserimento Automatico';
            });
    });
    </script>
</body>
</html>