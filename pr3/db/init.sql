CREATE DATABASE IF NOT EXISTS mydb;

USE mydb;

-- Создаем таблицу для продуктов
CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL,
                                        price DECIMAL(10, 2) NOT NULL,
                                        order_id INT,
                                        FOREIGN KEY (order_id) REFERENCES orders(ID) ON DELETE CASCADE
);

-- Создаем таблицу для заказов
CREATE TABLE IF NOT EXISTS orders (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      name VARCHAR(255) NOT NULL,
                                      quantity INT NOT NULL
);

-- Заполняем таблицу продуктов
INSERT INTO products (name, price, order_id) VALUES
                                       ('Product 1', 19.99, 1),
                                       ('Product 2', 29.99, 2),
                                       ('Product 3', 15.99, 1);

-- Заполняем таблицу заказов
INSERT INTO orders (name, quantity) VALUES
                                        ('Order 1', 5),
                                        ('Order 2', 3),
                                        ('Order 3', 2);
