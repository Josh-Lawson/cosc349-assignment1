<?php
$servername = "192.168.56.12";
$dbusername = "admin";
$dbpassword = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipeId = $_POST['recipeId'];
$recipeName = $_POST['recipeName'];
$instructions = $_POST['instructions'];
$ingredientNames = $_POST['ingredientName'];
$quantities = $_POST['quantity'];

$stmt = $conn->prepare("UPDATE Recipe SET recipeName = ?, instructions = ? WHERE recipeId = ?");
$stmt->bind_param("ssi", $recipeName, $instructions, $recipeId);
$stmt->execute();

$stmt = $conn->prepare("DELETE Ingredient FROM Ingredient JOIN RecipeIngredient ON Ingredient.ingredientId = RecipeIngredient.ingredientId WHERE RecipeIngredient.recipeId = ?");
$stmt->bind_param("i", $recipeId);
$stmt->execute();

header("Location: recipe_admin_view.php?recipeId=$recipeId");
?>