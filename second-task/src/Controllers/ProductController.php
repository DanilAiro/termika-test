<?php

require_once __DIR__ . '/../Models/Collection.php';
require_once __DIR__ . '/../Models/Product.php';

class ProductController {
    private Collection $collection;
    private Product $product;

    public function __construct(Collection $collection, Product $product) {
        $this->collection = $collection; 
        $this->product = $product;
    }

    private function sendJSON($data, $statusCode = 200): void {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }

    public function getCollections(): void {
        try {
            $collections = $this->collection->getAllWithProducts();
            $this->sendJSON(['data' => $collections]);
        } catch (Exception $th) {
            $this->sendJSON(['error' => $th->getMessage()], 500);
        }
    }

    public function getProduct(int $id): void {
        try {
            $product = $this->product->getById($id);

            if (!$product) {
                $this->sendJSON(['error' => "Product not found"], 404);
                return;
            }

            $this->sendJSON(['data' => $product]);
        } catch (Exception $th) {
            $this->sendJSON(['error' => $th->getMessage()], 500);
        }
    }
}
