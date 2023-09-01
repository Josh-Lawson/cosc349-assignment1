<?php
session_start();
$servername = "192.168.56.12";
$username = "admin";
$password = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['userId'];

$stmt = $conn->prepare("SELECT role FROM User WHERE userId = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

$recipeId = $_GET['recipeId'];

if($row['role'] == 'admin'){
    header("Location: http://127.0.0.1:8081/recipe_admin_view.php?recipeId=$recipeId");
} else {
    header("Location: http://127.0.0.1:8080/recipe_user_view.php?recipeId=$recipeId");
}
$conn->close();
?>