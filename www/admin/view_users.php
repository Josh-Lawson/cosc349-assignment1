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

$sql = "SELECT userId, username, name FROM User";
if ($filter != "") {
    $sql = $sql . " WHERE name LIKE '%$filter%' OR username LIKE '%$filter%'";
}

$result = $conn->query($sql);

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>View Users</title>
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
</head>

<body>
    <header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <main>
        <h1>View Users</h1>

        <form action="view_users.php" method="POST">
            <div>
                Filter: <input type="text" name="filter" value="<?php echo $filter; ?>" />
                <input type="submit" value="Filter" />
            </div>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Delete User</th>
            </tr>
            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["userId"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td><a href='delete_user.php?userId=".$row["userId"]."'>Delete</a></td>";
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