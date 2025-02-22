CREATE DATABASE IF NOT EXISTS test_schema
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE test_schema;

CREATE TABLE collections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    collection_id INT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (collection_id) REFERENCES collections(id)
);