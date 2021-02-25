<?php
include "config.php";
include "functions.php";


if (!checkPermissions("TTR", 2)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

if (isset($_POST['submit'])) {
    if (checkPermissions("TTR", 2)) {
        $id = $_POST['id'];
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $subject =  $_POST['subject'];
        $about =  $_POST['about'];
        $grades = $_POST['grades'];
        $mediums = $_POST['mediums'];
        $oldDp = $_POST['oldDp'];
        $fileName = $_FILES["dp"]["name"];
        $tempName = $_FILES["dp"]["tmp_name"];
        $folder = "../tutorDp/" . $fileName;


        try {
            $con = connect();
            $con->begin_transaction();

            $query = $con->prepare("UPDATE Tutors SET firstName=?, lastName=?, email=?, phone=?,about=?,dp=?, subject=? WHERE id=?");
            $query->bind_param("sssssssi", $firstName, $lastName, $email, $phone, $about, $fileName, $subject, $id);
            $query->execute();
            $result = $query->get_result();


            $query = $con->prepare("DELETE FROM Grades WHERE tutor=?");
            $query->bind_param("i", $id);
            $query->execute();
            foreach ($grades as $grade) {
                $query = $con->prepare("INSERT INTO Grades (tutor,grade) VALUES (?,?)");
                $query->bind_param("is", $id, $grade);
                $query->execute();
            }

            $query = $con->prepare("DELETE FROM Mediums WHERE tutor=?");
            $query->bind_param("i", $id);
            $query->execute();
            foreach ($mediums as $medium) {
                $query = $con->prepare("INSERT INTO Mediums (tutor,medium) VALUES (?,?)");
                $query->bind_param("is", $id, $medium);
                $query->execute();
            }

            $con->commit();

            $con->close();

            unlink("../tutorDp/" . $oldDp);
            if (move_uploaded_file($tempName, $folder)) {
                echo "<script>alert('Successfully Updated Tutor')</script>";
            } else {
                echo "<script>alert('Failed TO Update Tutor')</script>";
            }
        } catch (Exception $ex) {
            echo "<script>alert('Failed TO Update Tutor')</script>";
        }finally{
            echo "<script>window.location.replace('../viewTutors.php'); </script>";

        }


        // echo "<meta http-equiv='refresh' content='0'>";
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
