<?php

include_once "../data/database.php";

class Product {
    private $conn;
    private $table_name = "Products";

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll(): void {
        $result = $this->conn->query("SELECT * FROM $this->table_name");
        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row;
        }

        http_response_code(200);
        echo json_encode($arr);
    }

    public function getById($ID): void {
        $query = "SELECT * FROM $this->table_name WHERE $this->table_name.ID = $ID";
        $result = $this->conn->query($query);


        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row;
        }

        if (empty($arr[0])) {
            http_response_code(200);
            echo json_encode(array());
            return;
        }

        http_response_code(200);
        echo json_encode($arr[0]);
    }

    public function create(): void {
        $data = json_decode(file_get_contents("php://input"));


        if (empty($data->name) || empty($data->price) || empty($data->categoryId)) {
            http_response_code(400);
            return;
        }

        $query = "INSERT INTO $this->table_name (name, price, categoryId) 
                    VALUES (\"$data->name\", \"$data->price\", \"$data->categoryId\")";


        $this->conn->query($query);
        http_response_code(201);
    }


    public function update($ID): void {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($ID)) {
            http_response_code(400);
            return;
        }


        $query =
            "UPDATE $this->table_name SET 
                    name=\"$data->name\", 
                    price=\"$data->price\", 
                    categoryId=\"$data->categoryId\"
                WHERE ID=$ID";

        if ($this->conn->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }


    public function delete($ID): void {
        $query = "DELETE FROM $this->table_name WHERE ID = $ID";


        if (empty($ID)) {
            http_response_code(400);
            return;
        }

        if ($this->conn->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }
}

