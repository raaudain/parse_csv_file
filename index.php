<?php include "includes/db.php" ?>
<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pivot, Inc - Log In</title>
</head>
<body>
    <form action="index.php" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>