<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = new mysqli("db", "myuser", "mypassword", "mydb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
</head>
<body>
<h2>Delete Product</h2>
<p>Are you sure you want to delete this product?</p>
<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <input type="submit" value="Yes">
</form>
<a href="read.php">No, go back</a>
</body>
</html>
