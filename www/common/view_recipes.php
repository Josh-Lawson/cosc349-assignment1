<?php
$servername = "192.168.56.12";
$username = "admin";
$password = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filter = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filter = $_POST["filter"];
}

$sql = "SELECT * FROM Recipe";
if ($filter != "") {
    $sql = $sql . " WHERE recipeName LIKE '%$filter%'";
}

$result = $conn->query($sql);

?>

<html>

<head>
    <title>View Recipes</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
    <header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <main>
        <h1>View Recipes</h1>

        <form action="view_recipes.php" method="POST">
            <div>
                Search: <input type="text" name="filter" value="<?php echo $filter; ?>" />
                <input type="submit" value="Search" />
            </div>
        </form>

        <table>
            <tr>
                <th>Recpe ID</th>
                <th>recipeName</th>
                <th>Instructions</th>
                <th>View</th>
            </tr>
            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["recipeId"] . "</td>";
                    echo "<td>" . $row["recipeName"] . "</td>";
                    echo "<td>" . $row["instructions"] . "</td>";
                    echo "<td><a href='recipe_redirect.php?recipeId=".$row["recipeId"]."'>View</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </table>
    </main>
</body>

</html>