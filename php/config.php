<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

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
        die("Error Occurred");  
    }

    return $con;
}
