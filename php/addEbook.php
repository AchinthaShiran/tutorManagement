<?php
include "config.php";
include "functions.php";

if (!checkPermissions("EBK", 1)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$stts = "";

if (isset($_POST['submit'])) {
    $fileName = $_FILES["ebook"]["name"];
    $tempName = $_FILES["ebook"]["tmp_name"];
    $ebookName = $_POST['ebookName'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $medium = $_POST['medium'];

    $temp = explode(".", $fileName);
    $newFileName = $ebookName."_".round(microtime(true)) . '.' . end($temp);
   
    $folder = "../ebooks/" . $newFileName;

    try {
        $con = connect();
        $query = $con->prepare("INSERT INTO Ebooks (fileName,ebookName,subject,grade,medium) VALUES (?,?,?,?,?)");
        $query->bind_param("sssss", $newFileName, $ebookName, $subject, $grade, $medium);
        $query->execute();

        if (move_uploaded_file($tempName, $folder)) {
            echo "<script>alert('ebook uploaded successfully')</script>";
        } else {
            echo "<script>alert('Failed to upload ebook')</script>";
        }
    } catch (Exception $ex) {
        echo "<script>alert('Failed to upload ebook')</script>";
    } finally {
        $con->close();
        echo "<script>window.location.replace('../viewEbooks.php'); </script>";
    }
}
