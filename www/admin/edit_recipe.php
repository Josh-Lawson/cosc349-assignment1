<?php
$recipeId = $_POST['recipeId'];
$recipeName = $_POST['recipeName'];
$instructions = $_POST['instructions'];
$ingredientNames = $_POST['ingredientName'];
$quantities = $_POST['quantity'];

$stmt = $conn->prepare("UPDATE Recipe SET recipeName = ?, instructions = ? WHERE recipeId = ?");
$stmt->bind_param("ssi", $recipeName, $instructions, $recipeId);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM Ingredient WHERE recipeId = ?");
$stmt->bind_param("i", $recipeId);
$stmt->execute();

$stmt = $conn->prepare("INSERT INTO Ingredient (recipeId, ingredientName, quantity) VALUES (?, ?, ?)");
foreach($ingredientNames as $index => $ingredientName) {
    $quantity = $quantities[$index];
    $stmt->bind_param("isi", $recipeId, $ingredientName, $quantity);
    $stmt->execute();
}

header("Location: recipe_admin.php?recipeId=$recipeId");
?>