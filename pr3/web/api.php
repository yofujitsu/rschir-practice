<?php
require 'order.php';
require 'product.php';

header('Content-Type: application/json');

// Устанавливаем соединение с базой данных
$mysqli = new mysqli("db", "myuser", "mypassword", "mydb");

// Проверяем соединение на ошибки
if ($mysqli->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $mysqli->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['entity']) && $_GET['entity'] === 'orders') {
        if (isset($_GET['id'])) {
            $orderId = $_GET['id'];
            $order = Order::getOrderById($mysqli, $orderId);

            if ($order) {
                $product = Product::getProductById($mysqli, $order->product_id);
                $order->product = $product;
                echo json_encode($order);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Order not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing order ID']);
        }
    } elseif (isset($_GET['entity']) && $_GET['entity'] === 'products') {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            $product = Product::getProductById($mysqli, $productId);

            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing product ID']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid entity']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

// Закрываем соединение с базой данных
$mysqli->close();
?>
