<?php
$servername = "192.168.56.12";
$username = "admin";
$password = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipeId = $_GET['recipeId'];

$sql = "SELECT * FROM Recipe WHERE recipeId = $recipeId";
$result = $conn->query($sql);
$recipe = $result->fetch_assoc();

$sql = "SELECT * FROM RecipeIngredient JOIN Ingredient ON RecipeIngredient.ingredientId = Ingredient.ingredientId WHERE recipeId = $recipeId";
$result = $conn->query($sql);
$ingredients = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>View Recipe</title>
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
</head>

<body>
    <header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <main>
        <div class="recipe-details">
            <h1>
                <?php echo $recipe['recipeName']; ?>
            </h1>
            <div class="instructions-container">
                <label>Instructions</label>
                <ul>
                    <li>
                        <?php echo $recipe['instructions']; ?>
                    </li>
                </ul>
            </div>
            <h2>Ingredients</h2>
            <ul>
                <?php foreach ($ingredients as $ingredient): ?>
                    <li>
                        <?php echo $ingredient['ingredientName'] . " - " . $ingredient['quantity']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <main>
</body>

</html>