<?php
include "config.php";
include "functions.php";

if (!checkPermissions("EBK", 3)) {
    header("location: index.php");
    exit;
}

if (isset($_GET['file_name']) && isset($_GET['book_id'])) {
    $fileName = $_GET['file_name'];
    $id = $_GET['book_id'];

    if (unlink("../ebooks/" . $fileName)) {
        $con = connect();
        $query = $con->prepare("DELETE FROM ebooks WHERE book_id=?");
        $query->bind_param("s", $id);
        $query->execute();
        $result = $query->get_result();
        echo ("$fileName has been deleted");
        header("location: ../viewEbooks.php");
    } else {
        echo ("$fileName cannot be deleted due to an error");
    }
}
