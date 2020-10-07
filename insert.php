<?php 

if (isset($_POST["submit"])) {
    $connection = mysqli_connect("localhost", "root", "", "csv_db");
    
    if (!$connection) die("Database connection failed");
    
    $file = $_FILES["csv"]["tmp_name"];
    $handle = fopen($file, "r");
    $table_created = false;
    
    while ($content = fgetcsv($handle, 1000, ",")) {
        $table = rtrim($_FILES["csv"]["name"], ".csv");
        
        if (!$table_created) {
            $name = $content[0];
            $department = $content[1];
            $salary = $content[2];
            $id = $content[3];
            
            $query = "CREATE TABLE $table ($name VARCHAR(50), $department VARCHAR(50), $salary INT(5), $id INT(5));";
            echo $query . "<br>";
            $data = mysqli_query($connection, $query);

            if (!$data) die(mysqli_error($connection));
        }
    
        else {
            $query = "INSERT INTO $table ($name, $department, $salary, $id) VALUES ('$content[0]', '$content[1]', '$content[2]', '$content[3]');";
            echo $query . "<br>";
    
            $data = mysqli_query($connection, $query);

            if (!$data) die(mysqli_error($connection));
        }
    
        $table_created = true;
    }
}

?>