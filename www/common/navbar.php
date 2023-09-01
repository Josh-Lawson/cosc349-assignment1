<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../common/sign_in.php');
    exit();
}
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
                <form action="<?php echo $_SESSION['role'] == 'admin' ? 'http://127.0.0.1:8081/admin.php' : 'http://127.0.0.1:8080/'; ?>" method="GET" style="display:inline;">
                    <button type="submit">Home</button>
                </form>
                <form action="../common/sign_out.php" method="POST" style="display:inline;">
                    <button type="submit">Sign Out</button>
                </form>
                <?php
            } else {
                echo '<a href="http://127.0.0.1:8080/common/sign_in.php">Sign In</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>