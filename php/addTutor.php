<?php
include "config.php";
include "functions.php";

if (!checkPermissions("TTR", 3)) {
    header("location: index.php");
    exit;
}

$error = '';
if (isset($_POST['submit'])) {

    if (checkPermissions("TTR", 3)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $subject =  $_POST['subject'];
        $about =  $_POST['about'];
        $grades = $_POST['grades'];
        $mediums = $_POST['mediums'];

        $fileName = $_FILES["dp"]["name"];
        $tempName = $_FILES["dp"]["tmp_name"];
        $folder = "../tutorDp/" . $fileName;

        $con = connect();
        $con->begin_transaction();

        $query = $con->prepare("INSERT INTO Tutors (firstName, lastName, email,phone,subject,about,dp) VALUES (?,?,?,?,?,?,?)");
        $query->bind_param("sssssss", $firstName, $lastName, $email, $phone, $subject, $about, $fileName);
        $query->execute();
        $result = $query->get_result();
        $tutorId = $con->insert_id;

        foreach ($grades as $grade) {
            $query = $con->prepare("INSERT INTO Grades (tutor,grade) VALUES (?,?)");
            $query->bind_param("is", $tutorId, $grade);
            $query->execute();
        }

        foreach ($mediums as $medium) {
            $query = $con->prepare("INSERT INTO Mediums (tutor,medium) VALUES (?,?)");
            $query->bind_param("is", $tutorId, $medium);
            $query->execute();
        }

        $con->commit();
        $err = $con->error;

        if (strcmp($err, "Duplicate entry '$email' for key 'email'") == 0) {
            $error = "Email Exist";
        } else if (strcmp($err, "Duplicate entry '$phone' for key 'phone'") == 0) {
            $error = "Phone Exist";
        } else {
            if (move_uploaded_file($tempName, $folder)) {
                $stts = "dp uploaded successfully";
            } else {
                $stts = "Failed to upload dp";
            }
        }
        $con->close();
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
?>