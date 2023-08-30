<?php
session_start();

$servername = "192.168.56.12";
$dbusername = "admin";
$dbpassword = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['userId'];
    $recipeName = $_POST['recipeName'];
    $instructions = $_POST['instructions'];
    $ingredients = $_POST['ingredients'];
    $quantities = $_POST['quantities'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO Recipe (userId, recipeName, instructions) VALUES (?, ?, ?)");
        if ($stmt === false) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("iss", $userId, $recipeName, $instructions);
        $stmt->execute();
        $recipeId = $stmt->insert_id;

        for ($i = 0; $i < count($ingredients); $i++) {
            $ingredientId = $ingredients[$i];
            $quantity = $quantities[$i];
            $stmt = $conn->prepare("INSERT INTO RecipeIngredient (recipeId, ingredientId, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $recipeId, $ingredientId, $quantity);
            $stmt->execute();
        }

        $conn->commit();
        $stmt->close();
        $conn->close();
        header("Location: index.php");
        echo "Recipe submitted successfully!";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

} else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Recipe</title>
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#addIngredient').click(function() {
            var ingredientName = $('#ingredientName').val();
            var quantity = $('#quantity').val();

            if (ingredientName == "" || quantity == "") {
                alert("Please enter ingredient name and quantity");
                return;
            }

            $.ajax({
                type: 'POST',
                url: 'get_ingredient_id.php',
                data: { ingredientName: ingredientName },
                success: function(ingredientId) {
                    if (ingredientId != "0") {
                        var newRow = '<tr><td><input type="hidden" name="ingredients[]" value="' + ingredientId + '">' + ingredientName + '</td><td><input type="hidden" name="quantities[]" value="' + quantity + '">' + quantity + '</td></tr>';
                        $('#ingredientsTable tbody').append(newRow);
                        $('#ingredientName').val('');
                        $('#quantity').val('');
                    } else {
                        alert("Ingredient does not exist");
                    }
                }
            });
        });
    });
    </script>
</head>
<body>
<header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <form method="post">
        <div>
            <label for="recipeName">Recipe Name</label>
            <input type="text" id="recipeName" name="recipeName" required>
        </div>
        <div>
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions" required></textarea>
        </div>
        <div>
            <label for="ingredientName">Ingredient</label>
            <input type="text" id="ingredientName">
        </div>
        <div>
            <label for="quantity">Quantity</label>
            <input type="text" id="quantity">
        </div>
        <button type="button" id="addIngredient">Add Ingredient</button>
        <table id="ingredientsTable">
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="submit">Submit Recipe</button>
    </form>
</body>
</html>

<?php
}
?>