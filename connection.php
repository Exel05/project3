<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db_membership_new";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if(!$conn) {
        die("koenksi gagal : ".mysqli__connect_error());
    }

?>