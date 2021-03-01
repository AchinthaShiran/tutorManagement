<?php
include "config.php";
include "functions.php";

if (!checkPermissions("EBK", 3)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

if (isset($_GET['file_name']) && isset($_GET['book_id'])) {
    $fileName = $_GET['file_name'];
    $id = $_GET['book_id'];

    try {
        if (unlink("../ebooks/" . $fileName)) {
            $con = connect();
            $query = $con->prepare("DELETE FROM Ebooks WHERE bookId=?");
            $query->bind_param("s", $id);
            $query->execute();
            $result = $query->get_result();
            echo "<script>alert('Successfully Deleted Ebook')</script>";
        } else {
            echo "<script>alert('Failed to Delete Ebook')</script>";
        }
    } catch (Exception $ex) {
        echo "<script>alert('Failed to Delete Ebook')</script>";
    } finally {
        $con->close();
        echo "<script>window.location.replace('../viewEbooks.php'); </script>";

    }
}
