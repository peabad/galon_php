<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "assessment_db";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn){
        die("Database connection failed: ". mysql_connection_error());


    }else{


    }

?>
