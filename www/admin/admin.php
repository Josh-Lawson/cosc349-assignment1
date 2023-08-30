<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>

<head>
    <title>Admin Interface</title>
    <link rel="stylesheet" type="text/css" href="../common/style/style.css">
</head>

<body>
    <header>
        <?php include '../common/navbar.php'; ?>
    </header>
    <main>

        <h1>Recipe Management</h1>
        <nav>
            <p><a href="add_recipe.php">Add Recipe</a></p>
            <p><a href="edit_recipe.php">Edit Recipe</a></p>
            <p><a href="delete_recipe.php">Delete Recipe</a></p>
        </nav>

        <h1>User Management</h1>
        <nav>
            <p><a href="view_users.php">View all users</a></p>
            <p><a href="add_user.php">Add a new user</a></p>
            <p><a href="delete_user.php">Delete a user</a></p>
        </nav>

    </main>
</body>

</html>