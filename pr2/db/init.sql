CREATE TABLE products (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          description TEXT,
                          price DECIMAL(10, 2) NOT NULL
);

INSERT INTO products (name, description, price) VALUES
                                                    ('Продукт 1', 'Описание продукта 1', 19.99),
                                                    ('Продукт 2', 'Описание продукта 2', 29.99),
                                                    ('Продукт 3', 'Описание продукта 3', 9.99);