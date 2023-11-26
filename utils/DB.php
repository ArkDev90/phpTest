<?php

class DB
{
    private $pdo;
    private static $instance = null;

    private function __construct()
    {
        $host = '127.0.0.1';
        $databaseName = 'phptest';
        $username = 'root';
        $password = '';

        $dsn = "mysql:host=$host;dbname=$databaseName;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection error
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

    public function select($sql)
    {
        $statement = $this->pdo->query($sql);
        return $statement->fetchAll();
    }

    public function execute($sql)
    {
        return $this->pdo->exec($sql);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
