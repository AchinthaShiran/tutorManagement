<?php
include "config.php";
include "functions.php";

if (!checkPermissions("USR", 3)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $con = connect();
        $query = $con->prepare("DELETE FROM Users WHERE id=?");
        $query->bind_param("s", $id);
        $query->execute();
        $result = $query->get_result();
        echo "<script>alert('Successfully Deleted User')</script>";
    } catch (Exception $ex) {
        echo "<script>alert('Failed to Delete User')</script>";
    } finally {
        echo "<script>window.location.replace('../viewUsers.php'); </script>";
    }
}
