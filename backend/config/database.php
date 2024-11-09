<?php
require_once __DIR__ . '/../loadEnv.php';
loadEnv();

function getDatabaseConnection() {
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $database = getenv('DB_NAME');
    $charset = getenv('DB_CHARSET');

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=$charset";
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die(json_encode(["error" => "Conexión fallida: " . $e->getMessage()]));
    }
}

return getDatabaseConnection();
?>