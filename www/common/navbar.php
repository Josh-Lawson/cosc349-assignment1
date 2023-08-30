<?php
session_start();
if (!isset($_SESSION['userId'])) {
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