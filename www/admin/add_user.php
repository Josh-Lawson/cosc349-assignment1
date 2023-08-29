<?php
$servername = "192.168.56.12";
$username = "admin";
$password = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare("INSERT INTO User (username, password) VALUES (?, ?)");

if (!$stmt) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

$stmt->bind_param("ss", $username, $password);

$stmt->execute();

echo "New user created successfully";

$stmt->close();
$conn->close();

?>

<html>
    <head>
        <title>Add User</title>
        <style>
            th {
                text-align: left;
            }

            table, th, td {
                border: 2px solid grey;
                border-collapse: collapse;
            }

            th, td {
                padding: 0.2em;
            }
        </style>
    </head>
    <body>
        <h1>Add User</h1>
        <p><a href="admin.php">Admin Interface</a></p>

        <form action = "add_user.php" method = "POST">
            <p>Username: <input type = "text" name = "username" /></p>
            <p>Password: <input type = "text" name = "password" /></p>
            <p><input type = "submit" value = "Add User" /></p>
        </form>
    </body>
</html>