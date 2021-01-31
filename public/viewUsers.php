<?php
include "../php/functions.php";
include "../php/config.php";

if (!checkPermissions("USR", 4)) {
    header("location: index.php");
    exit;
}

$con = connect();
$query = $con->prepare("SELECT * FROM Users WHERE role_id=2");
$query->execute();
$result = $query->get_result();

$users = array();

while ($row = $result->fetch_assoc()) {
    array_push($users, $row);
}

$con->close();

function get($users)
{
    foreach ($users as $user) {
        $name = $user['firstName'] . " " . $user['lastName'];
        $email = $user['email'];
        $status = $user['status'];
        $phone = $user['phone'];
        $id = $user['id'];
        echo "        
        <tr>
        <td>$name</td>
        <td>$email</td>
        <td>$phone</td>
        <td>$status</td>
        <td><button onclick=\"location.href = 'updateUser.php?id=$id';\"  class=\"btn btn-primary\">View</button></td>
        </tr>
        ";
    }
}

?>
<html>

<head lang="en">
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<div class="container-fluid sidebar">
    <div class="row">
        <?php include "sideBar.php" ?>
        <div class="col-md-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php get($users) ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</html>

