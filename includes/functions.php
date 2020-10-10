<?php include "db.php"; ?>

<?php 

function parseCSV() {
    // Checks if submit button was clicked
    if (isset($_POST["submit"])) {
        global $connection; // Pulls variable from db.php
        
        $file = $_FILES["csv"]["tmp_name"]; // Grabs uploaded csv file
        $handle = fopen($file, "r"); // Opens and reads csv file
        $table_created = false;
    
        // While there is a row to read...
        while ($content = fgetcsv($handle, 1000, ",")) {
            // Using filename as table name
            // Removes .csv extension
            $table = rtrim($_FILES["csv"]["name"], ".csv");
            
            // If table doesn't exist...
            if (!$table_created) {
                $date = $content[0];
                $invoice_num = $content[1];
                $po_num = $content[2];
                $address = $content[3];
                $sales_tax = $content[4];
                $discount = $content[5];
                $comments = $content[6];
                
                // Creates table and columns
                $query = "CREATE TABLE $table ($date TEXT(10), $invoice_num INT(50), $po_num VARCHAR(50), "; 
                $query .= "$address VARCHAR(300), $sales_tax VARCHAR(50), $discount VARCHAR(50), $comments VARCHAR(500));";

                // Sends query
                $data = mysqli_query($connection, $query);
                
                // Error handling
                if (!$data) die(mysqli_error("Connection failed: " . mysqli_error($connection)));
            }
            
            // If table does exist...
            else {
                // Inserts into columns in users table
                $query = "INSERT INTO $table ($date, $invoice_num, $po_num, $address, $sales_tax, $discount, $comments) ";
                $query .= "VALUES ('$content[0]', '$content[1]', '$content[2]', '$content[3]', '$content[4]', '$content[5]', '$content[6]');";
                
                // Send query
                $data = mysqli_query($connection, $query);
                
                // Error handling
                if (!$data) die("Connection failed: " . mysqli_error($connection));
            }
        
            $table_created = true;
        }
    }
}

function registerUser() {
    if (isset($_POST["submit"])) {
        global $connection;

        $username = $_POST["username"];
        $password = $_POST["password"];

        // Sanitizes inputs in fields
        $username = mysqli_escape_string($connection, $username);
        $password = mysqli_escape_string($connection, $password);

        // Encrypting password
        $hashFormat = "$2y$10$";
        $salt = "thisiscrazycool";
        $hash_and_salt = $hashFormat . $salt;

        // Password is now encrypted
        $password = crypt($password, $hash_and_salt);

        // Inserts into columns in users table
        $query = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(128) NOT NULL, 
            password VARCHAR(128) NOT NULL
            ) ";
        $query .= "INSERT INTO users (username, password) ";
        $query .= "VALUES ('$username', '$password');";

        $result = mysqli_query($connection, $query);
    
        if (!$result) die("Connection failed: " . mysqli_error($connection));
    }
}

?>