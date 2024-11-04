<?php
class DB
{
    private static $conn = null;

    public static function getConnection()
    {
        try {
            if (self::$conn == null) {
                // Carga la configuración desde el archivo config.php
                $config = include 'config.php';
                self::$conn = new PDO(
                    "mysql:host=" . $config['serverName'] . ";dbname=" . $config['dbName'],
                    $config['username'],
                    $config['password']
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$conn;
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw $e;
        }
    }
}