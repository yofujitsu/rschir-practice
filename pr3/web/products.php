<?php

use service\web\src\entity\Product;

include_once 'product.php';

header("Content-Type: application/json; charset=UTF-8");


$mysqli = new mysqli("db", "myuser", "mypassword", "mydb");
mysqli_set_charset($mysqli, 'utf8');
$id = (isset($_GET['id'])) ? intval($_GET['id']) : '';

if ($mysqli->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $mysqli->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($id)) {
        Product::getProductById($mysqli, $id);
    } else {
        Product::getAllProducts($mysqli);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Product::createProduct($mysqli);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (!empty($id)) {
        Product::deleteProductById($mysqli, $id);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (!empty($id)) {
        Product::updateProduct($mysqli, $id);
    }
}


$mysqli->close();
?>
