<?php
session_start();
session_destroy();
header('Location: ../common/sign_in.php');
exit();
?>