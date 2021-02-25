<?php
include "config.php";
include "functions.php";


if (!checkPermissions("USR", 1)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

if (isset($_POST['submit'])) {
    if (checkPermissions("USR", 1)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $role =  $_POST['role'];
        $password = md5("123123");
        $con = connect();
        try {
            $query = $con->prepare("INSERT INTO Users (firstName, lastName, email,phone,password,role_id,status)
             VALUES (?, ?, ?,?,?,?,'Active')");
            $query->bind_param("sssssi", $firstName, $lastName, $email, $phone, $password, $role);
            $query->execute();
            $result = $query->get_result();

            if ($con->errno) {
                throw new Exception("Duplicate Entry");
            }

            echo "<script>alert('Successfully Added User')</script>";
            echo "<script>window.location.replace('../viewUsers.php'); </script>";
        } catch (Exception $ex) {

            if ($ex->getMessage() == "Duplicate Entry") {
                echo "<script>alert('Email or Phone is already in use!')</script>";
            } else
                echo "<script>alert('Failed to Add User')</script>";

            echo "<script>window.location.replace('../addUser.php'); </script>";
        } finally {
            $con->close();
        }
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
