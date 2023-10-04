<?php

use service\web\src\entity\Order;

include_once 'order.php';

header("Content-Type: application/json; charset=UTF-8");

$order = new Order();
$mysqli = new mysqli("db", "myuser", "mypassword", "mydb");
mysqli_set_charset($mysqli, 'utf8');
$id = (isset($_GET['id'])) ? intval($_GET['id']) : '';

if ($mysqli->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $mysqli->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($id)) {
        Order::getOrderById($mysqli, $id);
    } else {
        Order::getAllOrders($mysqli);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Order::createOrder($mysqli);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (!empty($id)) {
        Order::deleteOrderById($mysqli, $id);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (!empty($id)) {
        Order::updateOrder($mysqli, $id);
    }
}


$mysqli->close();
?>
