<?php

include_once "../data/database.php";

class Category {
    private $conn;
    private $table_name = "Categories";


    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll(): void {
        $result = $this->conn->query("SELECT * FROM $this->table_name");
        $arr = array();
        foreach ($result as $row) {
//            $arr[] = $row;
            $id=$row['ID'];
            $name=$row['name'];
            $descr=$row['description'];
            $products=$this->conn->query("SELECT * FROM Products WHERE categoryId = $id");
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
                "description"=>$descr,
                "products"=>$productArray
            ];
            $arr[] = $res;
        }

        http_response_code(200);
        echo json_encode($arr);
    }

    public function getById($ID): void {
        $query = "SELECT * FROM $this->table_name WHERE $this->table_name.ID = $ID";
        $result = $this->conn->query($query);


        $arr = array();
        foreach ($result as $row) {
            $id=$row['ID'];
            $name=$row['name'];
            $products=$this->conn->query("SELECT * FROM Products WHERE categoryId = $id");
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

    public function create(): void {
        $data = json_decode(file_get_contents("php://input"));


        if (empty($data->name)) {
            http_response_code(400);
            return;
        }

        $query = "INSERT INTO $this->table_name (name, description) 
                    VALUES (\"$data->name\", \"$data->description\")";


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
                    description=\"$data->description\"
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
