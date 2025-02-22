<?php

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Controllers/ProductController.php';
require_once __DIR__ . '/../Models/Collection.php';
require_once __DIR__ . '/../Models/Product.php';

$db = new Database();

$collection = new Collection($db->getConnection());
$product = new Product($db->getConnection());

$controller = new ProductController($collection, $product);

if (!isset($_SERVER['REQUEST_URI']) || !isset($_SERVER['REQUEST_METHOD'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$basePath = '/second-task/src/public';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace($basePath, '', $path);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit(0);
}

$routes = [
    'GET' => [
        '/api/collections' => [$controller, 'getCollections'],
        '/api/product/(\d+)' => [$controller, 'getProduct']
    ]
];

if (isset($routes[$method])) {
    foreach ($routes[$method] as $route => $handler) {
        if (preg_match("#^$route$#", $path, $matches)) {
            call_user_func_array($handler, array_slice($matches, 1));
            exit;
        }
    }
}

header('HTTP/1.1 404 Not Found');
echo json_encode(['error' => 'You entered the wrong door']);
