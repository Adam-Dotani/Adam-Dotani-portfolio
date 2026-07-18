-- Run this script in MySQL (phpMyAdmin or mysql CLI)
-- Creates database and tables for ECS417U Phase 2

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users (email, password)
VALUES (
    'adamdotanisocial@gmail.com',
    '$2y$10$XutffmfuVGdPNgWTzY0PX.KGI8RBGZFzX/QYlESimt3nqb2yscmU2'
);
