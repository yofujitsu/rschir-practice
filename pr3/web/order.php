<?php
class Order {
    public $id;
    public $name;
    public $quantity;
    public $product_id;

    public function __construct($id, $name, $quantity, $product_id) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->product_id = $product_id;
    }

    public static function getOrderById($mysqli, $id) {
        $query = $mysqli->prepare("SELECT * FROM orders WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 1) {
            $data = $result->fetch_assoc();
            return new Order($data['id'], $data['name'], $data['quantity'], $data['product_id']);
        } else {
            return null;
        }
    }

    // Другие методы для работы с заказами
}
?>
