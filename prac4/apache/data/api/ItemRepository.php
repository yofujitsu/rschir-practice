<?php



include_once "model/Database.php";

class ItemRepository
{
    private $conn;
    private $table_name = "items";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll(): void
    {
        $result = $this->conn->query("SELECT * FROM $this->table_name");
        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row;
        }

        http_response_code(200);
        echo json_encode($arr);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM $this->table_name WHERE $this->table_name.id = $id";
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

    public function create(): void
    {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->name) || empty($data->description) || empty($data->price) || empty($data->availability)) {
            http_response_code(400);
            return;
        }

        $query = "INSERT INTO $this->table_name (name, description, price, availability) 
                    VALUES (\"$data->name\", \"$data->description\", \"$data->price\", \"$data->availability\")";

        $this->conn->query($query);
        http_response_code(201);
    }

    public function update($id): void
    {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($id)) {
            http_response_code(400);
            return;
        }

        $query =
            "UPDATE $this->table_name SET 
                    name=\"$data->name\", 
                    description=\"$data->description\", 
                    price=\"$data->price\",
                    availability=\"$data->availability\"
                WHERE id=$id";

        if ($this->conn->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }

    public function delete($id): void
    {
        $query = "DELETE FROM $this->table_name WHERE id = $id";

        if ($this->conn->query($query)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }
}