<?php include "includes/functions.php"; ?>
<?php parseCSV(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pivot, Inc.</title>
</head>
<body>
    <form action="uploadForm.php" method="post" enctype="multipart/form-data">
        <input type="file" name="csv" required />
        <input type="submit" name="submit" value="Submit" />
    </form>
</body>
</html>