<?php
$servername = "192.168.56.12";
$dbusername = "admin";
$dbpassword = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ingredientName = $_POST['ingredientName'];

    $stmt = $conn->prepare("SELECT ingredientId FROM Ingredient WHERE ingredientName = ?");
    $stmt->bind_param("s", $ingredientName);
    $stmt->execute();
    $stmt->bind_result($ingredientId);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    echo $ingredientId ? $ingredientId : "0";
}
?>
