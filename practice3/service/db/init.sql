CREATE DATABASE IF NOT EXISTS productsDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON productsDB.* TO 'user'@'%';
FLUSH PRIVILEGES;


USE productsDB;

CREATE TABLE IF NOT EXISTS Categories
(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(100)
);

INSERT INTO Categories(name, description)
VALUES ('Fruit', 'Fresh'),
       ('Liquid', 'Cold'),
       ('Hot', 'Russian'),
       ('Vegetable', 'Young');

CREATE TABLE IF NOT EXISTS Products
(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    price INT NOT NULL,
    categoryId INT,
    FOREIGN KEY (categoryId) REFERENCES Categories(ID) ON DELETE CASCADE
);

INSERT INTO Products(name, price, categoryId)
VALUES ('Apple', 10, (SELECT ID FROM Categories WHERE name='Fruit')),
    ('Orange juice', 99, (SELECT ID FROM Categories WHERE name='Liquid')),
    ('Pilaf', 150, (SELECT ID FROM Categories WHERE name='Hot')),
    ('Pasta', 199, (SELECT ID FROM Categories WHERE name='Hot')),
    ('Banana', 25, (SELECT ID FROM Categories WHERE name='Fruit')),
    ('Tomato', 18, (SELECT ID FROM Categories WHERE name='Vegetable'));

COMMIT;