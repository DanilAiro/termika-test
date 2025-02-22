<?php

class Database {
    private string $host = "";
    private string $database = "";
    private string $username = "";
    private string $password = "";

    private PDO $conn;

    public function getConnection(): PDO {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed.");
        }
    }
}
