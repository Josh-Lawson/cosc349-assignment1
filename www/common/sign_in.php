<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style/style.css"/>
        <title>Sign In Page</title>
    </head>
    <body>
        <main>

            <h1>Sign In</h1>

            <fieldset>

                <legend>Please Sign In Using Your Username And Password</legend>


                <form action="authenticate.php" method="POST">

                    <label for="username">Username:</label><input type="text" id="username" name="username" required pattern="[a-zA-Z0-9]{5,}" title="Username must be alphanumeric and at least 5 characters.">
                    <label for="password">Password:</label><input type="password" id="password" name="password" required pattern=".{8,}" title="Password must be at least 8 characters.">
                    <button type="submit">Sign In</button>
                </form>

                <p>Don't have an account? <a href="create_account.php">Create one</a></p>
            </fieldset>

        </main>
    </body>
</html>