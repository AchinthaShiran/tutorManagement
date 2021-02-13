<?php
include "config.php";
include "functions.php";

if (!checkPermissions("EBK", 1)) {
    header("location: index.php");
    exit;
}

$stts = "";

if (isset($_POST['submit'])) {
    $fileName = $_FILES["ebook"]["name"];
    $tempName = $_FILES["ebook"]["tmp_name"];
    $folder = "../ebooks/" . $fileName;
    $ebookName = $_POST['ebookName'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $medium = $_POST['medium'];


    $con = connect();
    $query = $con->prepare("INSERT INTO Ebooks (fileName,ebookName,subject,grade,medium) VALUES (?,?,?,?,?)");
    $query->bind_param("sssss", $fileName, $ebookName,$subject,$grade,$medium);
    $query->execute();

    if (move_uploaded_file($tempName, $folder)) {
        $stts = "ebook uploaded successfully";
    } else {
        $stts = "Failed to upload ebook";
    }
}

?>
