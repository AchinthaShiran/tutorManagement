<?php
include "config.php";
include "functions.php";

if (!checkPermissions("TTR", 3)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$flag = false;
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

        try {
            $con->begin_transaction();

            $query = $con->prepare("INSERT INTO Tutors (firstName, lastName, email,phone,subject,about,dp) VALUES (?,?,?,?,?,?,?)");
            $query->bind_param("sssssss", $firstName, $lastName, $email, $phone, $subject, $about, $fileName);
            $query->execute();
            $result = $query->get_result();
            $tutorId = $con->insert_id;

            $err = $con->error;
            if (strcmp($err, "Duplicate entry '$email' for key 'email'") == 0) {
                echo "<script>alert('Email Exist')</script>";
                $flag = true;
                header("refresh:0;url=../viewTutors.php");
                exit;
            } else if (strcmp($err, "Duplicate entry '$phone' for key 'phone'") == 0) {
                $flag = true;
                echo "<script>alert('Phone Exist')</script>";
                header("refresh:0;url=../viewTutors.php");
                exit;
            }

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

            if (!$flag) {
                if (move_uploaded_file($tempName, $folder)) {
                    echo "<script>alert('Successfully Added Tutor')</script>";
                } else {
                    echo "<script>alert('Failed to upload dp')</script>";
                }
            }
            $con->close();
        } catch (Exception $ex) {
            echo "<script>alert('Failed to Add Tutor, Error Occurred')</script>";
        } finally {
            header("refresh:0;url=../viewTutors.php");
        }
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
