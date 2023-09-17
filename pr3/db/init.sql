-- Создаем базу данных, если ее нет
CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

-- Создаем таблицу для продуктов
CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL,
                                        price DECIMAL(10, 2) NOT NULL
);

-- Создаем таблицу для заказов
CREATE TABLE IF NOT EXISTS orders (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      name VARCHAR(255) NOT NULL,
                                      quantity INT NOT NULL,
                                      product_id INT,
                                      FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Заполняем таблицу продуктов
INSERT INTO products (name, price) VALUES
                                       ('Product 1', 19.99),
                                       ('Product 2', 29.99),
                                       ('Product 3', 15.99);

-- Заполняем таблицу заказов
INSERT INTO orders (name, quantity, product_id) VALUES
                                        ('Order 1', 5, 1),
                                        ('Order 2', 3, 2),
                                        ('Order 3', 2, 1);
