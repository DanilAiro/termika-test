<?php

class Database {
    private string $host;
    private string $database;
    private string $username;
    private string $password;

    private PDO $conn;

    public function getConnection(): PDO {
        if (!isset($this->conn)) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$_SERVER['DB_HOST']};dbname={$_SERVER['DB_NAME']};charset=utf8mb4",
                    $_SERVER['DB_USER'],
                    $_SERVER['DB_PASS']
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
