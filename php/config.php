<?php
session_start();

function connect()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tutormanagement";

    // Create connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}
