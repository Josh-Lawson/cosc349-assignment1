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

        <h1>Update Recipe</h1><br>

        <form action="edit_recipe.php" method="POST">


            <h3>Recipe Name</h3>
            <input type="text" name="recipeName" value="<?php echo $recipe['recipeName']; ?>">

            <h3>Instructions</h3>
            <textarea name="instructions"><?php echo $recipe['instructions']; ?></textarea>

            <h3>Ingredients</h3>
            <div>

                <ul>
                    <?php foreach ($ingredients as $index => $ingredient): ?>
                        <li>
                            <input type="text" name="ingredientName[]" value="<?php echo $ingredient['ingredientName']; ?>">
                            -
                            <input type="text" name="quantity[]" value="<?php echo $ingredient['quantity']; ?>">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>


            <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>">
            <button type="submit">Update Recipe</button>

            <!-- <a href="delete_recipe.php?recipeId=<? //php echo $recipeId; ?>" >Delete Recipe</a> -->


        </form>
        &nbsp;

        <form method="GET" action="delete_recipe.php?recipeId=<?php echo $recipeId; ?>"
                onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>">
                <button type="submit">Delete Recipe</button>

            </form>

    </main>
</body>

</html>