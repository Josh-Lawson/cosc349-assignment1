<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: ../common/sign_in.php');
    exit();
}

$servername = "192.168.56.12";
$dbusername = "admin";
$dbpassword = "admin_pw";
$dbname = "RecipeManagementSystem";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['userId'];
$stmt = $conn->prepare("SELECT * FROM Admin WHERE adminId = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$isAdmin = $stmt->fetch();
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css" />
</head>

<body>
    <div class="navbar">
        <div>
            <?php
            if (isset($_SESSION['username'])) {
                echo 'Welcome, ' . $_SESSION['username'];
                ?>
                <form action="<?php echo $isAdmin ? 'http://127.0.0.1:8081/admin.php' : 'http://127.0.0.1:8080/'; ?>" method="GET" style="display:inline;">
                    <button type="submit">Home</button>
                <form action="../common/sign_out.php" method="POST" style="display:inline;">
                    <button type="submit">Sign Out</button>
                </form>
                <?php
            } else {
                echo '<a href="../common/sign_in.php">Sign In</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>