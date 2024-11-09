<?php
function loadEnv() {
    $envFile = __DIR__ . '/../.env';
    
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentarios
            if (strpos($line, '#') === 0) {
                continue;
            }
            // Parsear las variables de entorno
            list($key, $value) = explode('=', $line, 2);
            if (!empty($key) && !empty($value)) {
                putenv(trim($key) . '=' . trim($value));
            }
        }
    } else {
        throw new Exception('.env file not found.');
    }
}
