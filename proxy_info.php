<?php
require_once 'config.php';

function getProxySettings() {
    $proxyInfo = [];
    
    // Verifica le impostazioni del proxy di sistema
    $proxyInfo['system_http_proxy'] = getenv('HTTP_PROXY');
    $proxyInfo['system_https_proxy'] = getenv('HTTPS_PROXY');
    
    // Verifica le impostazioni del proxy PHP
    $proxyInfo['php_proxy'] = ini_get('proxy');
    $proxyInfo['php_proxy_port'] = ini_get('proxy_port');
    
    // Verifica le impostazioni del wrapper HTTP
    $default_context = stream_context_get_default();
    if (isset($default_context['http']['proxy'])) {
        $proxyInfo['stream_proxy'] = $default_context['http']['proxy'];
    }
    
    // Verifica la connettività
    $proxyInfo['internet_connection'] = checkInternetConnection();
    
    return $proxyInfo;
}

function checkInternetConnection() {
    $testUrl = 'http://www.google.com';
    $timeout = 5;
    
    $ch = curl_init($testUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return $httpCode >= 200 && $httpCode < 300;
}

// Ottieni le informazioni sul proxy
$proxySettings = getProxySettings();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informazioni Proxy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .info-section {
            margin: 15px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            margin-left: 10px;
        }
        .status-ok {
            background-color: #d4edda;
            color: #155724;
        }
        .status-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Informazioni sulla Connessione Proxy</h1>
        
        <div class="info-section">
            <h3>Stato Connessione Internet</h3>
            <p>
                Connessione: 
                <?php if ($proxySettings['internet_connection']): ?>
                    <span class="status status-ok">Attiva</span>
                <?php else: ?>
                    <span class="status status-error">Non Attiva</span>
                <?php endif; ?>
            </p>
        </div>

        <div class="info-section">
            <h3>Proxy di Sistema</h3>
            <p>HTTP Proxy: <?php echo $proxySettings['system_http_proxy'] ?: 'Non configurato'; ?></p>
            <p>HTTPS Proxy: <?php echo $proxySettings['system_https_proxy'] ?: 'Non configurato'; ?></p>
        </div>

        <div class="info-section">
            <h3>Configurazione Proxy PHP</h3>
            <p>Proxy: <?php echo $proxySettings['php_proxy'] ?: 'Non configurato'; ?></p>
            <p>Porta Proxy: <?php echo $proxySettings['php_proxy_port'] ?: 'Non configurata'; ?></p>
        </div>

        <div class="info-section">
            <h3>Proxy Stream HTTP</h3>
            <p>Stream Proxy: <?php echo isset($proxySettings['stream_proxy']) ? $proxySettings['stream_proxy'] : 'Non configurato'; ?></p>
        </div>
    </div>
</body>
</html>