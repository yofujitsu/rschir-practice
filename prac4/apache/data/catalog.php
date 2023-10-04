<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>D2Market Items Page</title>
</head>
<body>
    <h1>Available Items For sale</h1>
    
    <br>
    <table>
        <tbody>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Description</th>
            </tr>

            <?php
                $mysqli = new mysqli("database", "root", "password123", "php_database");
                $table = $mysqli->query("SELECT * FROM items");

                foreach ($table as $row) {
                    echo "<tr><td>{$row['name']}</td><td>{$row['price']}</td><td>{$row['availability']}</td><td>{$row['description']}</td></tr>";
                }
            ?>

        </tbody>
    </table>

    <p>
        <a href="/">на главную</a>
    </p>
</body>
</html>