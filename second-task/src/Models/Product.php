<?php

class Product {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(): array {
        try {
            $query = "SELECT * FROM products";
            $data = $this->db->prepare($query);
            $data->execute();
    
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            error_log("Error in getById: " . $th->getMessage());
            $this->sendJSON(['error' => 'Internal server error'], 500);
        }
    }

    public function getById(int $id): array {
        try {
            $query = "SELECT p.*, c.name as collection_name 
                    FROM products p
                    LEFT JOIN collections c ON p.collection_id = c.id
                    WHERE p.id = ?";
            $data = $this->db->prepare($query);
            $data->execute([$id]);
    
            return $data->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (\Throwable  $th) {
            error_log("Error in getById: " . $th->getMessage());
            $this->sendJSON(['error' => 'Internal server error'], 500);
        }
    }
}
