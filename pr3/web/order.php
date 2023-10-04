<?php

class Order {


    public static function getAllOrders($mysqli): void {
        $result = $mysqli->query("SELECT * FROM orders");
        $arr = array();
        foreach ($result as $row) {
//            $arr[] = $row;
            $id=$row['ID'];
            $name=$row['name'];
            $quantity=$row['quantity'];
            $products=$mysqli->query("SELECT * FROM products WHERE order_id = $id");
            $productArray=[];
            foreach ($products as $r) {
                $productArray[]=[
                    "ID"=>$r['ID'],
                    "name"=>$r['name'],
                    "price"=>$r['price']
                ];
            }
            $res=[
                "ID"=>$id,
                "name"=>$name,
                "quantity"=>$quantity,
                "products"=>$productArray
            ];
            $arr[] = $res;
        }

        http_response_code(200);
        echo json_encode($arr);
    }

    public static function getOrderById($mysqli, $ID): void {
        $query = "SELECT * FROM orders WHERE orders.ID = $ID";
        $result = $mysqli->query($query);

        $arr = array();
        foreach ($result as $row) {
            $id=$row['ID'];
            $name=$row['name'];
            $quantity=$row['quantity'];
            $products=$mysqli->query("SELECT * FROM products WHERE id = $id");
            $productArray=[];
            foreach ($products as $r) {
                $productArray[]=[
                    "ID"=>$r['ID'],
                    "name"=>$r['name'],
                    "price"=>$r['price']
                ];
            }
            $res=[
                "ID"=>$id,
                "name"=>$name,
                "quantity"=>$quantity,
                "products"=>$productArray
            ];
            $arr[] = $res;
        }

        if (empty($arr[0])) {
            http_response_code(200);
            echo json_encode(array());
            return;
        }

        http_response_code(200);
        echo json_encode($arr[0]);
    }

    public static function createOrder($mysqli): void {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->name) || empty($data->quantity)) {
            http_response_code(400);
            return;
        }

        $query = "INSERT INTO orders (name, quantity)  VALUES (\"$data->name\", \"$data->quantity\")";


        $mysqli->query($query);
        http_response_code(201);
    }


    public static function updateOrder($mysqli, $ID): void {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($ID)) {
            http_response_code(400);
            return;
        }


        $query = "UPDATE orders SET name=\"$data->name\", quantity=\"$data->quantity\" WHERE ID=$ID";

        if ($mysqli->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }


    public static function deleteOrderById($mysqli, $ID): void {
        $query = "DELETE FROM orders WHERE orders.ID = $ID";

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
