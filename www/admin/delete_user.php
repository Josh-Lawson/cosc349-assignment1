<?php
$servername = "192.168.56.12";
$dbusername = "admin";
$dbpassword = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        $id = $_POST["id"];
        $stmt = $conn->prepare("DELETE FROM User WHERE userId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "User deleted successfully";
        $stmt->close();
        $conn->close();
    } else {
        $id = $_POST["id"];

?>

<html>
    <head>
        <title>Edit User</title>
        <style>
            th {
                text-align: left;
            }

            table, th, td {
                border: 2px solid grey;
                border-collapse: collapse;
            }

            th, td {
                padding: 0.2em;
            }
        </style>
    </head>
    <body>
        <h1>Confirma Deletion</h1>
        <p>Are you sure you want to delete the user with ID <?php echo $id; ?>?</p>

        <form action = "delete_user.php" method = "POST">
            <input type = "hidden" name = "id" value="<?php echo $id; ?>">
            <input type = "hidden" name = "confirm" value="1">
            <p><input type = "submit" value = "Yes, delete User" /></p>
        </form>

        <p><a href="admin.php">No, return to Admin Interface</a></p>
    </body>

<?php
    }
} else {
?>

<html>
    <head>
        <title>Delete User</title>
        <style>
            th {
                text-align: left;
            }

            table, th, td {
                border: 2px solid grey;
                border-collapse: collapse;
            }

            th, td {
                padding: 0.2em;
            }
        </style>
    </head>
    <body>
        <h1>Delete User</h1>
        <p><a href="admin.php">Admin Interface</a></p>

        <form action="delete_user.php" method="POST">
            <p>User ID: <input type="text" name="id" /></p>
            <p><input type="submit" value="Delete User" /></p>
        </form>
    </body>
</html>

<?php
}
?>