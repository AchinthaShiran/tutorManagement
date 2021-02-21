<?php
include "config.php";
include "functions.php";


if (!checkPermissions("USR", 1)) {
    header("location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    if (checkPermissions("USR", 1)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $role =  $_POST['role'];

        $con = connect();
        try {
            $query = $con->prepare("INSERT INTO Users (firstName, lastName, email,phone,password,role_id,status)
             VALUES (?, ?, ?,?,'123123123',?,'Active')");
            $query->bind_param("ssssi", $firstName, $lastName, $email, $phone, $role);
            $query->execute();
            $result = $query->get_result();
            $con->close();
            echo "<script>alert('Successfully Added User')</script>";
        } catch (Exception $ex) {
            echo "<script>alert('Failed to Add User')</script>";
        } finally {
            header("refresh:0;url=../viewUsers.php");
        }

    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
