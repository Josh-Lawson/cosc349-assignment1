<?php
$servername = "192.168.56.12";
$username = "admin";
$password = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare("INSERT INTO User (name, username, password) VALUES (?, ?, ?)");

if (!$stmt) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

$stmt->bind_param("sss", $name, $username, $password);

$stmt->execute();

echo "New user created successfully";

$stmt->close();
$conn->close();

?>

<html>

<head>
    <header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
</head>

<body>
    <main>
        <h1>Add User</h1>
        <p><a href="admin.php">Admin Interface</a></p>

        <form action="add_user.php" method="POST">
            <p>name: <input type="text" name="name" /></p>
            <p>Username: <input type="text" name="username" /></p>
            <p>Password: <input type="text" name="password" /></p>
            <p><input type="submit" value="Add User" /></p>
        </form>
    </main>
</body>

</html>