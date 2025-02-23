<?php

class Product {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
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
            throw new Exception("Error in getById: " . $th->getMessage());
        }
    }
}
