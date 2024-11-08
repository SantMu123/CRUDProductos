<?php
function getDatabaseConnection() {
    $host = 'junction.proxy.rlwy.net';
    $port = 11649;
    $user = 'root';
    $password = 'uJtjdeMkDtbQyNZbOSNVWmUmaHxDSXXi';
    $database = 'Tecnologia';

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8";
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die(json_encode(["error" => "Conexión fallida: " . $e->getMessage()]));
    }
}

return getDatabaseConnection();
?>