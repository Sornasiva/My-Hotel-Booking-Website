<?php
    $host = "localhost";
    $user = "root";
    $pwd = "siva";
    $db = "hotelbooking";

    $conn = new mysqli($host,$user,$pwd,$db);
    if($conn->connect_error)
    {
        die("Connection Failed : ".$conn->connect_error);
    }
?>