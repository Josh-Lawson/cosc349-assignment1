<?php
/**
 * @file
 * This file is used to edit a recipe.
 * 
 */

/**
 * Holds database connection details
 */
$servername = "192.168.56.12";
$dbusername = "admin";
$dbpassword = "admin_pw";
$dbname = "RecipeManagementSystem";

/**
 * Creates a new mysqli object and connects to the database
 */
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipeId = $_POST['recipeId'];
$recipeName = $_POST['recipeName'];
$instructions = $_POST['instructions'];
$ingredientNames = $_POST['ingredientName'];
$quantities = $_POST['quantity'];

/**
 * Prepares a SQL statement to update the recipe in the database
 */
$stmt = $conn->prepare("UPDATE Recipe SET recipeName = ?, instructions = ? WHERE recipeId = ?");
$stmt->bind_param("ssi", $recipeName, $instructions, $recipeId);
$stmt->execute();

/**
 * Prepares a SQL statement to delete the recipe ingredients from the database
 */
$stmt = $conn->prepare("DELETE Ingredient FROM Ingredient JOIN RecipeIngredient ON Ingredient.ingredientId = RecipeIngredient.ingredientId WHERE RecipeIngredient.recipeId = ?");
$stmt->bind_param("i", $recipeId);
$stmt->execute();

/**
 * Prepares a SQL statement to insert each recipe ingredient into the database
 */
header("Location: recipe_admin_view.php?recipeId=$recipeId");
?>