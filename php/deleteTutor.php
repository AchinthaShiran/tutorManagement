<?php
include "config.php";
include "functions.php";

if (!checkPermissions("TTR", 4)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $con = connect();
        $query = $con->prepare("DELETE FROM Tutors WHERE id=?");
        $query->bind_param("s", $id);
        $query->execute();
        $result = $query->get_result();
        echo "<script>alert('Successfully Deleted Tutor')</script>";
    } catch (Exception $ex) {
        echo "<script>alert('Failed to Delete Tutor')</script>";
    } finally {
        echo "<script>window.location.replace('../viewTutors.php'); </script>";
    }
}
