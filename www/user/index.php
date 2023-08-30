<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>

<head>
    <title>Recipe Home Page</title>
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
</head>

<body>
<header>
        <?php include '../common/navbar.php'; ?>
</header>
    <main>

        <?php
        session_start();
        if (!isset($_SESSION['userId'])) {
            header('Location: ../common/sign_in.php');
            exit();
        }
        ?>

        <h1>Recipe Home Page</h1>
        <p><a href="view_recipes.php">View All Recipes</a></p>
        <p><a href="submit_recipe.php">Submit A New Recipe</a></p>

    </main>

</body>

</html>