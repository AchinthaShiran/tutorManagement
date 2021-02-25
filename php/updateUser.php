<?php
include "config.php";
include "functions.php";


if (!checkPermissions("USR", 2)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

if (isset($_POST['submit'])) {
    if (checkPermissions("USR", 2)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $status =  $_POST['status'];
        $id = $_POST['id'];
        try {
            $con = connect();
            $query = $con->prepare("UPDATE Users SET firstName=?, lastName=?, email=?, phone=?, status=? WHERE id=?");
            $query->bind_param("sssssi", $firstName, $lastName, $email, $phone, $status, $id);
            $query->execute();
            $result = $query->get_result();

            $err = $con->errno;
            if ($con->errno) {
                throw new Exception("Duplicate Entry");
            }

           
            echo "<script>alert('Successfully Updated User')</script>";
        } catch (Exception $ex) {
            if ($ex->getMessage() == "Duplicate Entry") {
                echo "<script>alert('Email or Phone is already in use!')</script>";
            } else
                echo "<script>alert('Failed TO Update User')</script>";
        } finally {
            $con->close();
            echo "<script>window.location.replace('../viewUsers.php'); </script>";
        }
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
