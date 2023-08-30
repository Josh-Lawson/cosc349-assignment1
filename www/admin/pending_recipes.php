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
    if (isset($_POST['approve'])) {
        $recipeId = $_POST['recipeId'];
        $stmt = $conn->prepare("UPDATE Recipe SET approved = TRUE WHERE recipeId = ?");
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['deny'])) {
        $recipeId = $_POST['recipeId'];
        $stmt = $conn->prepare("DELETE FROM Recipe WHERE recipeId = ?");
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $stmt->close();
    }
}

$stmt = $conn->prepare("SELECT recipeId, recipeName, instructions FROM Recipe WHERE approved = FALSE");
$stmt->execute();
$stmt->bind_result($recipeId, $recipeName, $instructions);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
    <title>Pending Recipes</title>
</head>

<body>
    <header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <h1>Pending Recipes</h1>
    <table border="1">
        <tr>
            <th>Recipe Name</th>
            <th>Instructions</th>
            <th>Approve</th>
            <th>Deny</th>
        </tr>
        <?php while ($stmt->fetch()): ?>
            <tr>
                <td>
                    <?php echo $recipeName; ?>
                </td>
                <td>
                    <?php echo $instructions; ?>
                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>">
                        <input type="submit" name="approve" value="Approve">
                    </form>
                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>">
                        <input type="submit" name="deny" value="Deny">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>