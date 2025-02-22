<?php

class Product {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(): array {
        $query = "SELECT * FROM products";
        $data = $this->db->prepare($query);
        $data->execute();
        $data->fetchAll(PDO::FETCH_ASSOC);

        return $result ?: [];
    }

    public function getById(int $id): array {
        $query = "SELECT p.*, c.name as collection_name 
                FROM products p
                LEFT JOIN collections c ON p.collection_id = c.id
                WHERE p.id = ?";
        $data = $this->db->prepare($query);
        $data->execute([$id]);
        $result = $data->fetch(PDO::FETCH_ASSOC);

        return $result ?: [];
    }
}
