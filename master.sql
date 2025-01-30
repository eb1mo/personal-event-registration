-- SQL script to set up the database structure
CREATE DATABASE IF NOT EXISTS event_system;

USE event_system;

-- Table for admin users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for forms (common for birth, death, migration)
CREATE TABLE IF NOT EXISTS forms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_type ENUM('birth', 'death', 'migration') NOT NULL,
    token VARCHAR(6) NOT NULL UNIQUE,
    data JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Default admin user (username: admin, password: admin123 - hashed with bcrypt in PHP)
INSERT INTO users (username, password) VALUES (
    'admin',
    '$2y$10$CwTycUXWue0Thq9StjUM0uJ8wEpOg1zTH3QqDlCq/5rDZmj.JLjGG' -- 'admin123'
) ON DUPLICATE KEY UPDATE username=username;

