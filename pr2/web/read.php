<?php
$conn = new mysqli("db", "myuser", "mypassword", "mydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Product List</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td>".$row["price"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No products found";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
<a href="create.php">Create New Product</a>
</body>
</html>
