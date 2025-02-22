<?php

class Collection {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(): array {
        $query = "SELECT * FROM collections";
        $data = $this->db->prepare($query);
        $data->execute();
        
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithProducts(): array {
        $query = "SELECT c.id as collection_id,
                c.name as collection_name,
                IFNULL(
                CONCAT('[', GROUP_CONCAT(
                    JSON_OBJECT(
                        'id', p.id,
                        'name', p.name,
                        'price', p.price
                        )
                    ), ']'), '[]'
                ) as products
                FROM collections c
                LEFT JOIN products p
                ON p.collection_id = c.id
                GROUP BY c.id, c.name";
        $data = $this->db->prepare($query);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$row) {
            $row['products'] = json_decode($row['products'], true);
        }

        return $result ?: [];
    }
}
