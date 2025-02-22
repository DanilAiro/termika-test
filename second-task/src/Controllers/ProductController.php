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
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
    }

    public function getCollections(): void {
        try {
            $collections = $this->collection->getAllWithProducts();
            $this->sendJSON(['data' => $collections]);
        } catch (\Throwable $th) {
            error_log("Error in getProduct: " . $th->getMessage());
            $this->sendJSON(['error' => 'Internal server error'], 500);
        }
    }

    public function getProduct(int $id): void {
        try {
            if ($id <= 0) {
                $this->sendJSON(['error' => 'Invalid product ID'], 400);
                return;
            }

            $product = $this->product->getById($id);

            if (!$product) {
                $this->sendJSON(['error' => "Product not found"], 404);
                return;
            }

            $this->sendJSON(['data' => $product]);
        } catch (\Throwable $th) {
            error_log("Error in getProduct: " . $th->getMessage());
            $this->sendJSON(['error' => 'Internal server error'], 500);
        }
    }
}
