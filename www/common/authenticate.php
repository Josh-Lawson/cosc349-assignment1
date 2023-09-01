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

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM User WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $row['userId'];
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'admin') {
            header('Location: http://127.0.0.1:8081/admin.php');
        } else {
            header('Location: /index.php');
        }
    }
} else {
    session_start();
    $_SESSION['errorMessage'] = 'Invalid username or password';
    header('Location: sign_in.php');

}

$stmt->close();
$conn->close();
?>