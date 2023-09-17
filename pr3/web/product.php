<?php
class Product {
    public $id;
    public $name;
    public $price;

    public function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public static function getProductById($mysqli, $id) {
        $query = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 1) {
            $data = $result->fetch_assoc();
            return new Product($data['id'], $data['name'], $data['price']);
        } else {
            return null;
        }
    }

    // Другие методы для работы с продуктами
}
?>
