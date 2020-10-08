<?php include "db.php"; ?>

<?php 

if (isset($_POST["submit"])) {
    global $connection;
    
    $file = $_FILES["csv"]["tmp_name"];
    $handle = fopen($file, "r");
    $table_created = false;

    while ($content = fgetcsv($handle, 1000, ",")) {
        $table = rtrim($_FILES["csv"]["name"], ".csv");

        if (!$table_created) {
            $date = $content[0];
            $invoice_num = $content[1];
            $po_num = $content[2];
            $address = $content[3];
            $sales_tax = $content[4];
            $discount = $content[5];
            $comments = $content[6];

            $query = "CREATE TABLE $table ($date TEXT(10), $invoice_num INT(50), $po_num VARCHAR(50), "; 
            $query .= "$address VARCHAR(300), $sales_tax VARCHAR(50), $discount VARCHAR(50), $comments VARCHAR(500));";
            $data = mysqli_query($connection, $query);

            if (!$data) die(mysqli_error($connection));
        }
    
        else {
            $query = "INSERT INTO $table ($date, $invoice_num, $po_num, $address, $sales_tax, $discount, $comments) ";
            $query .= "VALUES ('$content[0]', '$content[1]', '$content[2]', '$content[3]', '$content[4]', '$content[5]', '$content[6]');";

            $data = mysqli_query($connection, $query);

            if (!$data) die(mysqli_error($connection));
        }
    
        $table_created = true;
    }
}

?>