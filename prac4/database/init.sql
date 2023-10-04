CREATE DATABASE IF NOT EXISTS php_database;

CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY 'password123';
GRANT ALL ON php_database.* TO 'root'@'%';
FLUSH PRIVILEGES;

USE php_database;

CREATE TABLE IF NOT EXISTS items (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    availability BOOLEAN NOT NULL,
    description VARCHAR(100)
);

INSERT INTO items (name, price, availability, description)
VALUES 
    ('Voidstorm Asylum', 0, false, 'Razor Arcana 2022'),
    ('Claszian Apostasy', 0, false, 'Void Arcana 2022'),
    ('Dread Retribution Bundle', 0, false, 'Traxex Arcana 2021'),
    ('Feast of Abscession', 3200, true, 'Pudge Arcana 2018'),
    ('Great Sage''s Reckoning', 2800, true, 'Sun Wukong Arcana 2016');

CREATE TABLE IF NOT EXISTS users (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(80) NOT NULL,
    name VARCHAR(20),
    role VARCHAR(20)
);

INSERT INTO users (id, login, password, name, role)
VALUES 
    (1, 'admin', '$2y$10$zg8.a61TAaVe.IbijfV/9OcCK2mqWruVU9ZPDCt3LaV0kyfjIgj4K', 'Директор', 'admin'),
    (2, 'user', 'hash', 'Клиент', 'user');