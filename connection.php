<?php
    $host = "mysql";
    $user = "root";
    $pass = "password";
    $db = "gym_memberships";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if(!$conn) {
        die("koenksi gagal : ".mysqli__connect_error());
    }

?>