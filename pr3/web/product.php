<?php

class Product {

    public static function getAllProducts($mysqli): void {
        $result = $mysqli->query("SELECT * FROM products");
        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row;
        }

        http_response_code(200);
        echo json_encode($arr);
    }

    public static function getProductById($mysqli, $ID): void {
        $query = "SELECT * FROM products WHERE products.ID = $ID";
        $result = $mysqli->query($query);

        $data = $result->fetch_alloc();

        if (empty($data)) {
            http_response_code(200);
            echo json_encode(array());
            return;
        }

        http_response_code(200);
        echo json_encode($data);
    }

    public static function createProduct($mysqli): void {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->name) || empty($data->price) || empty($data->order_id)) {
            http_response_code(400);
            return;
        }

        $query = "INSERT INTO products (name, price) VALUES (\"$data->name\", \"$data->price\", \"$data->order_id\)";

        $mysqli->query($query);
        http_response_code(201);
    }


    public static function updateProduct($mysqli, $ID): void {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($ID)) {
            http_response_code(400);
            return;
        }

        $query = "UPDATE products SET name=\"$data->name\", price=\"$data->price\", \"$data->order_id\" WHERE ID=$ID";

        if ($mysqli->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }


    public static function deleteProductById($mysqli, $ID): void {
        $query = "DELETE FROM products WHERE products.ID = $ID";


        if (empty($ID)) {
            http_response_code(400);
            return;
        }

        if ($mysqli->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }
}
?>
