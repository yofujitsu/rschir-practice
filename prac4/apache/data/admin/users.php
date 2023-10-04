<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Dota2Market</title>
</head>
<body>
    <h1>Users List</h1>

    <p>
        <table>
            <tbody>
                <tr>
                    <th>Login</th>
                    <th>Name</th>
                    <th>Role</th>
                </tr>

                <?php
                    $mysqli = new mysqli("database", "root", "password123", "php_database");
                    $table = $mysqli->query("SELECT * FROM users");

                    foreach ($table as $row) {
                        echo 
                            "<tr>
                                <td>{$row['login']}</td>
                                <td>{$row['name']}</td>  
                                <td>{$row['role']}</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </p>
    <p><a href="/">На главную</a></p>
</body>
</html>